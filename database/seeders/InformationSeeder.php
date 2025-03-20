<?php

namespace Database\Seeders;

use App\Models\Information;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cek apakah sudah ada data informasi
        if (Information::count() === 0) {
            Information::create([
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
        }
    }
}
