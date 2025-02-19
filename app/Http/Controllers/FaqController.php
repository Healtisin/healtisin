<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        // Mengubah array menjadi object dengan stdClass
        $faqs = collect(array_map(function ($item) {
            $faq = new \stdClass();
            $faq->id = $item['id'];
            $faq->question = $item['question'];
            $faq->answer = $item['answer'];
            return $faq;
        }, [
            [
                'id' => 1,
                'question' => 'Apa itu Healtisin AI?',
                'answer' => 'Healtisin AI adalah platform kesehatan digital yang menggunakan kecerdasan buatan untuk membantu Anda mendapatkan informasi kesehatan yang akurat dan terpercaya. Platform ini menyediakan konsultasi kesehatan, artikel kesehatan, dan fitur-fitur inovatif lainnya.'
            ],
            [
                'id' => 2,
                'question' => 'Bagaimana cara menggunakan Healtisin AI?',
                'answer' => 'Untuk menggunakan Healtisin AI, cukup daftar akun, pilih layanan yang Anda butuhkan, dan mulai berkonsultasi. Interface yang intuitif akan memandu Anda dalam setiap langkah.'
            ],
            [
                'id' => 3,
                'question' => 'Apakah data saya aman?',
                'answer' => 'Ya, keamanan data adalah prioritas utama kami. Kami menggunakan enkripsi end-to-end dan mematuhi standar keamanan data kesehatan tertinggi untuk melindungi informasi pribadi Anda.'
            ],
            [
                'id' => 4,
                'question' => 'Berapa biaya berlangganan Healtisin Pro?',
                'answer' => 'Kami menawarkan beberapa paket berlangganan yang dapat disesuaikan dengan kebutuhan Anda. Silakan kunjungi halaman Harga untuk informasi detail tentang fitur dan biaya setiap paket.'
            ],
            [
                'id' => 5,
                'question' => 'Apakah Healtisin AI dapat menggantikan dokter?',
                'answer' => 'Tidak, Healtisin AI dirancang sebagai alat pendukung, bukan pengganti konsultasi medis langsung. Kami merekomendasikan untuk tetap berkonsultasi dengan dokter untuk diagnosis dan perawatan medis.'
            ],
            [
                'id' => 6,
                'question' => 'Bagaimana akurasi dari Healtisin AI?',
                'answer' => 'Healtisin AI menggunakan model AI yang terus diperbarui dan dilatih dengan data medis terkini. Namun, hasil analisis harus digunakan sebagai referensi awal dan bukan diagnosis final.'
            ],
            [
                'id' => 7,
                'question' => 'Apakah layanan tersedia 24/7?',
                'answer' => 'Ya, Healtisin AI tersedia 24 jam sehari, 7 hari seminggu. Anda dapat mengakses layanan kapan saja dan di mana saja.'
            ],
            [
                'id' => 8,
                'question' => 'Apakah ada aplikasi mobile?',
                'answer' => 'Ya, Healtisin AI dapat diakses melalui browser mobile dan kami sedang mengembangkan aplikasi mobile yang akan segera dirilis.'
            ],
            [
                'id' => 9,
                'question' => 'Bagaimana privasi data dijamin?',
                'answer' => 'Kami mengikuti standar keamanan internasional, mengenkripsi semua data sensitif, dan tidak pernah membagikan informasi pribadi Anda tanpa izin eksplisit.'
            ]
        ]));

        return view('faq', compact('faqs'));
    }

    public function incrementClick($id, $type = 'view')
    {
        // Implementasi untuk menghitung jumlah klik/view
        // $type bisa berupa 'view', 'helpful', atau 'not_helpful'
        return response()->json(['success' => true]);
    }
}
