<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Pembayaran - Healtisin AI</title>
    @vite('resources/css/app.css')
    @vite('resources/js/translate.js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('lang.language-modal')
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <header class="fixed w-full bg-white shadow-sm z-10">
            <div class="max-w-7xl mx-auto px-4 py-4">
                <a href="{{ route('pricing.select-package') }}" 
                   class="inline-flex items-center text-gray-600 hover:text-[#24b0ba]">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
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
                        <div class="w-8 h-8 bg-[#24b0ba] text-white rounded-full flex items-center justify-center">2</div>
                        <div class="h-1 w-16 bg-[#24b0ba]"></div>
                        <div class="w-8 h-8 bg-gray-200 text-gray-600 rounded-full flex items-center justify-center">3</div>
                    </div>
                </div>

                <form action="{{ route('pricing.process-payment') }}" method="POST" class="space-y-8">
                    @csrf
                    <input type="hidden" name="package_id" value="{{ $package['id'] }}">
                    <input type="hidden" name="payment_method" value="{{ $payment_method }}">

                    <!-- Detail Informasi -->
                    <div class="bg-white rounded-xl shadow-lg p-8">
                        <h3 class="text-xl font-semibold mb-6">Informasi Pembayaran</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                                <input type="text" name="full_name" required
                                       class="w-full px-4 py-2 border rounded-lg focus:ring-[#24b0ba] focus:border-[#24b0ba]"
                                       value="{{ auth()->user()->name }}">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input type="email" name="email" required
                                       class="w-full px-4 py-2 border rounded-lg bg-gray-50" 
                                       value="{{ auth()->user()->email }}" readonly>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nomor HP</label>
                                <input type="tel" name="phone" required
                                       class="w-full px-4 py-2 border rounded-lg focus:ring-[#24b0ba] focus:border-[#24b0ba]"
                                       placeholder="Contoh: 08123456789">
                            </div>

                            @if($payment_method === 'credit_card')
                            <div class="space-y-4 pt-4 border-t">
                                <h4 class="font-medium">Detail Kartu Kredit</h4>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Kartu</label>
                                    <input type="text" name="card_number" required
                                           class="w-full px-4 py-2 border rounded-lg focus:ring-[#24b0ba] focus:border-[#24b0ba]"
                                           placeholder="1234 5678 9012 3456">
                                </div>
                                
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Kadaluarsa</label>
                                        <input type="text" name="expiry_date" required
                                               class="w-full px-4 py-2 border rounded-lg focus:ring-[#24b0ba] focus:border-[#24b0ba]"
                                               placeholder="MM/YY">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">CVV</label>
                                        <input type="text" name="cvv" required maxlength="3"
                                               class="w-full px-4 py-2 border rounded-lg focus:ring-[#24b0ba] focus:border-[#24b0ba]"
                                               placeholder="123">
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Ringkasan Pembayaran -->
                    <div class="bg-white rounded-xl shadow-lg p-8">
                        <h3 class="text-xl font-semibold mb-6">Ringkasan Pembayaran</h3>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Paket Pro {{ $package['name'] }}</span>
                                <span class="font-medium">Rp {{ number_format($package['total'], 0, ',', '.') }}</span>
                            </div>
                            @if($package['discount'] > 0)
                            <div class="flex justify-between items-center text-green-600">
                                <span>Hemat {{ $package['discount'] }}%</span>
                                <span>-Rp {{ number_format($package['savings'], 0, ',', '.') }}</span>
                            </div>
                            @endif
                            <div class="flex justify-between items-center pt-4 border-t font-bold">
                                <span>Total Pembayaran</span>
                                <span class="text-xl text-[#24b0ba]">
                                    Rp {{ number_format($package['final_total'], 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <button type="submit" 
                            class="w-full bg-[#24b0ba] text-white py-4 rounded-full hover:bg-[#73c7e3] 
                                   transition-colors text-lg font-semibold">
                        Bayar Sekarang
                    </button>
                </form>
            </div>
        </main>
    </div>

    <script>
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