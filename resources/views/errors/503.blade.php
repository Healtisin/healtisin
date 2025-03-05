<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layanan Tidak Tersedia - Healtisin AI</title>
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
    <div class="min-h-screen flex flex-col items-center justify-center px-4">
        <!-- Animasi Ilustrasi -->
        <div class="mb-4 relative flex justify-center items-center">
            <img src="{{ asset('images/animasi3.png') }}" alt="Animasi Healtisin"
                style="width: 300px; height: 300px;"
                class="object-cover rounded-lg">
        </div>

        <!-- Pesan Error -->
        <div class="text-center max-w-lg">
            <h1 class="text-3xl font-bold text-gray-900 mb-4">
                Oops! Layanan Sedang Dalam Pemeliharaan
            </h1>
            <p class="text-lg text-gray-600 mb-8">
                Mohon maaf, layanan kami sedang dalam pemeliharaan. Silakan kembali beberapa saat lagi.
            </p>

            <!-- Tombol Navigasi dengan Efek Hover -->
            <div class="space-y-4 mb-8">
                <a href="{{ url()->previous() !== url()->current() ? url()->previous() : '/' }}" 
                   class="group inline-flex items-center gap-2 px-6 py-3 bg-[#24b0ba] text-white rounded-full 
                          hover:bg-[#73c7e3] transition-all duration-300 transform hover:scale-105">
                    <svg class="w-5 h-5 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali
                </a>
            </div>
        </div>

        <!-- Footer dengan Elemen Medis -->
        <div class="text-center">
            <div class="flex items-center justify-center gap-2 text-gray-400 mb-2">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
                <span>&copy; {{ date('Y') }} Healtisin AI</span>
            </div>
            <p class="text-sm text-gray-400">Tetap sehat dan jangan lupa jaga kesehatan!</p>
        </div>
    </div>
</body>
</html>
