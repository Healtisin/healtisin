<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class TranslationService
{
    private $client;
    private $apiKey;
    private $apiHost;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = '8453bd6d03msh7a8a620d049ee38p1fa2cejsnaf4d5b78a39b';
        $this->apiHost = 'simple-translate2.p.rapidapi.com';
    }

    /**
     * Menerjemahkan teks dari Bahasa Indonesia ke Bahasa Inggris
     *
     * @param string $text Teks yang akan diterjemahkan
     * @return array Data hasil terjemahan
     * @throws GuzzleException
     */
    public function translateIdToEn(string $text): array
    {
        try {
            $response = $this->client->request('POST', 'https://simple-translate2.p.rapidapi.com/translate?source_lang=id&target_lang=en', [
                'body' => json_encode(['sourceText' => $text]),
                'headers' => [
                    'Content-Type' => 'application/json',
                    'x-rapidapi-host' => $this->apiHost,
                    'x-rapidapi-key' => $this->apiKey,
                ],
            ]);

            return json_decode($response->getBody(), true);
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
     *
     * @param string $text Teks yang akan diterjemahkan
     * @return array Data hasil terjemahan
     * @throws GuzzleException
     */
    public function translateEnToId(string $text): array
    {
        try {
            $response = $this->client->request('POST', 'https://simple-translate2.p.rapidapi.com/translate?source_lang=en&target_lang=id', [
                'body' => json_encode(['sourceText' => $text]),
                'headers' => [
                    'Content-Type' => 'application/json',
                    'x-rapidapi-host' => $this->apiHost,
                    'x-rapidapi-key' => $this->apiKey,
                ],
            ]);

            return json_decode($response->getBody(), true);
        } catch (GuzzleException $e) {
            // Log error
            return [
                'error' => true,
                'message' => $e->getMessage(),
            ];
        }
    }
} 