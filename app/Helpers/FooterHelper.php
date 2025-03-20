<?php

namespace App\Helpers;

use App\Models\Footer;

class FooterHelper
{
    /**
     * Mengambil data footer dari database
     * 
     * @return \App\Models\Footer
     */
    public static function getFooterData()
    {
        // Ambil data footer dari database, jika belum ada buat default
        $footer = Footer::first();
        
        if (!$footer) {
            $footer = new Footer();
            $footer->description = 'Healtisin, asisten AI kesehatan terdepan siap menjaga kesehatan Anda 24/7. Dapatkan skrining kesehatan yang cepat dan akurat dengan teknologi AI mutakhir kami.';
            $footer->phone = '+62 878-7156-3112';
            $footer->email = 'healtisin@gmail.com';
            $footer->location = 'Daerah Istimewa Yogyakarta';
            $footer->github_link = 'https://github.com/Healtisin';
            $footer->twitter_link = '#';
            $footer->copyright = '© 2025 Healtisin. All rights reserved.';
            $footer->save();
        }
        
        return $footer;
    }
} 