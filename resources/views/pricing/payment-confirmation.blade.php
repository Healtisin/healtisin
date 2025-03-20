<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('partials.title', ['segment' => 'Konfirmasi Pembayaran'])
    @include('partials.dark-mode-init')
    @vite('resources/css/app.css')
    @vite('resources/js/translate.js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('lang.language-modal')
</head>

<body class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200 transition-colors duration-200">
    <div class="min-h-screen flex flex-col">
        <header class="fixed w-full bg-white dark:bg-gray-800 shadow-sm z-10">
            <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
                <a href="{{ route('home') }}" class="inline-flex items-center text-gray-600 dark:text-gray-300 hover:text-[#24b0ba] dark:hover:text-[#73c7e3]">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span class="hidden sm:inline">Kembali ke Beranda</span>
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
                <!-- Status Pembayaran -->
                <div class="text-center mb-6 sm:mb-8">
                    <div class="inline-flex items-center justify-center w-12 sm:w-16 h-12 sm:h-16 bg-yellow-100 dark:bg-yellow-900 rounded-full mb-3 sm:mb-4">
                        <svg class="w-6 sm:w-8 h-6 sm:h-8 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h1 class="text-xl sm:text-2xl font-bold mb-2 dark:text-gray-100">Menunggu Pembayaran</h1>
                    <p class="text-sm sm:text-base text-gray-600 dark:text-gray-400">Selesaikan pembayaran sebelum</p>
                    <p class="text-base sm:text-lg font-semibold text-[#24b0ba] dark:text-[#73c7e3]">{{ $payment->expired_at->format('d M Y H:i') }} WIB</p>
                </div>

                <!-- Informasi Pembayaran -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 sm:p-8 mb-6 sm:mb-8">
                    <h3 class="text-lg sm:text-xl font-semibold mb-4 sm:mb-6 dark:text-gray-100">Informasi Pembayaran</h3>
                    <div class="space-y-3 sm:space-y-4">
                        <div class="flex justify-between">
                            <span class="text-sm sm:text-base text-gray-600 dark:text-gray-400">ID Pembayaran</span>
                            <span class="text-sm sm:text-base font-medium dark:text-gray-200">{{ $payment->id }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm sm:text-base text-gray-600 dark:text-gray-400">Total Pembayaran</span>
                            <span class="text-base sm:text-lg font-bold text-[#24b0ba] dark:text-[#73c7e3]">Rp {{ number_format($payment->amount, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm sm:text-base text-gray-600 dark:text-gray-400">Metode Pembayaran</span>
                            <span class="text-sm sm:text-base font-medium dark:text-gray-200">{{ strtoupper($payment->payment_method) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Instruksi Pembayaran -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 sm:p-8">
                    <h3 class="text-lg sm:text-xl font-semibold mb-4 sm:mb-6 dark:text-gray-100">Cara Pembayaran</h3>
                    @if($payment->payment_method === 'cc')
                    @include('pricing.partials.credit-card-form')
                    @elseif(in_array($payment->payment_method, ['bca', 'mandiri', 'bni']))
                    @include('pricing.partials.va-instructions', ['bank' => $payment->payment_method])
                    @else
                    @include('pricing.partials.ewallet-instructions', ['method' => $payment->payment_method])
                    @endif
                </div>
            </div>
            <!-- Debugging: Tampilkan Snap Token -->
            <div class="hidden">
                Snap Token: {{ $payment->snap_token }}
            </div>
        </main>
    </div>
    <!-- Load Midtrans Snap JS -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>

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

        document.addEventListener('DOMContentLoaded', function() {
            const snapToken = "{{ $payment->snap_token }}";
            console.log("Snap Token:", snapToken); // Debugging

            if (!snapToken) {
                alert('Snap Token tidak ditemukan. Silakan coba lagi.');
                return;
            }

            snap.pay(snapToken, {
                onSuccess: function(result) {
                    console.log("Success:", result);
                    window.location.href = "{{ route('home') }}";
                },
                onPending: function(result) {
                    console.log("Pending:", result);
                    window.location.href = "{{ route('home') }}";
                },
                onError: function(result) {
                    console.log("Error:", result);
                    window.location.href = "{{ route('home') }}";
                },
                onClose: function() {
                    console.log('Popup pembayaran ditutup.');
                }
            });
        });
    </script>
    <script>
        // Countdown Timer
        const expiredAt = new Date("{{ $payment->expired_at }}").getTime();

        function updateCountdown() {
            const now = new Date().getTime();
            const distance = expiredAt - now;

            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById('countdown').innerHTML =
                `${hours}:${minutes}:${seconds}`;

            if (distance < 0) {
                clearInterval(countdown);
                window.location.reload();
            }
        }

        const countdown = setInterval(updateCountdown, 1000);
        updateCountdown();

        document.addEventListener('DOMContentLoaded', function() {
            const checkPayment = async () => {
                try {
                    const response = await fetch(`/payment/check-status/{{ $payment->id }}`);
                    const data = await response.json();

                    if (data.status === 'success') {
                        window.location.href = data.redirect;
                    }
                } catch (error) {
                    console.error('Error checking payment status:', error);
                }
            };

            // Cek status setiap 5 detik
            setInterval(checkPayment, 5000);
        });

        document.addEventListener('DOMContentLoaded', function() {
            const creditCardForm = document.getElementById('creditCardForm');
            if (creditCardForm) {
                // Format nomor kartu
                const cardNumber = document.getElementById('cardNumber');
                cardNumber.addEventListener('input', function(e) {
                    let value = e.target.value.replace(/\D/g, '');
                    value = value.replace(/(\d{4})/g, '$1 ').trim();
                    e.target.value = value;
                });

                // Format expiry date
                const expiry = document.getElementById('expiry');
                expiry.addEventListener('input', function(e) {
                    let value = e.target.value.replace(/\D/g, '');
                    if (value.length >= 2) {
                        value = value.slice(0, 2) + '/' + value.slice(2);
                    }
                    e.target.value = value;
                });

                // Format CVV
                const cvv = document.getElementById('cvv');
                cvv.addEventListener('input', function(e) {
                    e.target.value = e.target.value.replace(/\D/g, '').slice(0, 3);
                });

                // Handle form submission
                creditCardForm.addEventListener('submit', async function(e) {
                    e.preventDefault();
                    // Implementasi integrasi payment gateway
                });
            }
        });
    </script>
</body>

</html>