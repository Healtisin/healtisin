<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Privacy Policy - Healtisin AI</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-50">
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
                    <h1 class="text-5xl font-bold mb-6 animate-fade-in">Healtisin Privacy Policy</h1>
                    <p class="text-xl opacity-90 max-w-2xl animate-slide-up">
                        Selamat datang di Healtisin! Kami siap membantu Anda dengan pertanyaan atau kebutuhan Anda.
                        Jangan ragu untuk menghubungi
                        kami melalui informasi kontak di bawah ini.
                    </p>
                </div>
            </div>
        </div>

        <!-- Konten Privacy Policy -->
        <div class="max-w-6xl mx-auto px-4 py-12">
            <div class="bg-white p-8 rounded-lg shadow-md">
                <h2 class="text-3xl font-bold mb-6">Healtisin Privacy Policy</h2>
                <p class="text-gray-600 mb-2 text-sm font-semibold uppercase tracking-widest">Last Update: February 14,
                    2025</p>
                <p class="text-gray-600 mb-6">Selamat datang di Healtisin!</p>

                <h3 class="text-2xl font-bold mb-4">Introduction</h3>
                <p class="text-gray-600 mb-6">
                    Kebijakan privasi ("Privacy Policy") ini berlaku untuk informasi pribadi yang diproses oleh
                    Healtisin dalam kaitannya dengan aplikasi, situs web, perangkat lunak, dan layanan terkait
                    (misalnya, "Layanan") yang merujuk atau terhubung ke Kebijakan Privasi ini. Layanan memungkinkan
                    Anda untuk membuat dan berinteraksi dengan chatbot.
                </p>

                <h3 class="text-2xl font-bold mb-4">What Information We Collect</h3>
                <p class="text-gray-600 mb-6">
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Officiis tempore nemo saepe, fuga esse
                    incidunt officia dolorem quas. Animi tenetur consequatur dolor molestias, nam odit quos iusto ad.
                    Animi, eligendi!
                </p>

                <h4 class="text-xl font-bold mb-4">Information You Provide</h4>
                <p class="text-gray-600 mb-6">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga vero, tenetur cumque ipsam alias
                    minus, quos hic fugit eaque id expedita inventore quasi cupiditate reprehenderit nam. Eaque nihil
                    voluptatum deleniti.
                </p>
                <ul class="list-disc list-inside text-gray-600 mb-6">
                    <li><strong>Informasi Akun:</strong> Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                        Officiis earum, neque similique sapiente totam necessitatibus at, aliquid eaque temporibus non
                        ratione recusandae, expedita facere. Illum rerum id dignissimos harum laudantium?</li>
                    <li><strong>Input Pengguna:</strong> Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis
                        iure corporis eligendi molestias ratione officia accusantium doloribus nesciunt dolorum omnis
                        voluptatum exercitationem possimus totam, quia, praesentium in aperiam dolorem nam!</li>
                    <li><strong>Informasi yang Anda Kumpulkan:</strong> Lorem ipsum dolor sit amet consectetur
                        adipisicing elit. Iste impedit odio vero aspernatur! Totam sit ad voluptate similique natus
                        nihil minus suscipit animi culpa, eius nemo laborum vitae in tempora?</li>
                </ul>
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