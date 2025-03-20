<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Information;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class InformationController extends Controller
{
    /**
     * Menampilkan halaman pengaturan informasi.
     */
    public function index()
    {
        $information = Information::first() ?? new Information([
            'website_name' => 'Healtisin',
            'product_name' => 'Healtisin AI',
            'website_description' => 'Selamat datang di era baru kesehatan digital. Healtisin AI hadir sebagai asisten kesehatan pintar Anda, menggabungkan teknologi AI mutakhir dengan kepedulian untuk memberikan layanan skrining kesehatan 24/7 yang akurat dan terpercaya.',
            'product_description' => 'Menghadirkan transformasi layanan kesehatan digital melalui integrasi AI mutakhir yang mampu menganalisis 1000+ kondisi medis, memberikan skrining kesehatan real-time, dan rekomendasi pengobatan yang dipersonalisasi untuk setiap pengguna.'
        ]);

        return view('admin.information.index', compact('information'));
    }

    /**
     * Menyimpan data informasi.
     */
    public function update(Request $request)
    {
        $request->validate([
            'website_name' => 'required|string|max:255',
            'product_name' => 'required|string|max:255',
            'website_description' => 'nullable|string',
            'product_description' => 'nullable|string',
        ]);

        $information = Information::first();
        
        if (!$information) {
            $information = new Information();
        }

        $information->website_name = $request->website_name;
        $information->product_name = $request->product_name;
        $information->website_description = $request->website_description;
        $information->product_description = $request->product_description;
        $information->save();

        // Hapus cache jika ada
        Cache::forget('site_information');

        return redirect()->route('admin.information.index')->with('success', 'Informasi website berhasil diperbarui');
    }
}
