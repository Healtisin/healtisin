<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Paket Pro - Healtisin AI</title>
    @vite('resources/css/app.css')
    @vite('resources/js/translate.js')
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
    <div class="min-h-screen flex flex-col">
        <!-- Header dengan tombol kembali -->
        <header class="fixed w-full bg-white shadow-sm z-10">
            <div class="max-w-7xl mx-auto px-4 py-4">
                <a href="{{ url()->previous() == url('/') ? '/' : '/home' }}" 
                   class="inline-flex items-center text-gray-600 hover:text-[#24b0ba]">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali
                </a>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-1 pt-20">
            <div class="max-w-4xl mx-auto px-4 py-12">
                <div class="text-center mb-12">
                    <h1 class="text-4xl font-bold mb-4">Tingkatkan ke Pro</h1>
                    <p class="text-xl text-gray-600">Nikmati layanan kesehatan yang lebih lengkap dengan Healtisin Pro</p>
                </div>

                <!-- Perbandingan Fitur -->
                @include('pricing.partials.feature-comparison', ['features' => $features])

                <!-- Perbandingan Harga -->
                @include('pricing.partials.price-comparison', ['packages' => $packages])

                <!-- Tombol Lanjutkan -->
                <div class="mt-8 text-center">
                    @auth
                        <a href="{{ route('pricing.select-package') }}" 
                           class="inline-block px-8 py-3 bg-[#24b0ba] text-white rounded-full 
                                  hover:bg-[#73c7e3] text-lg font-semibold">
                            Lanjutkan Berlangganan
                        </a>
                    @else
                        <div class="space-y-4">
                            <p class="text-gray-600">Silakan login terlebih dahulu untuk melanjutkan</p>
                            <a href="{{ route('login', ['redirect' => route('pricing.select-package')]) }}" 
                               class="inline-block px-8 py-3 bg-[#24b0ba] text-white rounded-full 
                                      hover:bg-[#73c7e3] text-lg font-semibold">
                                Login untuk Melanjutkan
                            </a>
                        </div>
                    @endauth
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-white border-t">
            <div class="max-w-7xl mx-auto px-4 py-6 text-center text-sm text-gray-600">
                <p>&copy; {{ date('Y') }} Healtisin AI. Hak Cipta Dilindungi.</p>
            </div>
        </footer>
    </div>
</body>
</html>

