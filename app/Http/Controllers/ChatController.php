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
            $chatId = $request->chatId; // Ambil chatId dari request

            \Log::info('sendMessage: chatId diterima dari request', ['chatId' => $chatId]); // Tambahkan log

            $chatHistory = null;
            if ($chatId) {
                // Cari riwayat obrolan yang ada berdasarkan chatId
                $chatHistory = ChatHistory::where('id', $chatId)
                    ->where('user_id', $user->id)
                    ->first();

                \Log::info('sendMessage: Hasil pencarian ChatHistory berdasarkan chatId', ['chatHistory' => $chatHistory]); // Tambahkan log

                if (!$chatHistory) {
                    return response()->json(['status' => 'error', 'message' => 'Chat history tidak ditemukan'], 404);
                }
            }

            if (!$chatHistory) {
                // Buat chat history baru jika tidak ada chatId atau tidak ditemukan
                $chatHistory = ChatHistory::create([
                    'user_id' => $user->id,
                    'title' => Str::limit($message, 50),
                    'last_message' => $message,
                    'messages' => [['role' => 'user', 'content' => $message]],
                    'last_interaction' => now()
                ]);
                \Log::info('sendMessage: Chat history baru dibuat', ['chatHistoryId' => $chatHistory->id]); // Tambahkan log
            } else {
                // Update chat yang ada
                $messages = $chatHistory->messages;
                $messages[] = ['role' => 'user', 'content' => $message];

                $chatHistory->update([
                    'last_message' => $message,
                    'messages' => $messages,
                    'last_interaction' => now()
                ]);
                \Log::info('sendMessage: Chat history yang ada diperbarui', ['chatHistoryId' => $chatHistory->id]); // Tambahkan log
            }

            // Proses dan simpan respons AI
            $aiResponse = $this->getAIResponse($message);
            $messages = $chatHistory->messages;
            $messages[] = ['role' => 'assistant', 'content' => $aiResponse];

            $chatHistory->update([
                'messages' => $messages,
                'last_message' => $aiResponse,
                'last_interaction' => now()
            ]);
            \Log::info('sendMessage: Respons AI ditambahkan dan chat history diperbarui', ['chatHistoryId' => $chatHistory->id]); // Tambahkan log

            return response()->json([
                'status' => 'success',
                'message' => $aiResponse,
                'chatId' => $chatHistory->id // Kirim chatId kembali ke client
            ]);
        } catch (\Exception $e) {
            \Log::error('Chat Error', ['message' => $e->getMessage()]);
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    private function getAIResponse($message)
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post('https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=' . config('services.gemini.api_key'), [
            'contents' => [
                [
                    'parts' => [
                        ['text' => $message]
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
                return $responseData['candidates'][0]['content']['parts'][0]['text'];
            }

            throw new \Exception('Format respons tidak valid');
        }

        \Log::error('Gemini API Error', [
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
