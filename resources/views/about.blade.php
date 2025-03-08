<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tentang Kami - Healtisin AI</title>
    @include('partials.dark-mode-init')
    @vite('resources/css/app.css')
    @vite('resources/js/translate.js')
    @include('lang.language-modal')
</head>

<body class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200 transition-colors duration-200">
    @include('partials.header')

    <main class="pt-18 pb-16">
        <!-- Hero Section dengan Animasi Paralaks -->
        <div class="relative h-[500px] overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-[#24b0ba] to-[#73c7e3] dark:from-[#1a8a91] dark:to-[#5ba5bd]">
                <div class="absolute inset-0 opacity-20">
                    <div class="floating-dots"></div>
                </div>
            </div>
            <div class="relative max-w-6xl mx-auto px-4 h-full flex items-center">
                <div class="text-white">
                    <h1 class="text-5xl font-bold mb-6 animate-fade-in">Tentang Healtisin AI</h1>
                    <p class="text-xl opacity-90 max-w-2xl animate-slide-up">
                    Menghadirkan transformasi layanan kesehatan digital melalui integrasi AI mutakhir yang
                    mampu menganalisis 1000+ kondisi medis, memberikan skrining kesehatan real-time, dan
                    rekomendasi pengobatan yang dipersonalisasi untuk setiap pengguna.
                    </p>
                </div>
            </div>
        </div>

        <!-- Fitur Inovatif Section dengan Card 3D -->
        <div class="max-w-6xl mx-auto px-4 -mt-20 relative z-10">
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-xl shadow-lg transform hover:-translate-y-2 transition-all duration-300 hover:shadow-2xl">
                    <div class="w-16 h-16 bg-gradient-to-br from-[#1a8891] to-[#24b0ba] rounded-lg -mt-12 mb-6 flex items-center justify-center transform rotate-45 shadow-lg border border-white/20">
                        <svg class="w-8 h-8 text-white -rotate-45 drop-shadow-md" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-4">Skrining Kesehatan AI</h3>
                    <p class="text-gray-600">Analisis kesehatan awal yang cepat dan akurat dengan teknologi AI mutakhir
                    </p>
                </div>

                <div class="bg-white p-8 rounded-xl shadow-lg transform hover:-translate-y-2 transition-all duration-300 hover:shadow-2xl">
                    <div class="w-16 h-16 bg-gradient-to-br from-[#1a8891] to-[#24b0ba] rounded-lg -mt-12 mb-6 flex items-center justify-center transform rotate-45 shadow-lg border border-white/20">
                        <svg class="w-8 h-8 text-white -rotate-45 drop-shadow-md" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-4">Konsultasi 24/7</h3>
                    <p class="text-gray-600">Akses konsultasi kesehatan kapanpun dan dimanapun Anda berada</p>
                </div>

                <div class="bg-white p-8 rounded-xl shadow-lg transform hover:-translate-y-2 transition-all duration-300 hover:shadow-2xl">
                    <div class="w-16 h-16 bg-gradient-to-br from-[#1a8891] to-[#24b0ba] rounded-lg -mt-12 mb-6 flex items-center justify-center transform rotate-45 shadow-lg border border-white/20">
                        <svg class="w-8 h-8 text-white -rotate-45 drop-shadow-md" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-4">Rekomendasi Personal</h3>
                    <p class="text-gray-600">Saran kesehatan yang dipersonalisasi berdasarkan profil kesehatan Anda</p>
                </div>
            </div>
        </div>

        <!-- Inovasi Section dengan Animasi Scroll -->
        <div class="max-w-6xl mx-auto px-4 py-24">
            <div class="grid md:grid-cols-2 gap-16 items-center">
                <div class="space-y-8">
                    <div class="reveal-on-scroll">
                        <h2 class="text-3xl font-bold mb-4">Teknologi AI Mutakhir</h2>
                        <p class="text-gray-600">Menggunakan model bahasa terbaru yang dilatih khusus untuk pemahaman
                            medis dan kesehatan.</p>
                    </div>
                    <div class="reveal-on-scroll">
                        <h2 class="text-3xl font-bold mb-4">Keamanan Data Prioritas</h2>
                        <p class="text-gray-600">Enkripsi end-to-end dan standar keamanan tertinggi untuk melindungi
                            data kesehatan Anda.</p>
                    </div>
                    <div class="reveal-on-scroll">
                        <h2 class="text-3xl font-bold mb-4">Integrasi Seamless</h2>
                        <p class="text-gray-600">Terhubung dengan berbagai perangkat kesehatan dan rekam medis
                            elektronik.</p>
                    </div>
                </div>
                <div class="relative">
                    <img src="{{ asset('images/robot3.png') }}" alt="Innovation" class="relative z-10">
                </div>
            </div>
        </div>

        <!-- Visi & Misi Section -->
        <div class="bg-gradient-to-r from-[#24b0ba] to-[#73c7e3] py-24">
            <div class="max-w-6xl mx-auto px-4">
                <div class="grid md:grid-cols-2 gap-16">
                    <div class="reveal-on-scroll bg-gradient-to-br from-gray-50 to-white p-8 rounded-xl shadow-lg card-hover">
                        <h2 class="text-4xl font-bold mb-8 text-gradient">Visi Kami</h2>
                        <div class="space-y-6 text-gray-600">
                            <p class="text-lg">Menjadi pionir dalam revolusi kesehatan digital di Indonesia melalui integrasi kecerdasan buatan yang aman, akurat, dan terpercaya.</p>
                            <p class="text-lg">Kami membayangkan masa depan di mana setiap orang memiliki akses ke layanan kesehatan berkualitas tinggi dari ujung jari mereka.</p>
                        </div>
                    </div>
                    <div class="reveal-on-scroll bg-gradient-to-br from-gray-50 to-white p-8 rounded-xl shadow-lg card-hover">
                        <h2 class="text-4xl font-bold mb-8 text-gradient">Misi Kami</h2>
                        <div class="space-y-6">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-[#1a8891] to-[#24b0ba] rounded-lg flex items-center justify-center shrink-0 icon-pulse">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold mb-2">Inovasi Berkelanjutan</h3>
                                    <p class="text-gray-600">Terus mengembangkan dan menyempurnakan teknologi AI kami untuk memberikan layanan terbaik.</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-[#1a8891] to-[#24b0ba] rounded-lg flex items-center justify-center shrink-0 icon-pulse">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold mb-2">Keamanan Prioritas</h3>
                                    <p class="text-gray-600">Menjaga kerahasiaan dan keamanan data pengguna dengan standar tertinggi.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Teknologi Section -->
        <div class="py-24 bg-gray-50">
            <div class="max-w-6xl mx-auto px-4">
                <h2 class="text-4xl font-bold text-center mb-16">Teknologi Kami</h2>
                <div class="grid md:grid-cols-2 gap-16 items-center">
                    <div class="order-1">
                        <img src="{{ asset('images/robot1.png') }}" alt="Technology Illustration" class="w-full">
                    </div>
                    <div class="order-2">
                        <div class="space-y-8">
                            <div class="reveal-on-scroll">
                                <h3 class="text-2xl font-bold mb-4">Natural Language Processing</h3>
                                <p class="text-gray-600">Model bahasa canggih yang memahami konteks medis dan dapat berkomunikasi dalam Bahasa Indonesia dengan natural.</p>
                            </div>
                            <div class="reveal-on-scroll">
                                <h3 class="text-2xl font-bold mb-4">Machine Learning</h3>
                                <p class="text-gray-600">Algoritma yang terus belajar dan beradaptasi untuk meningkatkan akurasi diagnosis dan rekomendasi.</p>
                            </div>
                            <div class="reveal-on-scroll">
                                <h3 class="text-2xl font-bold mb-4">Sistem Terintegrasi</h3>
                                <p class="text-gray-600">Arsitektur modern yang memungkinkan integrasi seamless dengan berbagai sistem kesehatan.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Komitmen Section -->
        <div class="bg-gradient-to-r from-[#24b0ba] to-[#73c7e3] py-24 text-white mb-[-64px]">
            <div class="max-w-6xl mx-auto px-4">
                <div class="text-center max-w-3xl mx-auto">
                    <h2 class="text-4xl font-bold mb-8">Komitmen Kami</h2>
                    <p class="text-xl mb-12 opacity-90">Kami berkomitmen untuk terus berinovasi dan mengembangkan solusi kesehatan digital yang aman, akurat, dan dapat diakses oleh semua lapisan masyarakat Indonesia.</p>
                    <a href="/contact" class="inline-block bg-white text-[#24b0ba] px-8 py-4 rounded-full font-bold text-lg hover:bg-gray-100 transition-all duration-300 contact-button">
                        Hubungi Kami
                    </a>
                </div>
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

    /* Animasi untuk Visi & Misi cards */
    .card-hover {
        transition: all 0.3s ease;
        transform: perspective(1000px) rotateX(0) rotateY(0);
        transform-style: preserve-3d;
    }

    .card-hover:hover {
        transform: perspective(1000px) rotateX(2deg) rotateY(2deg);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }

    /* Animasi untuk ikon-ikon */
    .icon-pulse {
        animation: iconPulse 2s infinite;
    }

    @keyframes iconPulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.1); }
        100% { transform: scale(1); }
    }

    /* Animasi untuk teks */
    .text-gradient {
        background: linear-gradient(to right, #24b0ba, #73c7e3, #24b0ba);
        background-size: 200% auto;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: textShine 3s linear infinite;
    }

    @keyframes textShine {
        to { background-position: 200% center; }
    }

    /* Animasi untuk tombol Hubungi Kami */
    .contact-button {
        transition: transform 0.3s ease-in-out;
    }

    .contact-button:hover {
        transform: scale(1.05);
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
            reveal(); // Initial check
        });
    </script>
</body>

</html>
