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
                'product_description' => 'Menghadirkan transformasi layanan kesehatan digital melalui integrasi AI mutakhir yang mampu menganalisis 1000+ kondisi medis, memberikan skrining kesehatan real-time, dan rekomendasi pengobatan yang dipersonalisasi untuk setiap pengguna.',
                'phone' => '+62 878-7156-3112',
                'whatsapp' => '087871563112',
                'email' => 'healtisin@gmail.com',
                'address' => 'Daerah Istimewa Yogyakarta',
                'map_coordinates' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3577.4427338793816!2d110.33130657455364!3d-7.768295577053469!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a5903b50524bd%3A0x9fa31ba154293dc1!2sUNISA%3A%20Gedung%20Siti%20Walidah!5e1!3m2!1sid!2sid!4v1741616874091!5m2!1sid!2sid'
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

    /**
     * Mendapatkan nomor telepon
     */
    public static function getPhone()
    {
        return self::getAll()->phone;
    }

    /**
     * Mendapatkan nomor WhatsApp
     */
    public static function getWhatsapp()
    {
        return self::getAll()->whatsapp;
    }

    /**
     * Mendapatkan alamat email
     */
    public static function getEmail()
    {
        return self::getAll()->email;
    }

    /**
     * Mendapatkan alamat
     */
    public static function getAddress()
    {
        return self::getAll()->address;
    }

    /**
     * Mendapatkan koordinat peta
     */
    public static function getMapCoordinates()
    {
        return self::getAll()->map_coordinates;
    }
} 