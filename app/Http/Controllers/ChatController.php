<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\ChatHistory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function sendMessage(Request $request)
    {
        try {
            $message = $request->message;
            $user = auth()->user();
            
            // Gunakan currentChatId jika ada
            $chatHistory = null;
            if ($request->has('chatId')) {
                $chatHistory = ChatHistory::where('id', $request->chatId)
                                        ->where('user_id', $user->id)
                                        ->first();
            }
            
            if (!$chatHistory) {
                // Buat chat history baru
                $chatHistory = ChatHistory::create([
                    'user_id' => $user->id,
                    'title' => Str::limit($message, 50),
                    'last_message' => $message,
                    'messages' => [['role' => 'user', 'content' => $message]],
                    'last_interaction' => now()
                ]);
            } else {
                // Update chat yang ada
                $messages = $chatHistory->messages;
                $messages[] = ['role' => 'user', 'content' => $message];
                
                $chatHistory->update([
                    'last_message' => $message,
                    'messages' => $messages,
                    'last_interaction' => now()
                ]);
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

            return response()->json([
                'status' => 'success',
                'message' => $aiResponse,
                'chatId' => $chatHistory->id
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
        ])->post('https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key=' . config('services.gemini.api_key'), [
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
        try {
            $chatHistory = ChatHistory::findOrFail($id);
            
            if ($chatHistory->user_id !== auth()->id()) {
                throw new \Exception('Tidak memiliki akses ke chat ini');
            }

            return response()->json([
                'status' => 'success',
                'messages' => $chatHistory->messages
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 404);
        }
    }

    public function storeHistory(Request $request)
    {
        try {
            $chatHistory = ChatHistory::create([
                'user_id' => auth()->id(),
                'title' => $request->title,
                'last_message' => $request->last_message,
                'messages' => $request->messages,
                'last_interaction' => now()
            ]);

            return response()->json([
                'status' => 'success',
                'id' => $chatHistory->id
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function getHistories()
    {
        $histories = Auth::user()->chatHistories()
            ->latest('last_interaction')
            ->get();
        
        return view('partials.chat-histories', compact('histories'));
    }

    public function deleteChat($id)
    {
        try {
            $chatHistory = ChatHistory::findOrFail($id);
            
            if ($chatHistory->user_id !== auth()->id()) {
                throw new \Exception('Tidak memiliki akses ke chat ini');
            }

            $chatHistory->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Chat berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 404);
        }
    }
}

