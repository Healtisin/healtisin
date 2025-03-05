<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function change(Request $request)
    {
        $request->validate([
            'language' => 'required|string|size:2'
        ]);

        if (!array_key_exists($request->language, config('app.available_languages'))) {
            return response()->json(['message' => 'Bahasa tidak tersedia'], 400);
        }

        App::setLocale($request->language);
        Session::put('locale', $request->language);
        
        // Tambahkan cookie untuk menyimpan preferensi bahasa user
        cookie()->queue('user_locale', $request->language, 43200); // 30 hari
        
        return response()->json([
            'status' => 'success',
            'message' => 'Bahasa berhasil diubah'
        ]);
    }
}