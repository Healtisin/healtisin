<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pilih Paket - Healtisin AI</title>
    @include('partials.dark-mode-init')
    @vite('resources/css/app.css')
    @vite('resources/js/translate.js')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('lang.language-modal')
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200 transition-colors duration-200">
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <header class="fixed w-full bg-white dark:bg-gray-800 shadow-sm z-10">
            <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
                <a href="{{ route('pricing.pro') }}" class="inline-flex items-center text-gray-600 dark:text-gray-300 hover:text-[#24b0ba] dark:hover:text-[#73c7e3]">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali
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

        <main class="flex-1 pt-20">
            <div class="max-w-3xl mx-auto px-4 py-12">
                <!-- Progress Steps -->
                <div class="flex items-center justify-center mb-12">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-[#24b0ba] text-white rounded-full flex items-center justify-center">1</div>
                        <div class="h-1 w-16 bg-[#24b0ba]"></div>
                        <div class="w-8 h-8 bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-400 rounded-full flex items-center justify-center">2</div>
                        <div class="h-1 w-16 bg-gray-200 dark:bg-gray-700"></div>
                        <div class="w-8 h-8 bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-400 rounded-full flex items-center justify-center">3</div>
                    </div>
                </div>

                <form action="{{ route('pricing.payment-details') }}" method="POST" class="space-y-8">
                    @csrf
                    <!-- Pilihan Paket -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8">
                        <h3 class="text-xl font-semibold mb-6 dark:text-gray-100">Pilih Paket Pro</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @foreach($packages as $package)
                            <label class="relative border dark:border-gray-700 rounded-xl p-4 cursor-pointer hover:border-[#24b0ba] dark:hover:border-[#73c7e3]">
                                <input type="radio" name="package" value="{{ $package['duration'] }}" 
                                       class="hidden" required>
                                <div class="text-center">
                                    @if($package['discount'] > 0)
                                    <div class="absolute -top-3 right-3">
                                        <span class="px-2 py-1 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 text-xs rounded-full">
                                            Hemat {{ $package['discount'] }}%
                                        </span>
                                    </div>
                                    @endif
                                    <h4 class="font-semibold mb-2 dark:text-gray-200">{{ $package['name'] }}</h4>
                                    <p class="text-2xl font-bold text-[#24b0ba] dark:text-[#73c7e3] mb-1">
                                        Rp {{ number_format($package['total'], 0, ',', '.') }}
                                    </p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        Rp {{ number_format($package['monthly'], 0, ',', '.') }}/bulan
                                    </p>
                                </div>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Metode Pembayaran -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8">
                        <h3 class="text-xl font-semibold mb-6 dark:text-gray-100">Pilih Metode Pembayaran</h3>
                        <div class="space-y-6">
                            <!-- E-Wallet -->
                            <div class="space-y-4">
                                <h4 class="font-medium text-gray-600 dark:text-gray-400">E-Wallet</h4>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    @foreach($ewallets as $ewallet)
                                    <label class="border dark:border-gray-700 rounded-lg p-4 cursor-pointer hover:border-[#24b0ba] dark:hover:border-[#73c7e3]">
                                        <input type="radio" name="payment_method" value="{{ $ewallet['code'] }}" 
                                               class="hidden" required>
                                        <div class="flex items-center gap-3">
                                            <img src="{{ asset($ewallet['icon']) }}" alt="{{ $ewallet['name'] }}" 
                                                 class="h-6">
                                            <span class="dark:text-gray-200">{{ $ewallet['name'] }}</span>
                                        </div>
                                    </label>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Bank Transfer -->
                            <div class="space-y-4">
                                <h4 class="font-medium text-gray-600 dark:text-gray-400">Transfer Bank</h4>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    @foreach($banks as $bank)
                                    <label class="border dark:border-gray-700 rounded-lg p-4 cursor-pointer hover:border-[#24b0ba] dark:hover:border-[#73c7e3]">
                                        <input type="radio" name="payment_method" value="{{ $bank['code'] }}" 
                                               class="hidden" required>
                                        <div class="flex items-center gap-3">
                                            <img src="{{ asset($bank['icon']) }}" alt="{{ $bank['name'] }}" 
                                                 class="h-6">
                                            <span class="dark:text-gray-200">{{ $bank['name'] }}</span>
                                        </div>
                                    </label>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Kartu Kredit -->
                            <div class="space-y-4">
                                <h4 class="font-medium text-gray-600 dark:text-gray-400">Kartu Kredit</h4>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <label class="border dark:border-gray-700 rounded-lg p-4 cursor-pointer hover:border-[#24b0ba] dark:hover:border-[#73c7e3]">
                                        <input type="radio" name="payment_method" value="cc" class="hidden" required>
                                        <div class="flex items-center gap-3">
                                            <img src="{{ asset('images/payments/cc.png') }}" alt="Kartu Kredit" class="h-6">
                                            <span class="dark:text-gray-200">Kartu Kredit</span>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" 
                            class="w-full bg-[#24b0ba] text-white py-4 rounded-full hover:bg-[#73c7e3] 
                                   transition-colors text-lg font-semibold">
                        Lanjutkan
                    </button>
                </form>
            </div>
        </main>
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

        // Handle radio button selection styling
        document.querySelectorAll('input[type="radio"]').forEach(radio => {
            radio.addEventListener('change', function() {
                const parentType = this.name;
                document.querySelectorAll(`input[name="${parentType}"]`).forEach(input => {
                    input.closest('label').classList.remove('border-[#24b0ba]');
                });
                if (this.checked) {
                    this.closest('label').classList.add('border-[#24b0ba]');
                }
            });
        });
    </script>
</body>
</html>