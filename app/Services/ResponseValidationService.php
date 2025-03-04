<?php

namespace App\Services;

use App\Constants\QuestionPatterns;
use App\Constants\HealthKeywords;

class ResponseValidationService
{
    public function validateResponse($message, $response)
    {
        // Tahap 1: Validasi Dasar
        if (!$this->validateBasicResponse($response)) {
            return false;
        }

        // Tahap 2: Validasi Konteks Kesehatan
        if (!$this->validateHealthContext($message, $response)) {
            return false;
        }

        // Tahap 3: Validasi Format
        if (!$this->validateFormat($response)) {
            return false;
        }

        return true;
    }

    private function validateBasicResponse($response)
    {
        // Periksa apakah respons tidak kosong dan memiliki panjang minimal
        if (empty($response) || strlen($response) < 50) {
            return false;
        }

        // Periksa apakah respons tidak mengandung konten yang tidak diinginkan
        $blacklistedWords = ['error', 'undefined', 'null', 'exception'];
        foreach ($blacklistedWords as $word) {
            if (stripos($response, $word) !== false) {
                return false;
            }
        }

        return true;
    }

    private function validateHealthContext($message, $response)
    {
        // Gunakan pola pertanyaan yang sudah ada
        $isDescriptiveQuestion = false;
        foreach (QuestionPatterns::DESCRIPTIVE_PATTERNS as $pattern) {
            if (preg_match($pattern, $message)) {
                $isDescriptiveQuestion = true;
                break;
            }
        }

        // Periksa apakah respons sesuai dengan konteks kesehatan
        $healthKeywords = HealthKeywords::getKeywords();
        $foundHealthTerms = 0;
        foreach ($healthKeywords as $keyword) {
            if (stripos($response, $keyword) !== false) {
                $foundHealthTerms++;
            }
        }

        return $foundHealthTerms >= 2;
    }

    private function validateFormat($response)
    {
        // Periksa format HTML tags
        if (!$this->validateHtmlTags($response)) {
            return false;
        }

        // Periksa struktur paragraf
        if (!$this->validateParagraphStructure($response)) {
            return false;
        }

        return true;
    }

    private function validateHtmlTags($response)
    {
        // Periksa keseimbangan tag <b>
        $openTags = substr_count($response, '<b>');
        $closeTags = substr_count($response, '</b>');
        
        return $openTags === $closeTags;
    }

    private function validateParagraphStructure($response)
    {
        // Minimal harus ada 2 paragraf
        $paragraphs = array_filter(explode("\n\n", $response));
        if (count($paragraphs) < 2) {
            return false;
        }

        // Periksa panjang paragraf
        foreach ($paragraphs as $paragraph) {
            if (strlen(trim($paragraph)) < 20) {
                return false;
            }
        }

        return true;
    }
}