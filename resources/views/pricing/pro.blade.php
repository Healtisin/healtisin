<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Paket Pro - Healtisin AI</title>
    @include('partials.dark-mode-init')
    @vite('resources/css/app.css')
    @vite('resources/js/translate.js')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('lang.language-modal')
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200 transition-colors duration-200">
    <div class="min-h-screen flex flex-col">
        <!-- Header dengan tombol kembali -->
        <header class="fixed w-full bg-white dark:bg-gray-800 shadow-sm z-10">
            <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
                <a href="{{ url()->previous() == url('/') ? '/' : '/home' }}" 
                   class="inline-flex items-center text-gray-600 dark:text-gray-300 hover:text-[#24b0ba] dark:hover:text-[#73c7e3]">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    <span class="hidden sm:inline">Kembali</span>
                </a>
                <div class="flex items-center gap-2">
                    <button onclick="toggleLanguage()" class="p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full" title="Ganti Bahasa">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129" />
                        </svg>
                    </button>
                    <button onclick="toggleTheme()" class="p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full" title="Ganti Tema">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400 block dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                        </svg>
                    </button>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-1 pt-16 sm:pt-20">
            <div class="max-w-4xl mx-auto px-4 py-8 sm:py-12">
                <div class="text-center mb-8 sm:mb-12">
                    <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-3 sm:mb-4 dark:text-gray-100">Tingkatkan ke Pro</h1>
                    <p class="text-base sm:text-lg md:text-xl text-gray-600 dark:text-gray-400">Nikmati layanan kesehatan yang lebih lengkap dengan Healtisin Pro</p>
                </div>

                <!-- Perbandingan Fitur -->
                @include('pricing.partials.feature-comparison', ['features' => $features])

                <!-- Perbandingan Harga -->
                @include('pricing.partials.price-comparison', ['packages' => $packages])

                <!-- Tombol Lanjutkan -->
                <div class="mt-6 sm:mt-8 text-center">
                    @auth
                        <a href="{{ route('pricing.select-package') }}" 
                           class="inline-block px-6 sm:px-8 py-2.5 sm:py-3 bg-[#24b0ba] text-white rounded-full 
                                  hover:bg-[#73c7e3] text-base sm:text-lg font-semibold w-full sm:w-auto">
                            Lanjutkan Berlangganan
                        </a>
                    @else
                        <div class="space-y-3 sm:space-y-4">
                            <p class="text-sm sm:text-base text-gray-600 dark:text-gray-400">Silakan login terlebih dahulu untuk melanjutkan</p>
                            <a href="{{ route('login', ['redirect' => route('pricing.select-package')]) }}" 
                               class="inline-block px-6 sm:px-8 py-2.5 sm:py-3 bg-[#24b0ba] text-white rounded-full 
                                      hover:bg-[#73c7e3] text-base sm:text-lg font-semibold w-full sm:w-auto">
                                Login untuk Melanjutkan
                            </a>
                        </div>
                    @endauth
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-white dark:bg-gray-800 border-t dark:border-gray-700">
            <div class="max-w-7xl mx-auto px-4 py-4 sm:py-6 text-center text-xs sm:text-sm text-gray-600 dark:text-gray-400">
                <p>&copy; {{ date('Y') }} Healtisin AI. Hak Cipta Dilindungi.</p>
            </div>
        </footer>
    </div>

    <script>
        // Fungsi untuk toggle bahasa
        function toggleLanguage() {
            const languageModal = document.getElementById('languageModal');
            if (languageModal) {
                languageModal.classList.remove('hidden');
            }
        }

        // Fungsi untuk toggle tema
        function toggleTheme() {
            if (localStorage.theme === 'dark') {
                localStorage.theme = 'light';
                document.documentElement.classList.remove('dark');
            } else {
                localStorage.theme = 'dark';
                document.documentElement.classList.add('dark');
            }
        }
    </script>
</body>
</html>

