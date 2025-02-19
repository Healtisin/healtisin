<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tentang Kami - Healtisin AI</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50">
    @include('partials.header')

    <main class="pt-24 pb-16">
        <!-- Hero Section dengan Animasi Paralaks -->
        <div class="relative h-[500px] overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-[#24b0ba] to-[#73c7e3]">
                <div class="absolute inset-0 opacity-20">
                    <div class="floating-dots"></div>
                </div>
            </div>
            <div class="relative max-w-6xl mx-auto px-4 h-full flex items-center">
                <div class="text-white">
                    <h1 class="text-5xl font-bold mb-6 animate-fade-in">Tentang Healtisin AI</h1>
                    <p class="text-xl opacity-90 max-w-2xl animate-slide-up">
                        Menghadirkan revolusi kesehatan digital dengan kecerdasan buatan yang memahami kebutuhan kesehatan Anda
                    </p>
                </div>
            </div>
        </div>

        <!-- Fitur Inovatif Section dengan Card 3D -->
        <div class="max-w-6xl mx-auto px-4 -mt-20 relative z-10">
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-xl shadow-lg transform hover:-translate-y-2 transition-all duration-300 hover:shadow-2xl">
                    <div class="w-16 h-16 bg-[#24b0ba] rounded-lg -mt-12 mb-6 flex items-center justify-center transform rotate-45">
                        <svg class="w-8 h-8 text-white -rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-4">Skrining Kesehatan AI</h3>
                    <p class="text-gray-600">Analisis kesehatan awal yang cepat dan akurat dengan teknologi AI mutakhir</p>
                </div>

                <div class="bg-white p-8 rounded-xl shadow-lg transform hover:-translate-y-2 transition-all duration-300 hover:shadow-2xl">
                    <div class="w-16 h-16 bg-[#24b0ba] rounded-lg -mt-12 mb-6 flex items-center justify-center transform rotate-45">
                        <svg class="w-8 h-8 text-white -rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-4">Konsultasi 24/7</h3>
                    <p class="text-gray-600">Akses konsultasi kesehatan kapanpun dan dimanapun Anda berada</p>
                </div>

                <div class="bg-white p-8 rounded-xl shadow-lg transform hover:-translate-y-2 transition-all duration-300 hover:shadow-2xl">
                    <div class="w-16 h-16 bg-[#24b0ba] rounded-lg -mt-12 mb-6 flex items-center justify-center transform rotate-45">
                        <svg class="w-8 h-8 text-white -rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                        <p class="text-gray-600">Menggunakan model bahasa terbaru yang dilatih khusus untuk pemahaman medis dan kesehatan.</p>
                    </div>
                    <div class="reveal-on-scroll">
                        <h2 class="text-3xl font-bold mb-4">Keamanan Data Prioritas</h2>
                        <p class="text-gray-600">Enkripsi end-to-end dan standar keamanan tertinggi untuk melindungi data kesehatan Anda.</p>
                    </div>
                    <div class="reveal-on-scroll">
                        <h2 class="text-3xl font-bold mb-4">Integrasi Seamless</h2>
                        <p class="text-gray-600">Terhubung dengan berbagai perangkat kesehatan dan rekam medis elektronik.</p>
                    </div>
                </div>
                <div class="relative">
                    <div class="aspect-square rounded-full bg-[#24b0ba] opacity-10 absolute -right-20 -top-20"></div>
                    <div class="aspect-square rounded-full bg-[#73c7e3] opacity-10 absolute -left-20 -bottom-20"></div>
                    <img src="{{ asset('images/innovation2.png') }}" alt="Innovation" class="relative z-10 rounded-lg shadow-xl">
                </div>
            </div>
        </div>
    </main>

    @include('partials.footer')

    <style>
    .floating-dots {
        background-image: radial-gradient(circle, white 1px, transparent 1px);
        background-size: 30px 30px;
        height: 100%;
        animation: float 20s linear infinite;
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
        from { transform: translateY(0); }
        to { transform: translateY(-100%); }
    }

    @keyframes fadeIn {
        to { opacity: 1; }
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
        reveal(); // Initial check
    });
    </script>
</body>
</html>
