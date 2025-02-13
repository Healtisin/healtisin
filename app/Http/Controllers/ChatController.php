<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatController extends Controller
{
    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string'
        ]);

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post('https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key=' . config('services.gemini.api_key'), [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $request->message]
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
                    return response()->json([
                        'status' => 'success',
                        'message' => $responseData['candidates'][0]['content']['parts'][0]['text']
                    ]);
                }
                
                throw new \Exception('Format respons tidak valid');
            }

            \Log::error('Gemini API Error', [
                'status' => $response->status(),
                'response' => $response->json()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mendapatkan respons dari AI: ' . 
                    ($response->json()['error']['message'] ?? 'Unknown error')
            ], 500);

        } catch (\Exception $e) {
            \Log::error('Chat Error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
