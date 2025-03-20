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
            'product_description' => 'Menghadirkan transformasi layanan kesehatan digital melalui integrasi AI mutakhir yang mampu menganalisis 1000+ kondisi medis, memberikan skrining kesehatan real-time, dan rekomendasi pengobatan yang dipersonalisasi untuk setiap pengguna.',
            'phone' => '+62 878-7156-3112',
            'whatsapp' => '087871563112',
            'email' => 'healtisin@gmail.com',
            'address' => 'Daerah Istimewa Yogyakarta',
            'map_coordinates' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3577.4427338793816!2d110.33130657455364!3d-7.768295577053469!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a5903b50524bd%3A0x9fa31ba154293dc1!2sUNISA%3A%20Gedung%20Siti%20Walidah!5e1!3m2!1sid!2sid!4v1741616874091!5m2!1sid!2sid'
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
            'phone' => 'nullable|string|max:255',
            'whatsapp' => 'nullable|string|max:255',
            'email' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'map_coordinates' => 'nullable|string',
        ]);

        $information = Information::first();
        
        if (!$information) {
            $information = new Information();
        }

        $information->website_name = $request->website_name;
        $information->product_name = $request->product_name;
        $information->website_description = $request->website_description;
        $information->product_description = $request->product_description;
        $information->phone = $request->phone;
        $information->whatsapp = $request->whatsapp;
        $information->email = $request->email;
        $information->address = $request->address;
        $information->map_coordinates = $request->map_coordinates;
        $information->save();

        // Hapus cache jika ada
        Cache::forget('site_information');

        return redirect()->route('admin.information.index')->with('success', 'Informasi website berhasil diperbarui');
    }
}
