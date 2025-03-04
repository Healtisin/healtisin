<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\ChatHistory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Services\MedicalDatasetService;
use App\Services\ResponseValidationService;
use App\Exceptions\AIServiceException;
use App\Constants\HealthKeywords;
use App\Constants\Greetings;
use App\Constants\QuestionPatterns;

class ChatController extends Controller
{
    protected $medicalDataset;
    protected $responseValidator;
    
    public function __construct(MedicalDatasetService $medicalDataset, ResponseValidationService $responseValidator)
    {
        $this->medicalDataset = $medicalDataset;
        $this->responseValidator = $responseValidator;
    }

    public function sendMessage(Request $request)
    {
        try {
            $message = $request->message;
            $user = auth()->user();
            $chatId = $request->chatId;

            // Jangan buat chat history baru sampai ada respons AI berhasil
            $messages = [['role' => 'user', 'content' => $message]];
            
            // Proses dan simpan respons AI
            $aiResponse = $this->getAIResponse($message);
            
            // Setelah mendapat respons AI, baru buat atau update chat history
            if ($chatId) {
                $chatHistory = ChatHistory::where('id', $chatId)
                    ->where('user_id', $user->id)
                    ->first();

                if (!$chatHistory) {
                    return response()->json(['status' => 'error', 'message' => 'Chat history tidak ditemukan'], 404);
                }

                // Update chat yang ada
                $messages = $chatHistory->messages;
                $messages[] = ['role' => 'user', 'content' => $message];
                $messages[] = ['role' => 'assistant', 'content' => $aiResponse];

                $chatHistory->update([
                    'last_message' => $aiResponse,
                    'messages' => $messages,
                    'last_interaction' => now()
                ]);
            } else {
                // Buat chat history baru setelah ada respons AI
                $chatHistory = ChatHistory::create([
                    'user_id' => $user->id,
                    'title' => Str::limit($message, 50),
                    'last_message' => $aiResponse,
                    'messages' => array_merge($messages, [['role' => 'assistant', 'content' => $aiResponse]]),
                    'last_interaction' => now()
                ]);
            }

            return response()->json([
                'status' => 'success',
                'message' => $aiResponse,
                'chatId' => $chatHistory->id,
                'chatHistory' => [ // Tambahkan data untuk update sidebar
                    'id' => $chatHistory->id,
                    'title' => $chatHistory->title,
                    'last_interaction' => $chatHistory->last_interaction->diffForHumans()
                ]
            ]);
        } catch (\Exception $e) {
            \Log::error('Chat Error', ['message' => $e->getMessage()]);
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    private function getAIResponse($message)
    {
        try {
            // Periksa apakah pertanyaan terkait kesehatan
            if (!$this->isHealthRelated($message)) {
                $greetingResponse = "Halo! Saya adalah asisten kesehatan AI yang siap membantu Anda dengan informasi seputar kesehatan. Silakan tanyakan tentang gejala penyakit, informasi medis umum, atau topik kesehatan lainnya. Apa yang ingin Anda ketahui?";
                return $greetingResponse;
            }
            
            // Dapatkan dataset Indonesia yang relevan dengan pertanyaan
            $relevantContext = $this->getRelevantMedicalContext($message);
            
            // Peningkatan kontekstualisasi untuk model AI
            $contextualizedMessage = $this->getContextualizedMessage($message, $relevantContext);

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'x-goog-api-key' => config('services.gemini.api_key'),
            ])->post('https://generativelanguage.googleapis.com/v1/models/gemini-2.0-flash:generateContent', [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $contextualizedMessage]
                        ]
                    ]
                ],
                'generationConfig' => [
                    'temperature' => 0.7,
                    'maxOutputTokens' => 1000,
                ]
            ]);

            if ($response->successful()) {
                $responseData = $response->json();
                
                if (isset($responseData['candidates'][0]['content']['parts'][0]['text'])) {
                    // Validasi respons
                    if (!$this->responseValidator->validateResponse($message, $responseData['candidates'][0]['content']['parts'][0]['text'])) {
                        throw new AIServiceException('Format respons tidak valid');
                    }

                    return $responseData['candidates'][0]['content']['parts'][0]['text'];
                }

                throw new AIServiceException('Format respons tidak valid dari Gemini API');
            }

            // Log error lengkap
            \Log::error('Gemini API Error', [
                'status' => $response->status(),
                'response' => $response->json(),
                'headers' => $response->headers(),
                'body' => $response->body()
            ]);

            $errorMessage = $response->json()['error']['message'] ?? 'Unknown error';
            throw new AIServiceException($errorMessage);

        } catch (\Exception $e) {
            \Log::error('AI Service Error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            throw new AIServiceException('Tidak dapat terhubung ke layanan AI');
        }
    }

    /**
     * Mendapatkan konteks medis relevan dari dataset Indonesia
     */
    private function getRelevantMedicalContext($message)
    {
        $context = '';
        $datasets = $this->medicalDataset->getIndonesianMedicalDatasets();
        
        // Cek penyakit tropis
        foreach ($datasets['penyakit_tropis'] as $code => $disease) {
            if (stripos($message, $disease['nama']) !== false || stripos($message, $code) !== false) {
                $context .= "Informasi tentang {$disease['nama']}: ";
                $context .= "Gejala umum meliputi " . implode(', ', $disease['gejala']) . ". ";
                $context .= "Prevalensi: {$disease['prevalensi']}. ";
                $context .= "Faktor risiko meliputi " . implode(', ', $disease['faktor_risiko']) . ". ";
                return $context;
            }
        }
        
        // Cek penyakit tidak menular
        foreach ($datasets['penyakit_tidak_menular'] as $code => $disease) {
            if (stripos($message, $disease['nama']) !== false || stripos($message, $code) !== false) {
                $context .= "Informasi tentang {$disease['nama']}: ";
                $context .= "Gejala umum meliputi " . implode(', ', $disease['gejala']) . ". ";
                $context .= "Prevalensi: {$disease['prevalensi']}. ";
                $context .= "Faktor risiko meliputi " . implode(', ', $disease['faktor_risiko']) . ". ";
                return $context;
            }
        }
        
        // Cek berdasarkan gejala
        $symptomToDisease = [];
        foreach ($datasets as $category => $diseases) {
            foreach ($diseases as $code => $disease) {
                if (isset($disease['gejala'])) {
                    foreach ($disease['gejala'] as $symptom) {
                        $symptomToDisease[$symptom][] = [
                            'nama' => $disease['nama'],
                            'code' => $code,
                            'category' => $category
                        ];
                    }
                }
            }
        }
        
        foreach ($symptomToDisease as $symptom => $relatedDiseases) {
            if (stripos($message, $symptom) !== false) {
                $context .= "Gejala '{$symptom}' dapat terkait dengan beberapa kondisi seperti: ";
                $diseaseNames = array_map(function($d) { return $d['nama']; }, $relatedDiseases);
                $context .= implode(', ', array_unique($diseaseNames)) . ". ";
                $context .= "Namun, diagnosis tepat memerlukan pemeriksaan medis profesional. ";
                return $context;
            }
        }
        
        return $context;
    }
    
    private function getContextualizedMessage($message, $relevantContext = '')
    {
        $isDescriptiveQuestion = false;
        foreach (QuestionPatterns::DESCRIPTIVE_PATTERNS as $pattern) {
            if (preg_match($pattern, strtolower($message))) {
                $isDescriptiveQuestion = true;
                break;
            }
        }

        if ($isDescriptiveQuestion) {
            $basePrompt = "Anda adalah asisten kesehatan AI. Berikan jawaban yang mengalir dengan struktur berikut (tanpa menampilkan label section):

            1. Definisi atau penjelasan umum (1-2 paragraf)

            2. Poin-poin penting yang perlu diketahui (1 paragraf)

            3. Ajukan 2-3 pertanyaan yang relevan untuk mendapatkan informasi lebih lanjut, format:
                1) Pertanyaan pertama?
                2) Pertanyaan kedua?
                3) (Opsional) Pertanyaan ketiga?

            Gunakan bahasa yang mudah dipahami dan informatif. Hindari jargon medis yang terlalu teknis. 
            Jika memberikan statistik atau data, pastikan menyebutkan sumbernya.

            Gunakan huruf tebal untuk istilah penting dengan format <b>istilah</b>.
            Gunakan format <b>poin penting</b> untuk penekanan penting.
            Hindari penggunaan simbol asterisk (*), hashtag (#), dan simbol lainnya.
            Berikan jawaban dalam format yang rapi dan mudah dibaca.";
        } else {
            $basePrompt = "Anda adalah asisten kesehatan AI. Berikan jawaban yang mengalir dengan struktur berikut (tanpa menampilkan label section):

            1. Mulai dengan tanggapan empatik dan personal terhadap keluhan/pertanyaan pengguna (1-2 kalimat). Lanjutkan dengan penjelasan ringkas tentang kondisi atau topik yang ditanyakan (2-3 kalimat)
            
            2. Ajukan 2-3 pertanyaan yang relevan untuk memahami kondisi lebih baik, format:
                1) Pertanyaan pertama?
                2) Pertanyaan kedua?
                3) (Opsional) Pertanyaan ketiga?
            
            3. Akhiri dengan satu kalimat penutup tindak lanjut yang harus dilakukan.

            Berikan jawaban yang mengalir secara natural tanpa menampilkan label section. Gunakan bahasa yang ramah dan mudah dipahami. Hindari memberikan diagnosis spesifik atau resep obat.
            
            Gunakan huruf tebal untuk istilah penting dengan format <b>kata kunci</b>.
            Gunakan format <b>poin penting</b> untuk penekanan penting.
            Hindari penggunaan simbol asterisk (*), hashtag (#), dan simbol lainnya.
            Berikan jawaban dalam format yang rapi dan mudah dibaca.";
        }
        
        if (!empty($relevantContext)) {
            $basePrompt .= "\n\nGunakan informasi medis berikut sebagai referensi: " . $relevantContext;
        }
        
        $basePrompt .= "\n\nPertanyaan pengguna: " . $message . "\n\nBerikan jawaban sesuai format di atas.";
        
        return $basePrompt;
    }

    public function show($id)
    {
        \Log::info('show: Mencoba mengambil riwayat obrolan dengan ID', ['chatId' => $id]); // Tambahkan log
        try {
            $chatHistory = ChatHistory::findOrFail($id);
            \Log::info('show: Riwayat obrolan berhasil ditemukan', ['chatHistoryId' => $chatHistory->id]); // Tambahkan log

            if ($chatHistory->user_id !== auth()->id()) {
                throw new \Exception('Tidak memiliki akses ke chat ini');
            }

            return response()->json([
                'status' => 'success',
                'messages' => $chatHistory->messages
            ]);
        } catch (\Exception $e) {
            \Log::error('show: Gagal mengambil riwayat obrolan', ['chatId' => $id, 'error' => $e->getMessage()]); // Tambahkan log error
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 404);
        }
    }

    public function getHistories()
    {
        \Log::info('getHistories: Memulai pengambilan riwayat obrolan');
        $histories = Auth::user()->chatHistories()
            ->latest('last_interaction')
            ->get();
        \Log::info('getHistories: Riwayat obrolan berhasil diambil', ['jumlah_riwayat' => $histories->count()]);

        return view('partials.chat-histories', [
            'histories' => $histories
        ])->render();
    }

    public function deleteChat($id)
    {
        try {
            $chatHistory = ChatHistory::findOrFail($id);

            if ($chatHistory->user_id !== auth()->id()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Anda tidak memiliki akses untuk menghapus chat ini'
                ], 403);
            }

            $chatHistory->delete();
            \Log::info('deleteChat: Chat berhasil dihapus', ['chatId' => $id]);

            return response()->json([
                'status' => 'success',
                'message' => 'Chat berhasil dihapus'
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            \Log::error('deleteChat: Chat tidak ditemukan', ['chatId' => $id]);
            return response()->json([
                'status' => 'error',
                'message' => 'Riwayat chat tidak ditemukan'
            ], 404);
        } catch (\Exception $e) {
            \Log::error('deleteChat: Gagal menghapus chat', ['chatId' => $id, 'error' => $e->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menghapus chat'
            ], 500);
        }
    }

    public function deleteLastMessage($chatId)
    {
        try {
            // Ambil chat history berdasarkan ID
            $chatHistory = ChatHistory::where('id', $chatId)
                                    ->where('user_id', auth()->id())
                                    ->first();
            
            if (!$chatHistory) {
                return response()->json(['message' => 'Chat history tidak ditemukan'], 404);
            }
            
            // Ambil messages dari chat history
            $messages = $chatHistory->messages;
            
            // Jika ini adalah pesan pertama/satu-satunya, hapus seluruh chat
            if (count($messages) <= 1) {
                $chatHistory->delete();
                return response()->json([
                    'success' => true,
                    'chatDeleted' => true,
                    'message' => 'Chat dihapus sepenuhnya'
                ]);
            }
            
            // Hapus pesan terakhir (pesan user)
            array_pop($messages);
            
            // Jika masih ada pesan AI sebelumnya, gunakan sebagai last_message
            // Jika tidak, gunakan string kosong
            $lastMessage = '';
            if (!empty($messages)) {
                $lastMessage = end($messages)['content'] ?? '';
            }
            
            // Update chat history
            $chatHistory->update([
                'messages' => $messages,
                'last_message' => $lastMessage,
                'last_interaction' => now()
            ]);
            
            return response()->json([
                'success' => true,
                'chatDeleted' => false,
                'message' => 'Pesan terakhir berhasil dihapus'
            ]);
            
        } catch (\Exception $e) {
            \Log::error('Delete Last Message Error', ['message' => $e->getMessage()]);
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    private function isHealthRelated($message)
    {
        // Cek apakah pesan mengandung sapaan
        $lowercaseMessage = strtolower($message);
        foreach (Greetings::getKeywords() as $greeting) {
            if (stripos($lowercaseMessage, $greeting) !== false) {
                return true;
            }
        }

        // Periksa apakah ada kata kunci kesehatan dalam pesan
        foreach (HealthKeywords::getKeywords() as $keyword) {
            if (stripos($lowercaseMessage, $keyword) !== false) {
                return true;
            }
        }
        
        return false;
    }
}



