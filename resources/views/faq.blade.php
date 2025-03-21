<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    @include('partials.meta-tags', ['customMeta' => [
        'title' => 'FAQ - ' . App\Helpers\InformationHelper::getProductName(),
        'description' => 'Pertanyaan yang sering diajukan tentang ' . App\Helpers\InformationHelper::getProductName()
    ]])
    @include('partials.dark-mode-init')
    @vite('resources/css/app.css')
    @vite('resources/js/translate.js')
    @include('lang.language-modal')
</head>

<body class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200 transition-colors duration-200">
    @include('partials.header')

    <main class="pt-16 sm:pt-18 pb-16">
        <!-- Hero Section dengan Animasi Paralaks -->
        <div class="relative h-[250px] sm:h-[300px] md:h-[500px] overflow-hidden">
            <div
                class="absolute inset-0 bg-gradient-to-r from-[#24b0ba] to-[#73c7e3] dark:from-[#1a8a91] dark:to-[#5ba5bd]">
                <div class="absolute inset-0 opacity-20">
                    <div class="floating-dots"></div>
                </div>
            </div>
            <div class="relative max-w-6xl mx-auto px-4 h-full flex items-center mt-[22px]">
                <div class="text-white text-center md:text-left w-full">
                    <h1 class="text-2xl sm:text-3xl md:text-5xl font-bold mb-2 sm:mb-4 md:mb-6 animate-fade-in">Pertanyaan yang Sering
                        Diajukan</h1>
                    <p class="text-sm sm:text-base md:text-lg opacity-90 max-w-2xl mx-auto md:mx-0 animate-slide-up">
                        Temukan jawaban untuk pertanyaan umum tentang {{ App\Helpers\InformationHelper::getProductName() }}
                    </p>
                </div>
            </div>
        </div>

        <!-- FAQ Content -->
        <div class="max-w-4xl mx-auto px-4 mt-6 sm:mt-8 md:mt-14 relative z-10">
            @include('partials.faq-items')
        </div>
    </main>

    @include('partials.footer')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.faq-button').forEach(button => {
                button.addEventListener('click', () => {
                    const answer = button.nextElementSibling;
                    const content = answer.querySelector('div');

                    // Toggle active state for button
                    button.classList.toggle('active');

                    // Smooth height animation
                    if (answer.style.maxHeight === '0px' || !answer.style.maxHeight) {
                        answer.style.maxHeight = content.scrollHeight + 'px';
                    } else {
                        answer.style.maxHeight = '0px';
                    }
                });
            });
        });
    </script>

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

        .faq-answer {
            position: relative;
        }

        .faq-answer::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(to right, #e5e7eb, transparent);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .faq-button.active+.faq-answer::after {
            opacity: 1;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .relative.h-\[500px\] {
                height: 300px;
            }

            .text-5xl {
                font-size: 2.5rem;
            }

            .text-xl {
                font-size: 1.25rem;
            }

            .max-w-6xl {
                max-width: 90%;
            }

            .px-4 {
                padding-left: 1rem;
                padding-right: 1rem;
            }

            .mt-14 {
                margin-top: 2rem;
            }
        }

        @media (max-width: 480px) {
            .text-5xl {
                font-size: 2rem;
            }

            .text-xl {
                font-size: 1rem;
            }

            .max-w-6xl {
                max-width: 100%;
            }

            .px-4 {
                padding-left: 0.5rem;
                padding-right: 0.5rem;
            }

            .mt-14 {
                margin-top: 1rem;
            }
            
            .floating-dots {
                background-size: 20px 20px;
            }
        }
    </style>
</body>

</html>