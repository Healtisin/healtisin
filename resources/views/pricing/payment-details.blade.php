<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('partials.title', ['segment' => 'Detail Pembayaran'])
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
                <a href="{{ route('pricing.select-package') }}" 
                   class="inline-flex items-center text-gray-600 dark:text-gray-300 hover:text-[#24b0ba] dark:hover:text-[#73c7e3]">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
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

        <main class="flex-1 pt-16 sm:pt-20">
            <div class="max-w-3xl mx-auto px-4 py-8 sm:py-12">
                <!-- Progress Steps -->
                <div class="flex items-center justify-center mb-8 sm:mb-12">
                    <div class="flex items-center">
                        <div class="w-6 sm:w-8 h-6 sm:h-8 bg-[#24b0ba] text-white rounded-full flex items-center justify-center text-sm sm:text-base">1</div>
                        <div class="h-1 w-12 sm:w-16 bg-[#24b0ba]"></div>
                        <div class="w-6 sm:w-8 h-6 sm:h-8 bg-[#24b0ba] text-white rounded-full flex items-center justify-center text-sm sm:text-base">2</div>
                        <div class="h-1 w-12 sm:w-16 bg-[#24b0ba]"></div>
                        <div class="w-6 sm:w-8 h-6 sm:h-8 bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-400 rounded-full flex items-center justify-center text-sm sm:text-base">3</div>
                    </div>
                </div>

                <form action="{{ route('pricing.process-payment') }}" method="POST" class="space-y-6 sm:space-y-8">
                    @csrf
                    <input type="hidden" name="package_id" value="{{ $package['id'] }}">
                    <input type="hidden" name="payment_method" value="{{ $payment_method }}">

                    <!-- Detail Informasi -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 sm:p-8">
                        <h3 class="text-lg sm:text-xl font-semibold mb-4 sm:mb-6 dark:text-gray-100">Informasi Pembayaran</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Lengkap</label>
                                <input type="text" name="full_name" required
                                       class="w-full px-3 sm:px-4 py-2 border rounded-lg focus:ring-[#24b0ba] focus:border-[#24b0ba] dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 text-sm sm:text-base"
                                       value="{{ auth()->user()->name }}">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
                                <input type="email" name="email" required
                                       class="w-full px-3 sm:px-4 py-2 border rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 text-sm sm:text-base" 
                                       value="{{ auth()->user()->email }}" readonly>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nomor HP</label>
                                <input type="tel" name="phone" required
                                       class="w-full px-3 sm:px-4 py-2 border rounded-lg focus:ring-[#24b0ba] focus:border-[#24b0ba] dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 text-sm sm:text-base"
                                       placeholder="Contoh: 08123456789">
                            </div>

                            @if($payment_method === 'credit_card')
                            <div class="space-y-4 pt-4 border-t dark:border-gray-700">
                                <h4 class="font-medium text-base sm:text-lg dark:text-gray-200">Detail Kartu Kredit</h4>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nomor Kartu</label>
                                    <input type="text" name="card_number" required
                                           class="w-full px-3 sm:px-4 py-2 border rounded-lg focus:ring-[#24b0ba] focus:border-[#24b0ba] dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 text-sm sm:text-base"
                                           placeholder="1234 5678 9012 3456">
                                </div>
                                
                                <div class="grid grid-cols-2 gap-3 sm:gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tanggal Kadaluarsa</label>
                                        <input type="text" name="expiry_date" required
                                               class="w-full px-3 sm:px-4 py-2 border rounded-lg focus:ring-[#24b0ba] focus:border-[#24b0ba] dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 text-sm sm:text-base"
                                               placeholder="MM/YY">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">CVV</label>
                                        <input type="text" name="cvv" required maxlength="3"
                                               class="w-full px-3 sm:px-4 py-2 border rounded-lg focus:ring-[#24b0ba] focus:border-[#24b0ba] dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 text-sm sm:text-base"
                                               placeholder="123">
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Ringkasan Pembayaran -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 sm:p-8">
                        <h3 class="text-lg sm:text-xl font-semibold mb-4 sm:mb-6 dark:text-gray-100">Ringkasan Pembayaran</h3>
                        <div class="space-y-3 sm:space-y-4">
                            <div class="flex justify-between items-center">
                                <span class="text-sm sm:text-base text-gray-600 dark:text-gray-400">Paket Pro {{ $package['name'] }}</span>
                                <span class="text-sm sm:text-base font-medium dark:text-gray-200">Rp {{ number_format($package['total'], 0, ',', '.') }}</span>
                            </div>
                            @if($package['discount'] > 0)
                            <div class="flex justify-between items-center text-green-600 dark:text-green-400">
                                <span class="text-sm sm:text-base">Hemat {{ $package['discount'] }}%</span>
                                <span class="text-sm sm:text-base">-Rp {{ number_format($package['savings'], 0, ',', '.') }}</span>
                            </div>
                            @endif
                            <div class="flex justify-between items-center pt-3 sm:pt-4 border-t dark:border-gray-700 font-bold">
                                <span class="text-sm sm:text-base dark:text-gray-200">Total Pembayaran</span>
                                <span class="text-lg sm:text-xl text-[#24b0ba] dark:text-[#73c7e3]">
                                    Rp {{ number_format($package['final_total'], 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <button type="submit" 
                            class="w-full bg-[#24b0ba] text-white py-3 sm:py-4 rounded-full hover:bg-[#73c7e3] 
                                   transition-colors text-base sm:text-lg font-semibold">
                        Bayar Sekarang
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

        // Format nomor kartu kredit
        const cardInput = document.querySelector('input[name="card_number"]');
        if (cardInput) {
            cardInput.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                value = value.replace(/(\d{4})/g, '$1 ').trim();
                e.target.value = value;
            });
        }

        // Format tanggal kadaluarsa
        const expiryInput = document.querySelector('input[name="expiry_date"]');
        if (expiryInput) {
            expiryInput.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                if (value.length >= 2) {
                    value = value.slice(0,2) + '/' + value.slice(2);
                }
                e.target.value = value;
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form[action="{{ route("pricing.process-payment") }}"]');
            const submitButton = form.querySelector('button[type="submit"]');

            form.addEventListener('submit', function(e) {
                // Cek apakah form sudah di-submit
                if (form.getAttribute('data-submitting') === 'true') {
                    e.preventDefault();
                    return;
                }

                // Set flag bahwa form sedang di-submit
                form.setAttribute('data-submitting', 'true');
                
                // Nonaktifkan tombol
                submitButton.disabled = true;
                submitButton.innerHTML = `
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Memproses...
                `;
            });
        });
    </script>
</body>
</html>