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
use Exception;

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
            $aiResponse = $this->getAIResponse($message, $chatId);
            
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
                'chatHistory' => [
                    'id' => $chatHistory->id,
                    'title' => $chatHistory->title,
                    'last_interaction' => $chatHistory->last_interaction->diffForHumans()
                ]
            ]);
        } catch (\Exception $e) {
            return $this->handleError($e, $request, 'Gagal mengirim pesan');
        }
    }

    private function getAIResponse($message, $chatId = null)
    {
        try {
            // Dapatkan konteks percakapan sebelumnya jika ada
            $conversationContext = '';
            if ($chatId) {
                $chatHistory = ChatHistory::find($chatId);
                if ($chatHistory) {
                    // Ambil 3 pertukaran pesan terakhir untuk konteks
                    $recentMessages = array_slice($chatHistory->messages, -6);
                    foreach ($recentMessages as $msg) {
                        $conversationContext .= "{$msg['role']}: {$msg['content']}\n";
                    }
                }
            }

            // Dapatkan dataset medis yang relevan
            $relevantContext = $this->getRelevantMedicalContext($message);
            
            // Gabungkan konteks percakapan dengan prompt
            $contextualizedMessage = $this->getContextualizedMessage(
                $message,
                $relevantContext,
                $conversationContext
            );

            // Kirim ke Gemini API dengan konteks lengkap
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
    
    private function getContextualizedMessage($message, $relevantContext = '', $conversationContext = '')
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

            1. Mulai dengan memberikan feedback yang sesuai (Bersifat opsional dan jika digunakan buat dalam 1-2 kalimat). Lanjutkan dengan penjelasan ringkas tentang kondisi atau topik yang ditanyakan (Wajib dan buat dalam 2-3 kalimat)
            
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
        
        if (!empty($conversationContext)) {
            $basePrompt .= "\n\nKonteks percakapan sebelumnya:\n" . $conversationContext;
        }
        
        if (!empty($relevantContext)) {
            $basePrompt .= "\n\nInformasi medis relevan:\n" . $relevantContext;
        }
        
        $basePrompt .= "\n\nPertanyaan pengguna: " . $message;
        $basePrompt .= "\n\nBerikan jawaban yang koheren dan terhubung dengan konteks percakapan sebelumnya jika relevan.";
        
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
            return $this->handleError($e, request(), 'Gagal mengakses riwayat chat');
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
                throw new \Exception('Anda tidak memiliki akses untuk menghapus chat ini');
            }

            $chatHistory->delete();
            \Log::info('deleteChat: Chat berhasil dihapus', ['chatId' => $id]);

            return response()->json([
                'status' => 'success',
                'message' => 'Chat berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return $this->handleError($e, request(), 'Gagal menghapus chat');
        }
    }

    public function deleteLastMessage($chatId)
    {
        try {
            // Ambil chat history berdasarkan ID
            $chatHistory = ChatHistory::where('id', $chatId)
                                    ->where('user_id', auth()->id())
                                    ->firstOrFail();
            
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
            return $this->handleError($e, request(), 'Gagal menghapus pesan terakhir');
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

    private function handleError(\Exception $e, $request, $defaultMessage)
    {
        // Log error asli untuk debugging
        \Log::error('Chat Error', [
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);

        // Tentukan pesan yang user-friendly berdasarkan jenis error
        $userMessage = $this->getUserFriendlyErrorMessage($e);

        if ($request->expectsJson()) {
            return response()->json([
                'status' => 'error',
                'message' => $userMessage
            ], $this->getErrorStatusCode($e));
        }

        // Redirect ke halaman error yang sesuai
        return redirect()->route('error.show')->with('error', $userMessage);
    }

    private function getUserFriendlyErrorMessage(\Exception $e)
    {
        // Mapping pesan error teknis ke pesan yang user-friendly
        $errorMessages = [
            'Tidak dapat terhubung ke layanan AI' => 'Maaf, layanan AI sedang tidak tersedia. Silakan coba beberapa saat lagi.',
            'Format respons tidak valid' => 'Maaf, kami mengalami kendala teknis. Tim kami sedang menangani masalah ini.',
            'Chat history tidak ditemukan' => 'Riwayat chat tidak ditemukan atau telah dihapus.',
            'Tidak memiliki akses ke chat ini' => 'Anda tidak memiliki akses ke percakapan ini.',
            'DEADLINE_EXCEEDED' => 'Maaf, permintaan Anda membutuhkan waktu terlalu lama. Silakan coba lagi.',
            'UNAVAILABLE' => 'Layanan sedang dalam pemeliharaan. Silakan coba beberapa saat lagi.'
        ];

        $message = $e->getMessage();
        foreach ($errorMessages as $technical => $friendly) {
            if (stripos($message, $technical) !== false) {
                return $friendly;
            }
        }

        // Default error message
        return 'Maaf, terjadi kesalahan. Silakan coba beberapa saat lagi.';
    }

    private function getErrorStatusCode(\Exception $e)
    {
        if ($e instanceof AIServiceException) {
            return 503; // Service Unavailable
        }
        if (stripos($e->getMessage(), 'tidak ditemukan') !== false) {
            return 404; // Not Found
        }
        if (stripos($e->getMessage(), 'tidak memiliki akses') !== false) {
            return 403; // Forbidden
        }
        return 500; // Internal Server Error
    }

    public function regenerate(Request $request)
    {
        try {
            $message = $request->message;
            $chatId = $request->chatId;
            
            // Validasi chat history
            $chatHistory = ChatHistory::where('id', $chatId)
                ->where('user_id', auth()->id())
                ->first();
                
            if (!$chatHistory || empty($chatHistory->messages)) {
                throw new \Exception('Tidak dapat menemukan riwayat chat');
            }
            
            // Ambil pesan terakhir user dari messages array
            $messages = $chatHistory->messages;
            $lastUserMessageIndex = null;
            
            // Cari pesan user terakhir dari array messages
            for ($i = count($messages) - 1; $i >= 0; $i--) {
                if ($messages[$i]['role'] === 'user') {
                    $lastUserMessageIndex = $i;
                    break;
                }
            }
            
            if ($lastUserMessageIndex === null) {
                throw new \Exception('Tidak dapat menemukan pesan terakhir user');
            }
            
            $lastUserMessage = $messages[$lastUserMessageIndex]['content'];
            
            // Generate respons AI baru
            $newResponse = $this->getAIResponse($lastUserMessage, $chatId);
            
            // Update chat history
            if ($lastUserMessageIndex < count($messages) - 1) {
                // Hapus respons AI sebelumnya
                array_pop($messages);
            }
            
            // Tambahkan respons baru
            $messages[] = ['role' => 'assistant', 'content' => $newResponse];
            
            $chatHistory->update([
                'last_message' => $newResponse,
                'messages' => $messages,
                'last_interaction' => now()
            ]);
            
            return response()->json([
                'status' => 'success',
                'message' => $newResponse
            ]);
            
        } catch (\Exception $e) {
            return $this->handleError($e, $request, 'Gagal meregenerasi jawaban');
        }
    }

    public function editMessage(Request $request)
    {
        try {
            $chatId = $request->chatId;
            $messageIndex = $request->messageIndex;
            $newContent = $request->newContent;
            
            // Validasi input
            if (!$chatId || !isset($messageIndex) || !$newContent) {
                throw new Exception('Parameter tidak lengkap');
            }
            
            $chatHistory = ChatHistory::where('id', $chatId)
                ->where('user_id', auth()->id())
                ->firstOrFail();
                
            $messages = $chatHistory->messages;
            
            // Debug log untuk melihat nilai messageIndex dan messages
            \Log::info('Edit Message Request', [
                'chatId' => $chatId,
                'messageIndex' => $messageIndex,
                'newContent' => $newContent,
                'messages_count' => count($messages)
            ]);
            
            // Update pesan
            if (isset($messages[$messageIndex]) && $messages[$messageIndex]['role'] === 'user') {
                // Simpan konten asli
                $originalContent = $messages[$messageIndex]['content'];
                
                // Jika konten sama, tidak perlu diupdate
                if ($originalContent === $newContent) {
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Tidak ada perubahan pada pesan'
                    ]);
                }
                
                // Update pesan user
                $messages[$messageIndex]['content'] = $newContent;
                
                // Hapus semua pesan setelah pesan yang diedit
                $messages = array_slice($messages, 0, $messageIndex + 1);
                
                // Generate respons AI baru
                $newAIResponse = $this->getAIResponse($newContent, $chatId);
                
                // Tambahkan respons AI baru
                $messages[] = ['role' => 'assistant', 'content' => $newAIResponse];
                
                // Update chat history
                $chatHistory->update([
                    'messages' => $messages,
                    'last_message' => $newAIResponse,
                    'last_interaction' => now()
                ]);
                
                return response()->json([
                    'status' => 'success',
                    'aiResponse' => $newAIResponse
                ]);
            }
            
            throw new Exception('Pesan tidak ditemukan atau bukan pesan user');
            
        } catch (Exception $e) {
            \Log::error('Edit Message Error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);
        }
    }
}











