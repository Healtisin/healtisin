<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Konfirmasi Pembayaran - Healtisin AI</title>
    @vite('resources/css/app.css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="bg-gray-50">
    <div class="min-h-screen flex flex-col">
        <header class="fixed w-full bg-white shadow-sm z-10">
            <div class="max-w-7xl mx-auto px-4 py-4">
                <a href="{{ route('home') }}" class="inline-flex items-center text-gray-600 hover:text-[#24b0ba]">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Kembali ke Beranda
                </a>
            </div>
        </header>

        <main class="flex-1 pt-20">
            <div class="max-w-3xl mx-auto px-4 py-12">
                <!-- Status Pembayaran -->
                <div class="text-center mb-8">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-yellow-100 rounded-full mb-4">
                        <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h1 class="text-2xl font-bold mb-2">Menunggu Pembayaran</h1>
                    <p class="text-gray-600">Selesaikan pembayaran sebelum</p>
                    <p class="text-lg font-semibold text-[#24b0ba]">{{ $payment->expired_at->format('d M Y H:i') }} WIB</p>
                </div>

                <!-- Informasi Pembayaran -->
                <div class="bg-white rounded-xl shadow-lg p-8 mb-8">
                    <h3 class="text-xl font-semibold mb-6">Informasi Pembayaran</h3>
                    <div class="space-y-4">
                        <div class="flex justify-between">
                            <span class="text-gray-600">ID Pembayaran</span>
                            <span class="font-medium">{{ $payment->id }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Total Pembayaran</span>
                            <span class="font-bold text-[#24b0ba]">Rp {{ number_format($payment->amount, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Metode Pembayaran</span>
                            <span class="font-medium">{{ strtoupper($payment->payment_method) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Instruksi Pembayaran -->
                <div class="bg-white rounded-xl shadow-lg p-8">
                    <h3 class="text-xl font-semibold mb-6">Cara Pembayaran</h3>
                    @if($payment->payment_method === 'paypal')
                    @include('pricing.partials.paypal-instructions')
                    @elseif($payment->payment_method === 'cc')
                    @include('pricing.partials.credit-card-form')
                    @elseif(in_array($payment->payment_method, ['bca', 'mandiri', 'bni']))
                    @include('pricing.partials.va-instructions', ['bank' => $payment->payment_method])
                    @else
                    @include('pricing.partials.ewallet-instructions', ['method' => $payment->payment_method])
                    @endif
                </div>

                @if($payment->payment_method === 'paypal')
                <script src="https://www.paypal.com/sdk/js?client-id={{ config('services.paypal.client_id') }}&currency=IDR"></script>
                <script>
                    paypal.Buttons({
                        createOrder: function(data, actions) {
                            return actions.order.create({
                                purchase_units: [{
                                    amount: {
                                        value: '{{ number_format($payment->amount / 15000, 2) }}' // Konversi ke USD
                                    },
                                    description: 'Pro Subscription - {{ $payment->duration }} Month(s)'
                                }]
                            });
                        },
                        onApprove: async function(data, actions) {
                            const order = await actions.order.capture();

                            // Update status pembayaran
                            const response = await fetch(`/payment/process-paypal/${order.id}/{{ $payment->id }}`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                }
                            });

                            if (response.ok) {
                                window.location.href = '{{ route("home") }}';
                            }
                        }
                    }).render('#paypal-button-container');
                </script>
                @endif
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