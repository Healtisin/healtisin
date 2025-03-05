<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pilih Paket - Healtisin AI</title>
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
        <!-- Header -->
        <header class="fixed w-full bg-white shadow-sm z-10">
            <div class="max-w-7xl mx-auto px-4 py-4">
                <a href="{{ route('pricing.pro') }}" class="inline-flex items-center text-gray-600 hover:text-[#24b0ba]">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali
                </a>
            </div>
        </header>

        <main class="flex-1 pt-20">
            <div class="max-w-3xl mx-auto px-4 py-12">
                <!-- Progress Steps -->
                <div class="flex items-center justify-center mb-12">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-[#24b0ba] text-white rounded-full flex items-center justify-center">1</div>
                        <div class="h-1 w-16 bg-[#24b0ba]"></div>
                        <div class="w-8 h-8 bg-gray-200 text-gray-600 rounded-full flex items-center justify-center">2</div>
                        <div class="h-1 w-16 bg-gray-200"></div>
                        <div class="w-8 h-8 bg-gray-200 text-gray-600 rounded-full flex items-center justify-center">3</div>
                    </div>
                </div>

                <form action="{{ route('pricing.payment-details') }}" method="POST" class="space-y-8">
                    @csrf
                    <!-- Pilihan Paket -->
                    <div class="bg-white rounded-xl shadow-lg p-8">
                        <h3 class="text-xl font-semibold mb-6">Pilih Paket Pro</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @foreach($packages as $package)
                            <label class="relative border rounded-xl p-4 cursor-pointer hover:border-[#24b0ba]">
                                <input type="radio" name="package" value="{{ $package['duration'] }}" 
                                       class="hidden" required>
                                <div class="text-center">
                                    @if($package['discount'] > 0)
                                    <div class="absolute -top-3 right-3">
                                        <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">
                                            Hemat {{ $package['discount'] }}%
                                        </span>
                                    </div>
                                    @endif
                                    <h4 class="font-semibold mb-2">{{ $package['name'] }}</h4>
                                    <p class="text-2xl font-bold text-[#24b0ba] mb-1">
                                        Rp {{ number_format($package['total'], 0, ',', '.') }}
                                    </p>
                                    <p class="text-sm text-gray-500">
                                        Rp {{ number_format($package['monthly'], 0, ',', '.') }}/bulan
                                    </p>
                                </div>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Metode Pembayaran -->
                    <div class="bg-white rounded-xl shadow-lg p-8">
                        <h3 class="text-xl font-semibold mb-6">Pilih Metode Pembayaran</h3>
                        <div class="space-y-6">
                            <!-- E-Wallet -->
                            <div class="space-y-4">
                                <h4 class="font-medium text-gray-600">E-Wallet</h4>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    @foreach($ewallets as $ewallet)
                                    <label class="border rounded-lg p-4 cursor-pointer hover:border-[#24b0ba]">
                                        <input type="radio" name="payment_method" value="{{ $ewallet['code'] }}" 
                                               class="hidden" required>
                                        <div class="flex items-center gap-3">
                                            <img src="{{ asset($ewallet['icon']) }}" alt="{{ $ewallet['name'] }}" 
                                                 class="h-6">
                                            <span>{{ $ewallet['name'] }}</span>
                                        </div>
                                    </label>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Bank Transfer -->
                            <div class="space-y-4">
                                <h4 class="font-medium text-gray-600">Transfer Bank</h4>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    @foreach($banks as $bank)
                                    <label class="border rounded-lg p-4 cursor-pointer hover:border-[#24b0ba]">
                                        <input type="radio" name="payment_method" value="{{ $bank['code'] }}" 
                                               class="hidden" required>
                                        <div class="flex items-center gap-3">
                                            <img src="{{ asset($bank['icon']) }}" alt="{{ $bank['name'] }}" 
                                                 class="h-6">
                                            <span>{{ $bank['name'] }}</span>
                                        </div>
                                    </label>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Kartu Kredit -->
                            <div class="space-y-4">
                                <h4 class="font-medium text-gray-600">Kartu Kredit</h4>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <label class="border rounded-lg p-4 cursor-pointer hover:border-[#24b0ba]">
                                        <input type="radio" name="payment_method" value="cc" class="hidden" required>
                                        <div class="flex items-center gap-3">
                                            <img src="{{ asset('images/payments/cc.png') }}" alt="Kartu Kredit" class="h-6">
                                            <span>Kartu Kredit</span>
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