<?php

namespace App\Helpers;

use App\Models\Information;
use Illuminate\Support\Facades\Cache;

class InformationHelper
{
    /**
     * Mendapatkan semua informasi website
     */
    public static function getAll()
    {
        return Cache::remember('site_information', 60*24, function () {
            return Information::first() ?? new Information([
                'website_name' => 'Healtisin',
                'product_name' => 'Healtisin AI',
                'website_description' => 'Selamat datang di era baru kesehatan digital. Healtisin AI hadir sebagai asisten kesehatan pintar Anda, menggabungkan teknologi AI mutakhir dengan kepedulian untuk memberikan layanan skrining kesehatan 24/7 yang akurat dan terpercaya.',
                'product_description' => 'Menghadirkan transformasi layanan kesehatan digital melalui integrasi AI mutakhir yang mampu menganalisis 1000+ kondisi medis, memberikan skrining kesehatan real-time, dan rekomendasi pengobatan yang dipersonalisasi untuk setiap pengguna.'
            ]);
        });
    }

    /**
     * Mendapatkan nama website
     */
    public static function getWebsiteName()
    {
        return self::getAll()->website_name;
    }

    /**
     * Mendapatkan nama produk
     */
    public static function getProductName()
    {
        return self::getAll()->product_name;
    }

    /**
     * Mendapatkan deskripsi website
     */
    public static function getWebsiteDescription()
    {
        return self::getAll()->website_description;
    }

    /**
     * Mendapatkan deskripsi produk
     */
    public static function getProductDescription()
    {
        return self::getAll()->product_description;
    }
} 