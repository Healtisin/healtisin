<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Storage;

class TranslationService
{
    private $client;
    private $apiKey;
    private $apiHost;
    private $preservedWords = [];
    private $corrections = [];

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = '8453bd6d03msh7a8a620d049ee38p1fa2cejsnaf4d5b78a39b';
        $this->apiHost = 'simple-translate2.p.rapidapi.com';
        
        // Memuat kata-kata yang dilindungi dari file
        $this->loadPreservedWords();
        
        // Memuat koreksi terjemahan dari file
        $this->loadCorrections();
    }

    /**
     * Menerjemahkan teks dari Bahasa Indonesia ke Bahasa Inggris
     * dengan mempertahankan kata-kata tertentu
     *
     * @param string $text Teks yang akan diterjemahkan
     * @return array Data hasil terjemahan
     * @throws GuzzleException
     */
    public function translateIdToEn(string $text): array
    {
        // Simpan kata-kata khusus sebelum terjemahan
        $placeholders = [];
        $modifiedText = $this->replacePreservedWords($text, $placeholders);
        
        try {
            $response = $this->client->request('POST', 'https://simple-translate2.p.rapidapi.com/translate?source_lang=id&target_lang=en', [
                'body' => json_encode(['sourceText' => $modifiedText]),
                'headers' => [
                    'Content-Type' => 'application/json',
                    'x-rapidapi-host' => $this->apiHost,
                    'x-rapidapi-key' => $this->apiKey,
                ],
            ]);

            $result = json_decode($response->getBody(), true);
            
            // Kembalikan kata-kata khusus ke hasil terjemahan
            if (isset($result['targetText'])) {
                $result['targetText'] = $this->restorePreservedWords($result['targetText'], $placeholders);
            }
            
            // Perbaikan manual beberapa terjemahan yang sering salah
            if (isset($result['targetText'])) {
                $result['targetText'] = $this->fixCommonTranslationErrors($result['targetText'], 'en');
            }
            
            return $result;
        } catch (GuzzleException $e) {
            // Log error
            return [
                'error' => true,
                'message' => $e->getMessage(),
            ];
        }
    }

    /**
     * Menerjemahkan teks dari Bahasa Inggris ke Bahasa Indonesia
     * dengan mempertahankan kata-kata tertentu
     *
     * @param string $text Teks yang akan diterjemahkan
     * @return array Data hasil terjemahan
     * @throws GuzzleException
     */
    public function translateEnToId(string $text): array
    {
        // Simpan kata-kata khusus sebelum terjemahan
        $placeholders = [];
        $modifiedText = $this->replacePreservedWords($text, $placeholders);
        
        try {
            $response = $this->client->request('POST', 'https://simple-translate2.p.rapidapi.com/translate?source_lang=en&target_lang=id', [
                'body' => json_encode(['sourceText' => $modifiedText]),
                'headers' => [
                    'Content-Type' => 'application/json',
                    'x-rapidapi-host' => $this->apiHost,
                    'x-rapidapi-key' => $this->apiKey,
                ],
            ]);

            $result = json_decode($response->getBody(), true);
            
            // Kembalikan kata-kata khusus ke hasil terjemahan
            if (isset($result['targetText'])) {
                $result['targetText'] = $this->restorePreservedWords($result['targetText'], $placeholders);
            }
            
            // Perbaikan manual beberapa terjemahan yang sering salah
            if (isset($result['targetText'])) {
                $result['targetText'] = $this->fixCommonTranslationErrors($result['targetText'], 'id');
            }
            
            return $result;
        } catch (GuzzleException $e) {
            // Log error
            return [
                'error' => true,
                'message' => $e->getMessage(),
            ];
        }
    }
    
    /**
     * Mengganti kata-kata khusus dengan placeholder sebelum terjemahan
     * 
     * @param string $text Teks asli
     * @param array &$placeholders Array untuk menyimpan placeholder
     * @return string Teks yang sudah dimodifikasi
     */
    private function replacePreservedWords(string $text, array &$placeholders): string
    {
        $modifiedText = $text;
        
        foreach ($this->preservedWords as $index => $word) {
            $placeholder = "[[PRESERVED_WORD_" . $index . "]]";
            $placeholders[$placeholder] = $word;
            $modifiedText = str_replace($word, $placeholder, $modifiedText);
        }
        
        return $modifiedText;
    }
    
    /**
     * Mengembalikan kata-kata khusus ke hasil terjemahan
     * 
     * @param string $translatedText Hasil terjemahan
     * @param array $placeholders Array placeholder
     * @return string Teks terjemahan dengan kata-kata khusus yang sudah dikembalikan
     */
    private function restorePreservedWords(string $translatedText, array $placeholders): string
    {
        $restoredText = $translatedText;
        
        foreach ($placeholders as $placeholder => $originalWord) {
            $restoredText = str_replace($placeholder, $originalWord, $restoredText);
        }
        
        return $restoredText;
    }
    
    /**
     * Memperbaiki terjemahan umum yang sering salah
     * 
     * @param string $text Teks hasil terjemahan
     * @param string $targetLang Bahasa target ('id' atau 'en')
     * @return string Teks yang sudah diperbaiki
     */
    private function fixCommonTranslationErrors(string $text, string $targetLang): string
    {
        $fixedText = $text;
        
        if ($targetLang === 'en') {
            // Gunakan koreksi dari file untuk terjemahan Indonesia ke Inggris
            $corrections = $this->corrections['id_to_en'] ?? [
                'Berita' => 'News',
                'Paket' => 'Package',
                'Konsultasi' => 'Consultation',
                'Watching' => 'News',
                'direct appointment' => 'Package',
            ];
        } else {
            // Gunakan koreksi dari file untuk terjemahan Inggris ke Indonesia
            $corrections = $this->corrections['en_to_id'] ?? [
                'News' => 'Berita',
                'Package' => 'Paket',
                'Consultation' => 'Konsultasi',
            ];
        }
        
        foreach ($corrections as $wrong => $correct) {
            // Gunakan word boundary agar hanya kata utuh yang dikoreksi
            $fixedText = preg_replace('/\b' . preg_quote($wrong, '/') . '\b/i', $correct, $fixedText);
        }
        
        return $fixedText;
    }
    
    /**
     * Memuat daftar kata yang dilindungi dari penyimpanan
     */
    private function loadPreservedWords(): void
    {
        // Default preserved words
        $this->preservedWords = ['Healtisin', 'Healtisin AI'];
        
        if (Storage::disk('local')->exists('translation/preserved_words.json')) {
            $content = Storage::disk('local')->get('translation/preserved_words.json');
            $words = json_decode($content, true);
            
            if (is_array($words) && !empty($words)) {
                $this->preservedWords = $words;
            }
        }
    }
    
    /**
     * Memuat daftar koreksi terjemahan dari penyimpanan
     */
    private function loadCorrections(): void
    {
        // Default corrections
        $this->corrections = [
            'id_to_en' => [
                'Berita' => 'News',
                'Paket' => 'Package',
                'Konsultasi' => 'Consultation',
                'Watching' => 'News',
                'direct appointment' => 'Package',
            ],
            'en_to_id' => [
                'News' => 'Berita',
                'Package' => 'Paket',
                'Consultation' => 'Konsultasi',
            ]
        ];
        
        if (Storage::disk('local')->exists('translation/corrections.json')) {
            $content = Storage::disk('local')->get('translation/corrections.json');
            $corrections = json_decode($content, true);
            
            if (is_array($corrections) && !empty($corrections)) {
                if (isset($corrections['id_to_en']) && !empty($corrections['id_to_en'])) {
                    $this->corrections['id_to_en'] = array_merge($this->corrections['id_to_en'], $corrections['id_to_en']);
                }
                
                if (isset($corrections['en_to_id']) && !empty($corrections['en_to_id'])) {
                    $this->corrections['en_to_id'] = array_merge($this->corrections['en_to_id'], $corrections['en_to_id']);
                }
            }
        }
    }
} 