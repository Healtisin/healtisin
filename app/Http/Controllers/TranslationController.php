<?php

namespace App\Http\Controllers;

use App\Services\TranslationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
    
    /**
     * Menampilkan halaman pengaturan terjemahan
     * 
     * @return \Illuminate\View\View
     */
    public function settings()
    {
        $preservedWords = $this->loadPreservedWords();
        $corrections = $this->loadCorrections();
        
        return view('translation-settings', [
            'preservedWords' => $preservedWords,
            'idToEnCorrections' => $corrections['id_to_en'] ?? [],
            'enToIdCorrections' => $corrections['en_to_id'] ?? []
        ]);
    }
    
    /**
     * Menyimpan kata-kata yang dilindungi
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function savePreservedWords(Request $request): JsonResponse
    {
        $request->validate([
            'words' => 'required|array',
            'words.*' => 'string'
        ]);
        
        $words = array_unique(array_filter($request->input('words')));
        
        Storage::disk('local')->put('translation/preserved_words.json', json_encode($words));
        
        return response()->json(['success' => true, 'message' => 'Kata yang dilindungi berhasil disimpan']);
    }
    
    /**
     * Menyimpan koreksi terjemahan
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function saveCorrections(Request $request): JsonResponse
    {
        $request->validate([
            'id_to_en' => 'required|array',
            'en_to_id' => 'required|array'
        ]);
        
        $idToEn = $request->input('id_to_en');
        $enToId = $request->input('en_to_id');
        
        // Filter out empty values
        $idToEn = array_filter($idToEn, function($value, $key) {
            return !empty($key) && !empty($value);
        }, ARRAY_FILTER_USE_BOTH);
        
        $enToId = array_filter($enToId, function($value, $key) {
            return !empty($key) && !empty($value);
        }, ARRAY_FILTER_USE_BOTH);
        
        $corrections = [
            'id_to_en' => $idToEn,
            'en_to_id' => $enToId
        ];
        
        Storage::disk('local')->put('translation/corrections.json', json_encode($corrections));
        
        return response()->json(['success' => true, 'message' => 'Koreksi terjemahan berhasil disimpan']);
    }
    
    /**
     * Memuat daftar kata yang dilindungi dari penyimpanan
     * 
     * @return array
     */
    private function loadPreservedWords(): array
    {
        if (Storage::disk('local')->exists('translation/preserved_words.json')) {
            $content = Storage::disk('local')->get('translation/preserved_words.json');
            return json_decode($content, true) ?? [];
        }
        
        return [];
    }
    
    /**
     * Memuat daftar koreksi terjemahan dari penyimpanan
     * 
     * @return array
     */
    private function loadCorrections(): array
    {
        if (Storage::disk('local')->exists('translation/corrections.json')) {
            $content = Storage::disk('local')->get('translation/corrections.json');
            return json_decode($content, true) ?? [];
        }
        
        return [
            'id_to_en' => [],
            'en_to_id' => []
        ];
    }
} 