<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mulai Pro - Healtisin AI</title>
    @vite('resources/css/app.css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex flex-col">

        <!-- Main Content -->
        <main class="flex-1 pt-20">
            <div class="max-w-3xl mx-auto px-4 py-12">
                <!-- Tombol Kembali -->
                <a href="{{ url()->previous() == url('/') ? '/' : '/home' }}"
                    class="fixed left-8 top-[90px] inline-flex items-center px-6 py-2.5 bg-white border border-gray-300 
                            rounded-lg shadow-sm hover:bg-gray-50 transition-colors duration-200
                            text-gray-700 hover:text-[#24b0ba] hover:border-[#24b0ba]">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali
                </a>

                <div class="text-center mb-8">
                    <h1 class="text-3xl font-bold mb-4">Tingkatkan ke Pro</h1>
                    <p class="text-gray-600">Nikmati layanan kesehatan yang lebih lengkap dengan Healtisin Pro</p>
                </div>

                <!-- Feature Comparison -->
                <div class="bg-white rounded-xl shadow-lg p-8 mb-8">
                    <h3 class="text-xl font-semibold mb-6">Perbandingan Fitur</h3>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b">
                                    <th class="text-left py-4">Fitur</th>
                                    <th class="text-center py-4">Free</th>
                                    <th class="text-center py-4">Pro</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y">
                                <tr>
                                    <td class="py-4">Konsultasi Kesehatan</td>
                                    <td class="text-center">Dasar</td>
                                    <td class="text-center">Tak Terbatas</td>
                                </tr>
                                <tr>
                                    <td class="py-4">Skrining Kesehatan</td>
                                    <td class="text-center">Terbatas</td>
                                    <td class="text-center">Lengkap</td>
                                </tr>
                                <tr>
                                    <td class="py-4">Model AI</td>
                                    <td class="text-center">Dasar</td>
                                    <td class="text-center">Terbaru</td>
                                </tr>
                                <tr>
                                    <td class="py-4">Dukungan</td>
                                    <td class="text-center">Email</td>
                                    <td class="text-center">Prioritas 24/7</td>
                                </tr>
                                <tr>
                                    <td class="py-4">Riwayat Chat</td>
                                    <td class="text-center">7 hari</td>
                                    <td class="text-center">Tak terbatas</td>
                                </tr>
                                <tr>
                                    <td class="py-4">Ekspor Data Kesehatan</td>
                                    <td class="text-center">
                                        <svg class="w-5 h-5 text-red-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </td>
                                    <td class="text-center">
                                        <svg class="w-5 h-5 text-green-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Duration Selection -->
                <div class="bg-white rounded-xl shadow-lg p-8 mb-8">
                    <h3 class="text-xl font-semibold mb-6">Pilih Jangka Waktu</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <label class="relative border rounded-xl p-4 cursor-pointer hover:border-[#24b0ba]">
                            <input type="radio" name="duration" value="1" class="hidden" checked>
                            <div class="text-center">
                                <h4 class="font-semibold mb-2">1 Bulan</h4>
                                <p class="text-2xl font-bold text-[#24b0ba] mb-1">Rp 99.000</p>
                                <p class="text-sm text-gray-500">Rp 99.000/bulan</p>
                            </div>
                        </label>

                        <label class="relative border rounded-xl p-4 cursor-pointer hover:border-[#24b0ba]">
                            <input type="radio" name="duration" value="3" class="hidden">
                            <div class="absolute -top-3 right-3">
                                <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">
                                    Hemat 10%
                                </span>
                            </div>
                            <div class="text-center">
                                <h4 class="font-semibold mb-2">3 Bulan</h4>
                                <p class="text-2xl font-bold text-[#24b0ba] mb-1">Rp 267.300</p>
                                <p class="text-sm text-gray-500">Rp 89.100/bulan</p>
                            </div>
                        </label>

                        <label class="relative border rounded-xl p-4 cursor-pointer hover:border-[#24b0ba]">
                            <input type="radio" name="duration" value="6" class="hidden">
                            <div class="absolute -top-3 right-3">
                                <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">
                                    Hemat 15%
                                </span>
                            </div>
                            <div class="text-center">
                                <h4 class="font-semibold mb-2">6 Bulan</h4>
                                <p class="text-2xl font-bold text-[#24b0ba] mb-1">Rp 504.900</p>
                                <p class="text-sm text-gray-500">Rp 84.150/bulan</p>
                            </div>
                        </label>

                        <label class="relative border rounded-xl p-4 cursor-pointer hover:border-[#24b0ba]">
                            <input type="radio" name="duration" value="12" class="hidden">
                            <div class="absolute -top-3 right-3">
                                <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">
                                    Hemat 25%
                                </span>
                            </div>
                            <div class="text-center">
                                <h4 class="font-semibold mb-2">1 Tahun</h4>
                                <p class="text-2xl font-bold text-[#24b0ba] mb-1">Rp 891.000</p>
                                <p class="text-sm text-gray-500">Rp 74.250/bulan</p>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="bg-white rounded-xl shadow-lg p-8 mb-8">
                    <h3 class="text-xl font-semibold mb-6">Pilih Metode Pembayaran</h3>
                    <div class="space-y-4">
                        <!-- E-Wallet -->
                        <div class="space-y-4">
                            <h4 class="font-medium text-gray-600">E-Wallet</h4>
                            <label class="border rounded-lg p-4 cursor-pointer hover:border-[#24b0ba] block">
                                <input type="radio" name="payment_method" value="gopay" class="hidden">
                                <div class="flex items-center gap-3">
                                    <img src="{{ asset('images/payments/gopay.png') }}" alt="GoPay" class="h-6">
                                    <span>GoPay</span>
                                </div>
                            </label>
                            <label class="border rounded-lg p-4 cursor-pointer hover:border-[#24b0ba] block">
                                <input type="radio" name="payment_method" value="dana" class="hidden">
                                <div class="flex items-center gap-3">
                                    <img src="{{ asset('images/payments/dana.jpeg') }}" alt="DANA" class="h-6">
                                    <span>DANA</span>
                                </div>
                            </label>
                            <label class="border rounded-lg p-4 cursor-pointer hover:border-[#24b0ba] block">
                                <input type="radio" name="payment_method" value="shopeepay" class="hidden">
                                <div class="flex items-center gap-3">
                                    <img src="{{ asset('images/payments/shopeepay.png') }}" alt="ShopeePay" class="h-6">
                                    <span>ShopeePay</span>
                                </div>
                            </label>
                        </div>

                        <!-- Bank Transfer & QRIS -->
                        <div class="space-y-4">
                            <h4 class="font-medium text-gray-600">Transfer Bank & QRIS</h4>
                            <label class="border rounded-lg p-4 cursor-pointer hover:border-[#24b0ba] block">
                                <input type="radio" name="payment_method" value="qris" class="hidden">
                                <div class="flex items-center gap-3">
                                    <img src="{{ asset('images/payments/qris.png') }}" alt="QRIS" class="h-6">
                                    <span>QRIS</span>
                                </div>
                            </label>
                            <label class="border rounded-lg p-4 cursor-pointer hover:border-[#24b0ba] block">
                                <input type="radio" name="payment_method" value="bank_transfer" class="hidden">
                                <div class="flex items-center gap-3">
                                    <img src="{{ asset('images/payments/bank.jpg') }}" alt="Transfer Bank" class="h-6">
                                    <span>Transfer Bank</span>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Transaction Details -->
                <div class="bg-white rounded-xl shadow-lg p-8 mb-8">
                    <h3 class="text-xl font-semibold mb-6">Detail Transaksi</h3>
                    
                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Paket Pro</span>
                            <span class="font-medium duration-price">Rp 99.000</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Jangka Waktu</span>
                            <span class="font-medium duration-text">1 Bulan</span>
                        </div>
                        <div class="flex justify-between items-center text-green-600">
                            <span>Penghematan</span>
                            <span class="font-medium savings-amount">-</span>
                        </div>
                        <div class="border-t pt-4">
                            <div class="flex justify-between items-center">
                                <span class="font-semibold">Total Pembayaran</span>
                                <span class="text-xl font-bold text-[#24b0ba] total-amount">Rp 99.000</span>
                            </div>
                        </div>
                    </div>
                </div>

                @auth
                    <button type="submit" class="w-full bg-[#24b0ba] text-white py-4 rounded-full hover:bg-[#73c7e3] transition-colors text-lg font-semibold">
                        Lanjutkan ke Pembayaran
                    </button>
                @else
                    <div class="text-center py-8">
                        <p class="text-gray-600 mb-4">Silakan login terlebih dahulu untuk melakukan pembayaran</p>
                        <a href="{{ route('login') }}" class="inline-block px-6 py-2 bg-[#24b0ba] text-white rounded-full hover:bg-[#1d8f98]">
                            Login
                        </a>
                    </div>
                @endauth

                <div class="text-center text-sm text-gray-600 mt-4">
                    <p>Dengan melanjutkan, Anda menyetujui <a href="#" class="text-[#24b0ba] hover:underline">Syarat dan Ketentuan</a> kami</p>
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

    <script>
        // Handle radio button styling for payment methods
        const paymentLabels = document.querySelectorAll('input[name="payment_method"]');
        paymentLabels.forEach(radio => {
            radio.addEventListener('change', function() {
                // Reset all borders
                document.querySelectorAll('input[name="payment_method"]').forEach(r => {
                    r.parentElement.classList.remove('border-[#24b0ba]');
                });
                // Set selected border
                if (this.checked) {
                    this.parentElement.classList.add('border-[#24b0ba]');
                }
            });
        });

        // Handle duration selection and price calculation
        const durationRadios = document.querySelectorAll('input[name="duration"]');
        const basePrice = 99000;
        const discounts = {
            '1': 0,
            '3': 0.10,
            '6': 0.15,
            '12': 0.25
        };

        durationRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                // Reset all borders
                document.querySelectorAll('input[name="duration"]').forEach(r => {
                    r.parentElement.classList.remove('border-[#24b0ba]');
                });
                // Set selected border
                if (this.checked) {
                    this.parentElement.classList.add('border-[#24b0ba]');
                    updatePricing(this.value);
                }
            });
        });

        function updatePricing(duration) {
            const discount = discounts[duration];
            const months = parseInt(duration);
            const totalBeforeDiscount = basePrice * months;
            const savings = totalBeforeDiscount * discount;
            const totalAfterDiscount = totalBeforeDiscount - savings;

            // Update duration text
            document.querySelector('.duration-text').textContent = 
                months === 12 ? '1 Tahun' : `${months} Bulan`;

            // Update base price
            document.querySelector('.duration-price').textContent = 
                `Rp ${totalBeforeDiscount.toLocaleString('id-ID')}`;

            // Update savings
            document.querySelector('.savings-amount').textContent = 
                savings > 0 ? `Rp ${savings.toLocaleString('id-ID')}` : '-';

            // Update total amount
            document.querySelector('.total-amount').textContent = 
                `Rp ${totalAfterDiscount.toLocaleString('id-ID')}`;
        }

        // Initialize with default values
        updatePricing('1');
    </script>
</body>
</html>