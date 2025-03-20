@php
use App\Helpers\InformationHelper;
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('partials.title', ['segment' => 'Terms of Use'])
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
        <div class="pt-12 relative h-[300px] md:h-[500px] overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-[#24b0ba] to-[#73c7e3]">
                <div class="absolute inset-0 opacity-20">
                    <div class="floating-dots"></div>
                </div>
            </div>
            <div class="relative max-w-6xl mx-auto px-4 h-full flex items-center py-8 md:py-0">
                <div class="text-white text-center md:text-left">
                    <h1 class="text-3xl md:text-5xl font-bold mb-4 animate-fade-in">Terms of Use</h1>
                    <p class="text-base md:text-xl opacity-90 max-w-2xl animate-slide-up">
                        Selamat datang di {{ InformationHelper::getWebsiteName() }}! Silakan baca dan pahami Syarat Penggunaan ini sebelum menggunakan
                        layanan kami.
                    </p>
                </div>
            </div>
        </div>

        <!-- Konten Terms of Use -->
        <div class="max-w-6xl mx-auto px-4 py-8 md:py-12">
            <div class="bg-white dark:bg-gray-800 p-6 md:p-8 rounded-lg shadow-md">
                <div class="text-center">
                    <h2 class="text-2xl md:text-3xl font-bold mb-4 dark:text-gray-100">{{ InformationHelper::getWebsiteName() }} Terms of Use</h2>
                    <p class="text-gray-600 dark:text-gray-400 mb-2 text-sm font-semibold uppercase tracking-widest">
                        Last Update: January 20, 2025</p>
                    <p class="text-gray-600 dark:text-gray-400 mb-6 text-lg">Dear users, welcome to {{ InformationHelper::getWebsiteName() }}!</p>
                </div>

                <h3 class="text-xl md:text-2xl font-bold mb-4 dark:text-gray-100">1. Layanan</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-6">
                    {{ InformationHelper::getWebsiteName() }} merupakan platform kesehatan digital yang dikembangkan dan dioperasikan oleh {{ InformationHelper::getProductName() }}
                    (selanjutnya disebut "{{ InformationHelper::getWebsiteName() }}" atau "kami"). Sebelum menggunakan layanan kami, mohon membaca dan
                    memahami dengan seksama "Syarat Penggunaan {{ InformationHelper::getWebsiteName() }}" ini beserta kebijakan terkait lainnya.
                    Penggunaan fitur tertentu mungkin memerlukan persetujuan terhadap syarat khusus tambahan. Dalam hal
                    terdapat perbedaan antara Syarat Penggunaan umum dengan syarat khusus, maka syarat khusus yang akan
                    berlaku.
                </p>

                <h4 class="text-lg md:text-xl font-bold mb-4 dark:text-gray-100">1.1 Layanan {{ InformationHelper::getWebsiteName() }}</h4>
                <p class="text-gray-600 dark:text-gray-400 mb-6">
                    {{ InformationHelper::getWebsiteName() }} menyediakan layanan kesehatan digital melalui website, aplikasi mobile, dan interface
                    berbasis chat untuk membantu pengguna mendapatkan informasi kesehatan awal, skrining gejala, dan
                    rekomendasi melalui teknologi kecerdasan buatan (Artificial Intelligence).
                </p>

                <h4 class="text-lg md:text-xl font-bold mb-4 dark:text-gray-100">1.2 Teknologi AI Kesehatan</h4>
                <p class="text-gray-600 dark:text-gray-400 mb-6">
                    Platform {{ InformationHelper::getWebsiteName() }} ditenagai oleh sistem kecerdasan buatan yang dikembangkan khusus untuk bidang
                    kesehatan dengan kemampuan memahami gejala, menganalisis kemungkinan kondisi, dan memberikan
                    rekomendasi kesehatan awal.
                </p>

                <h4 class="text-lg md:text-xl font-bold mb-4 dark:text-gray-100">1.3 Pembaruan Layanan</h4>
                <p class="text-gray-600 dark:text-gray-400 mb-6">
                    Seiring perkembangan teknologi AI kesehatan dan perubahan regulasi, {{ InformationHelper::getWebsiteName() }} dapat melakukan
                    perubahan atau update terhadap fitur, layanan, atau kebijakan dengan pemberitahuan yang wajar kepada
                    pengguna.
                </p>

                <h4 class="text-lg md:text-xl font-bold mb-4 dark:text-gray-100">1.4 Keamanan dan Stabilitas</h4>
                <p class="text-gray-600 dark:text-gray-400 mb-6">
                    {{ InformationHelper::getWebsiteName() }} menerapkan standar keamanan tertinggi sesuai regulasi kesehatan digital untuk melindungi
                    data pengguna dari akses tidak sah, penggunaan yang tidak tepat, atau pengungkapan yang tidak
                    diotorisasi.
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