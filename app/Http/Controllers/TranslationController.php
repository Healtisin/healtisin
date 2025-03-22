<?php

namespace App\Http\Controllers;

use App\Services\TranslationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TranslationController extends Controller
{
    protected $translationService;

    public function __construct(TranslationService $translationService)
    {
        $this->translationService = $translationService;
    }

    /**
     * Menerjemahkan teks dari Bahasa Indonesia ke Bahasa Inggris
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function translateIdToEn(Request $request): JsonResponse
    {
        $request->validate([
            'text' => 'required|string',
        ]);

        $result = $this->translationService->translateIdToEn($request->input('text'));

        return response()->json($result);
    }

    /**
     * Menerjemahkan teks dari Bahasa Inggris ke Bahasa Indonesia
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function translateEnToId(Request $request): JsonResponse
    {
        $request->validate([
            'text' => 'required|string',
        ]);

        $result = $this->translationService->translateEnToId($request->input('text'));

        return response()->json($result);
    }
} 