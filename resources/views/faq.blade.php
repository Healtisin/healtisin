<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FAQ - Healtisin AI</title>
    @vite('resources/css/app.css')
    @vite('resources/js/translate.js')
    <script>
        // Inisialisasi preferensi bahasa sebelum halaman dimuat sepenuhnya
        document.addEventListener('DOMContentLoaded', function() {
            // Mengambil bahasa dari URL jika ada
            const urlParams = new URLSearchParams(window.location.search);
            const langParam = urlParams.get('lang');
            
            if (langParam && ['id', 'en', 'ja', 'ko', 'zh'].includes(langParam)) {
                changeLanguage(langParam);
            } else {
                // Perbarui tampilan bahasa sesuai dengan bahasa yang disimpan di cookie
                updateLanguageDisplay();
            }
        });

        // Fungsi untuk memperbarui tampilan bahasa
function updateLanguageDisplay() {
            // Perbarui tanda ceklis di modal bahasa
            const langButtons = document.querySelectorAll('[data-lang-code]');
            if (langButtons.length === 0) return;
            
            // Cek cookie untuk mendapatkan bahasa yang disimpan
            const cookies = document.cookie.split(';');
            let userLocale = '{{ App::getLocale() }}'; // Default dari server
            
            for (const cookie of cookies) {
                const [name, value] = cookie.trim().split('=');
                if (name === 'user_locale') {
                    userLocale = value;
                    break;
                }
            }
            
            // Perbarui tanda ceklis
            langButtons.forEach(button => {
                const checkMark = button.querySelector('.language-check-mark');
                if (button.dataset.langCode === userLocale) {
                    checkMark.classList.remove('hidden');
                } else {
                    checkMark.classList.add('hidden');
                }
            });
            
            // Perbarui tampilan bahasa di input jika ada
            const languageDisplayElement = document.getElementById('current-language-display');
            if (languageDisplayElement) {
                const languages = {
                    'id': 'Bahasa Indonesia',
                    'en': 'English',
                    'ja': '日本語',
                    'ko': '한국어',
                    'zh': '中文'
                };
                
                if (languages[userLocale]) {
                    languageDisplayElement.value = languages[userLocale];
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50">
    @include('partials.header')

    <main class="pt-18 pb-16">
        <!-- Hero Section dengan Animasi Paralaks -->
        <div class="relative h-[500px] overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-[#24b0ba] to-[#73c7e3]">
                <div class="absolute inset-0 opacity-20">
                    <div class="floating-dots"></div>
                </div>
            </div>
            <div class="relative max-w-6xl mx-auto px-4 h-full flex items-center mt-[22px]">
                <div class="text-white">
                    <h1 class="text-5xl font-bold mb-6 animate-fade-in">Pertanyaan yang Sering Diajukan</h1>
                    <p class="text-xl opacity-90 max-w-2xl animate-slide-up">
                        Temukan jawaban untuk pertanyaan umum tentang Healtisin AI
                    </p>
                </div>
            </div>
        </div>

        <!-- FAQ Content -->
        <div class="max-w-4xl mx-auto px-4 mt-14 relative z-10">
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
            0% { transform: translateY(0); }
            100% { transform: translateY(-50%); }
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

        .faq-button.active + .faq-answer::after {
            opacity: 1;
        }
    </style>
</body>
</html>
