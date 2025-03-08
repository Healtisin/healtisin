<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Terms of Use - Healtisin AI</title>
    @include('partials.dark-mode-init')
    @vite('resources/css/app.css')
    @vite('resources/js/translate.js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @include('lang.language-modal')
</head>

<body class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200">
    @include('partials.header')

    <main class="pt-19 pb-16">
        <!-- Hero Section -->
        <div class="pt-12 relative h-[500px] overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-[#24b0ba] to-[#73c7e3]">
                <div class="absolute inset-0 opacity-20">
                    <div class="floating-dots"></div>
                </div>
            </div>
            <div class="relative max-w-6xl mx-auto px-4 h-full flex items-center">
                <div class="text-white">
                    <h1 class="text-5xl font-bold mb-6 animate-fade-in">Terms of Use</h1>
                    <p class="text-xl opacity-90 max-w-2xl animate-slide-up">
                        Selamat datang di Healtisin! Silakan baca dan pahami Syarat Penggunaan ini sebelum menggunakan
                        layanan kami.
                    </p>
                </div>
            </div>
        </div>

        <!-- Konten Terms of Use -->
        <div class="max-w-6xl mx-auto px-4 py-12">
            <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-md">
                <div class="text-center">
                    <h2 class="text-3xl font-bold mb-4 dark:text-gray-100">Healtisin Terms of Use</h2>
                    <p class="text-gray-600 dark:text-gray-400 mb-2 text-sm font-semibold uppercase tracking-widest">Last Update: January
                        20, 2025</p>
                    <p class="text-gray-600 dark:text-gray-400 mb-6 text-lg">Dear users, welcome to Healtisin!</p>
                </div>

                <h3 class="text-2xl font-bold mb-4 dark:text-gray-100">1. Layanan</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-6">
                    Healtisin merupakan platform kesehatan digital yang dikembangkan dan dioperasikan oleh Healtisin AI 
                    (selanjutnya disebut "Healtisin" atau "kami"). Sebelum menggunakan layanan kami, mohon membaca dan 
                    memahami dengan seksama "Syarat Penggunaan Healtisin" ini beserta kebijakan terkait lainnya. 
                    Penggunaan fitur tertentu mungkin memerlukan persetujuan terhadap syarat khusus tambahan. Dalam hal 
                    terdapat perbedaan antara Syarat Penggunaan umum dengan syarat khusus, maka syarat khusus yang akan berlaku.
                </p>

                <h4 class="text-xl font-bold mb-4 dark:text-gray-100">1.1 Layanan Healtisin</h4>
                <p class="text-gray-600 dark:text-gray-400 mb-6">
                    Healtisin menyediakan layanan kesehatan digital melalui website, aplikasi mobile, dan interface 
                    pemrograman (API). Layanan kami mencakup sistem skrining kesehatan berbasis AI, konsultasi digital, 
                    analisis kondisi medis, dan rekomendasi kesehatan yang dipersonalisasi, dengan fokus utama pada 
                    keamanan dan privasi data kesehatan pengguna.
                </p>

                <h4 class="text-xl font-bold mb-4 dark:text-gray-100">1.2 Teknologi AI Kesehatan</h4>
                <p class="text-gray-600 dark:text-gray-400 mb-6">
                    Platform Healtisin ditenagai oleh sistem kecerdasan buatan yang dikembangkan khusus untuk bidang 
                    kesehatan. Teknologi kami menggunakan model bahasa dan pembelajaran mesin yang dilatih dengan dataset 
                    medis komprehensif, mampu menganalisis input pengguna (termasuk gejala, riwayat medis, dan informasi 
                    kesehatan lainnya) untuk memberikan skrining kesehatan awal dan rekomendasi yang akurat. Sistem kami 
                    terus belajar dan meningkat melalui umpan balik pengguna dan validasi tim medis profesional.
                </p>

                <h4 class="text-xl font-bold mb-4 dark:text-gray-100">1.3 Pembaruan Layanan</h4>
                <p class="text-gray-600 dark:text-gray-400 mb-6">
                    Seiring perkembangan teknologi AI kesehatan dan perubahan regulasi, Healtisin dapat melakukan 
                    pembaruan, peningkatan, atau penyesuaian layanan untuk memastikan kualitas dan keamanan optimal. 
                    Setiap perubahan signifikan akan dikomunikasikan kepada pengguna dan tetap mengutamakan keamanan 
                    data kesehatan serta kepatuhan terhadap standar medis yang berlaku.
                </p>

                <h4 class="text-xl font-bold mb-4 dark:text-gray-100">1.4 Keamanan dan Stabilitas</h4>
                <p class="text-gray-600 dark:text-gray-400 mb-6">
                    Healtisin menerapkan standar keamanan tertinggi sesuai regulasi kesehatan digital untuk melindungi 
                    data medis pengguna. Kami menggunakan enkripsi end-to-end, autentikasi multi-faktor, dan protokol 
                    keamanan terkini untuk menjaga kerahasiaan informasi kesehatan Anda. Platform kami dirancang dengan 
                    infrastruktur yang andal untuk menjamin stabilitas dan ketersediaan layanan 24/7.
                </p>

                <h4 class="text-xl font-bold mb-4 dark:text-gray-100">1.5 Batasan Penggunaan</h4>
                <p class="text-gray-600 dark:text-gray-400 mb-6">
                    Layanan Healtisin AI dirancang sebagai alat skrining kesehatan awal dan tidak menggantikan diagnosis 
                    medis profesional. Pengguna harus memahami bahwa:
                    <ul class="list-disc list-inside mt-4 space-y-2 dark:text-gray-400">
                        <li>Hasil analisis AI bersifat indikatif dan bukan diagnosis final</li>
                        <li>Dalam kondisi darurat medis, segera hubungi layanan gawat darurat</li>
                        <li>Rekomendasi yang diberikan perlu dikonsultasikan dengan tenaga medis</li>
                        <li>Keputusan pengobatan tetap menjadi tanggung jawab pengguna dan tenaga medis</li>
                    </ul>
                </p>

                <h4 class="text-xl font-bold mb-4 dark:text-gray-100">1.6 Penggunaan Data Medis</h4>
                <p class="text-gray-600 dark:text-gray-400 mb-6">
                    Healtisin berkomitmen untuk:
                    <ul class="list-disc list-inside mt-4 space-y-2 dark:text-gray-400">
                        <li>Menjaga kerahasiaan data medis sesuai standar HIPAA dan GDPR</li>
                        <li>Menggunakan data hanya untuk peningkatan layanan dengan persetujuan pengguna</li>
                        <li>Tidak membagikan informasi medis kepada pihak ketiga tanpa izin</li>
                        <li>Memberikan kontrol penuh kepada pengguna atas data kesehatannya</li>
                    </ul>
                </p>

                <h4 class="text-xl font-bold mb-4 dark:text-gray-100">1.7 Hak dan Kewajiban Pengguna</h4>
                <p class="text-gray-600 dark:text-gray-400 mb-6">
                    Sebagai pengguna Healtisin, Anda memiliki:
                    <ul class="list-disc list-inside mt-4 space-y-2 dark:text-gray-400">
                        <li>Hak untuk mendapatkan layanan skrining kesehatan yang akurat</li>
                        <li>Hak untuk mengakses dan menghapus data kesehatan pribadi</li>
                        <li>Kewajiban memberikan informasi kesehatan yang benar dan akurat</li>
                        <li>Kewajiban tidak menyalahgunakan platform untuk tujuan non-medis</li>
                    </ul>
                </p>

                <h4 class="text-xl font-bold mb-4 dark:text-gray-100">1.8 Dukungan Pengguna</h4>
                <p class="text-gray-600 dark:text-gray-400 mb-6">
                    Healtisin menyediakan:
                    <ul class="list-disc list-inside mt-4 space-y-2 dark:text-gray-400">
                        <li>Layanan dukungan teknis 24/7 melalui chat dan email</li>
                        <li>Panduan penggunaan platform yang komprehensif</li>
                        <li>FAQ dan artikel bantuan yang reguler diperbarui</li>
                        <li>Tim support khusus untuk masalah terkait data medis</li>
                    </ul>
                </p>

                <h4 class="text-xl font-bold mb-4 dark:text-gray-100">1.9 Kebijakan Pembatalan dan Pengembalian</h4>
                <p class="text-gray-600 dark:text-gray-400 mb-6">
                    Untuk layanan berbayar, Healtisin menerapkan:
                    <ul class="list-disc list-inside mt-4 space-y-2 dark:text-gray-400">
                        <li>Periode trial 7 hari untuk layanan premium</li>
                        <li>Pembatalan subscription dapat dilakukan kapan saja</li>
                        <li>Pengembalian dana sesuai kebijakan yang berlaku</li>
                        <li>Garansi kepuasan pengguna 30 hari</li>
                    </ul>
                </p>

                <h4 class="text-xl font-bold mb-4 dark:text-gray-100">1.10 Pembaruan Kebijakan</h4>
                <p class="text-gray-600 dark:text-gray-400 mb-6">
                    Healtisin berhak memperbarui Syarat Penggunaan ini dengan:
                    <ul class="list-disc list-inside mt-4 space-y-2 dark:text-gray-400">
                        <li>Pemberitahuan minimal 30 hari sebelum perubahan berlaku</li>
                        <li>Notifikasi melalui email dan dalam aplikasi</li>
                        <li>Rangkuman perubahan yang jelas dan transparan</li>
                        <li>Opsi untuk menolak perubahan kebijakan major</li>
                    </ul>
                </p>
            </div>
        </div>
    </main>

    @include('partials.footer')

    <style>
        .floating-dots {
            background-image: radial-gradient(circle, white 2px, transparent 0.5px);
            background-size: 30px 30px;
            height: 200%;
            animation: float 20s linear infinite;
            position: absolute;
            width: 100%;
            top: 0;
        }

        .animate-fade-in {
            opacity: 0;
            animation: fadeIn 1s ease-out forwards;
        }

        .animate-slide-up {
            opacity: 0;
            transform: translateY(20px);
            animation: slideUp 1s ease-out 0.5s forwards;
        }

        .reveal-on-scroll {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.6s ease-out;
        }

        .reveal-on-scroll.visible {
            opacity: 1;
            transform: translateY(0);
        }

        @keyframes float {
            0% {
                transform: translateY(0);
            }

            100% {
                transform: translateY(-50%);
            }
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }

        @keyframes slideUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const reveals = document.querySelectorAll('.reveal-on-scroll');

            function reveal() {
                reveals.forEach(element => {
                    const elementTop = element.getBoundingClientRect().top;
                    const windowHeight = window.innerHeight;

                    if (elementTop < windowHeight - 100) {
                        element.classList.add('visible');
                    }
                });
            }
            window.addEventListener('scroll', reveal);
            reveal();
        });
    </script>
</body>

</html>
