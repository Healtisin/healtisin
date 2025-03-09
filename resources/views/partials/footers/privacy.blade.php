<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Privacy Policy - Healtisin AI</title>
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
                    <h1 class="text-3xl md:text-5xl font-bold mb-4 animate-fade-in">Healtisin Privacy Policy</h1>
                    <p class="text-base md:text-xl opacity-90 max-w-2xl animate-slide-up">
                        Selamat datang di Healtisin! Kami siap membantu Anda dengan pertanyaan atau kebutuhan Anda.
                        Jangan ragu untuk menghubungi kami melalui informasi kontak di bawah ini.
                    </p>
                </div>
            </div>
        </div>

        <!-- Konten Privacy Policy -->
        <div class="max-w-6xl mx-auto px-4 py-8 md:py-12">
            <div class="bg-white dark:bg-gray-800 p-6 md:p-8 rounded-lg shadow-md">
                <h2 class="text-2xl md:text-3xl font-bold mb-6 dark:text-gray-100">Healtisin Privacy Policy</h2>
                <p class="text-gray-600 dark:text-gray-400 mb-2 text-sm font-semibold uppercase tracking-widest">Last
                    Update: February 14, 2025</p>
                <p class="text-gray-600 dark:text-gray-400 mb-6">Selamat datang di Healtisin!</p>

                <h3 class="text-xl md:text-2xl font-bold mb-4 dark:text-gray-100">Introduction</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-6">
                    Kebijakan privasi ("Privacy Policy") ini berlaku untuk informasi pribadi yang diproses oleh
                    Healtisin dalam kaitannya dengan aplikasi, situs web, perangkat lunak, dan layanan terkait
                    (misalnya, "Layanan") yang merujuk atau terhubung ke Kebijakan Privasi ini. Layanan memungkinkan
                    Anda untuk membuat dan berinteraksi dengan chatbot.
                </p>

                <h3 class="text-xl md:text-2xl font-bold mb-4 dark:text-gray-100">Informasi yang Kami Kumpulkan</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-6">
                    Dalam upaya memberikan layanan kesehatan digital yang optimal, Healtisin AI mengumpulkan beberapa
                    jenis informasi
                    penting dengan persetujuan pengguna. Informasi ini diperlukan untuk memberikan analisis kesehatan
                    yang akurat,
                    rekomendasi yang tepat, dan pengalaman yang dipersonalisasi sesuai kebutuhan kesehatan Anda.
                </p>

                <h4 class="text-lg md:text-xl font-bold mb-4 dark:text-gray-100">Data Kesehatan Pribadi</h4>
                <ul class="list-disc list-inside text-gray-600 dark:text-gray-400 mb-6">
                    <li class="mb-2"><strong class="dark:text-gray-300">Informasi Dasar:</strong> Usia, jenis kelamin,
                        tinggi badan, berat badan, dan riwayat kesehatan umum.</li>
                    <li class="mb-2"><strong class="dark:text-gray-300">Riwayat Medis:</strong> Kondisi kesehatan yang
                        ada, alergi, pengobatan yang sedang dijalani, dan riwayat operasi.</li>
                    <li class="mb-2"><strong class="dark:text-gray-300">Gejala:</strong> Keluhan kesehatan yang dialami,
                        durasi gejala, dan tingkat keparahan.</li>
                </ul>

                <h4 class="text-lg md:text-xl font-bold mb-4 dark:text-gray-100">Data Penggunaan Layanan</h4>
                <ul class="list-disc list-inside text-gray-600 dark:text-gray-400 mb-6">
                    <li class="mb-2"><strong class="dark:text-gray-300">Interaksi Platform:</strong> Riwayat konsultasi,
                        hasil skrining kesehatan, dan rekomendasi yang diterima.</li>
                    <li class="mb-2"><strong class="dark:text-gray-300">Data Teknis:</strong> Informasi perangkat, log
                        aktivitas, dan data penggunaan aplikasi untuk peningkatan layanan.</li>
                    <li class="mb-2"><strong class="dark:text-gray-300">Feedback:</strong> Masukan dan penilaian Anda
                        terhadap layanan untuk evaluasi dan pengembangan sistem.</li>
                </ul>

                <p class="text-gray-600 dark:text-gray-400 mb-6">
                    Semua informasi yang dikumpulkan dilindungi dengan standar keamanan tinggi dan hanya digunakan untuk
                    tujuan yang telah disebutkan dalam kebijakan privasi ini. Kami berkomitmen untuk menjaga kerahasiaan
                    dan keamanan data kesehatan Anda sesuai dengan regulasi yang berlaku.
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