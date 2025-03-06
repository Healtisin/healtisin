<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Terms of Use - Healtisin AI</title>
    @vite('resources/css/app.css')
    @vite('resources/js/translate.js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @include('lang.language-modal')
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
            <div class="bg-white p-8 rounded-lg shadow-md">
                <div class="text-center">
                    <h2 class="text-3xl font-bold mb-4">Healtisin Terms of Use</h2>
                    <p class="text-gray-600 mb-2 text-sm font-semibold uppercase tracking-widest">Last Update: January
                        20, 2025</p>
                    <p class="text-gray-600 mb-6 text-lg">Dear users, welcome to Healtisin!</p>
                </div>

                <h3 class="text-2xl font-bold mb-4">1. Services</h3>
                <p class="text-gray-600 mb-6">
                    Healtisin products and services are jointly owned and operated by Healtisin Artificial Intelligence
                    Co., Ltd. and its affiliates (hereinafter referred to as “Healtisin” or “we”). Before using the
                    Services, please make sure to carefully read and understand this “Healtisin Terms of Use”
                    (hereinafter referred to as “these Terms”) as well as other related terms, policies, or guidelines
                    of this platform. When you use a specific function of the Services, there may be separate terms,
                    related business rules, etc. (“Specific Terms”) for that specific function. In the event of any
                    conflict between these Terms and the Specific Terms, the provisions of the Specific Terms shall
                    prevail. <strong>All the aforementioned terms and rules form an integral part of these Terms
                        (collectively referred to as “All Terms”), and have the same legal effect as the main text of
                        these Terms.</strong>
                </p>

                <h4 class="text-xl font-bold mb-4">1.1 Healtisin’s Products and Services</h4>
                <p class="text-gray-600 mb-6">
                    Healtisin’s products and services include those provided to you through websites, applications
                    (which may include different versions), software development kits (SDKs) for third-party websites
                    and applications, application programming interfaces (APIs), and innovative forms that emerge with
                    technological development. These encompass platforms with generative artificial intelligence
                    services at their core, among other functionalities (hereinafter referred to as “the Services”).
                </p>

                <h4 class="text-xl font-bold mb-4">1.2 Generative AI Services</h4>
                <p class="text-gray-600 mb-6">
                    The generative AI products and services provided by Healtisin are based on large language models,
                    which are built using neural networks, developed through stages of large-scale self-supervised
                    pre-training and targeted optimization training. These models can predict the next token by encoding
                    and computing the input information (including text, images, files, and more), thereby possessing
                    text generation and conversational abilities. They are adept at performing a wide range of text
                    generation tasks and can be integrated into various downstream systems or applications.
                    Specifically, within Healtisin’s product services, these models, based on user input information
                    (referred to as “Inputs”), compute and infer to output corresponding content as a response (referred
                    to as “Outputs”), including text, tables, and code. Users can evaluate the output, including actions
                    like liking or disliking, to provide feedback on their opinions about Healtisin’s output
                    information.
                </p>

                <h4 class="text-xl font-bold mb-4">1.3 Service Updates</h4>
                <p class="text-gray-600 mb-6">
                    As generative artificial intelligence technology, models, and products continue to evolve, along
                    with changes in laws and regulations, we may add, upgrade, modify, suspend, or terminate services,
                    or make necessary adjustments to the technology, method, and performance of the services, and may
                    conduct internal or external testing for new service features.
                </p>

                <h4 class="text-xl font-bold mb-4">1.4 Security and Stability</h4>
                <p class="text-gray-600 mb-6">
                    Healtisin will take necessary measures (not less than industry practices) to ensure the cyber
                    security and stable operation of the Services. We will also make efforts to enhance and improve
                    technology to ensure a better user experience. If you have any questions or feedback about our
                    services, you can contact us through the method described in Section 10.
                </p>

                <!-- Tambahkan bagian lainnya sesuai kebutuhan -->
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