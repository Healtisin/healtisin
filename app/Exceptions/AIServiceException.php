<?php

namespace App\Exceptions;

use Exception;

class AIServiceException extends Exception
{
    public function render($request)
    {
        $errorMessage = 'Maaf, layanan AI sedang mengalami gangguan. ';
        
        if (stripos($this->getMessage(), 'Tidak dapat terhubung') !== false) {
            $errorMessage .= 'Tidak dapat terhubung ke layanan. Silakan coba beberapa saat lagi.';
        } else if (stripos($this->getMessage(), 'Format respons tidak valid') !== false) {
            $errorMessage .= 'Terjadi kesalahan format data. Tim teknis kami sedang menangani masalah ini.';
        } else {
            $errorMessage .= 'Silakan coba beberapa saat lagi.';
        }

        if ($request->expectsJson()) {
            return response()->json([
                'status' => 'error',
                'message' => $errorMessage
            ], 503);
        }

        return response()->view('errors.ai-service', [
            'message' => $errorMessage
        ], 503);
    }
}
