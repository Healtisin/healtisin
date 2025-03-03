<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\ChatHistory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\Models\Chat;

class ChatController extends Controller
{
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
        // Daftar kata kunci kesehatan
        $healthKeywords = [
            'sakit', 'nyeri', 'pusing', 'demam', 'batuk', 'flu', 'pilek',
            'mual', 'muntah', 'diare', 'penyakit', 'gejala', 'obat',
            'vitamin', 'vaksin', 'kesehatan', 'dokter', 'rumah sakit',
            'medis', 'pengobatan', 'terapi', 'diet', 'nutrisi', 'olahraga'
        ];

        // Cek apakah pertanyaan mengandung kata kunci kesehatan
        $isHealthRelated = false;
        foreach ($healthKeywords as $keyword) {
            if (stripos($message, $keyword) !== false) {
                $isHealthRelated = true;
                break;
            }
        }

        if (!$isHealthRelated) {
            return "Maaf, saya hanya dapat menjawab pertanyaan seputar kesehatan. Silakan ajukan pertanyaan terkait kesehatan, gejala penyakit, atau informasi medis umum.";
        }

        // Tambahkan konteks untuk AI
        $systemPrompt = "Anda adalah asisten AI kesehatan bernama Healtisin. Berikan informasi medis umum tanpa memberikan diagnosis spesifik atau resep obat. Selalu ingatkan pengguna untuk berkonsultasi dengan dokter untuk masalah kesehatan serius.";
        
        // Panggil API Deepseek
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . config('services.deepseek.api_key'),
        ])->post(config('services.deepseek.base_url') . '/chat/completions', [
            'model' => config('services.deepseek.model'),
            'messages' => [
                [
                    'role' => 'system',
                    'content' => $systemPrompt
                ],
                [
                    'role' => 'user',
                    'content' => $message
                ]
            ],
            'temperature' => 0.7,
            'max_tokens' => 1000,
        ]);

        if ($response->successful()) {
            $responseData = $response->json();

            if (isset($responseData['choices'][0]['message']['content'])) {
                return $responseData['choices'][0]['message']['content'];
            }

            throw new \Exception('Format respons tidak valid');
        }

        \Log::error('Deepseek API Error', [
            'status' => $response->status(),
            'response' => $response->json()
        ]);

        throw new \Exception('Gagal mendapatkan respons dari AI: ' .
            ($response->json()['error']['message'] ?? 'Unknown error'));
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
}
