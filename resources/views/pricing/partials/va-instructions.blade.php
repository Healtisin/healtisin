<div class="space-y-4">
    <div class="p-4 bg-gray-50 rounded-lg">
        <p class="font-medium mb-2">Nomor Virtual Account {{ strtoupper($bank) }}</p>
        <p class="text-xl font-bold">{{ $payment->payment_code }}</p>
        <p class="text-sm text-gray-600">a.n. {{ $payment->customer_name }}</p>
    </div>
    
    <div class="space-y-2">
        <p class="font-medium">Langkah-langkah:</p>
        <ol class="list-decimal list-inside space-y-2 text-gray-600">
            <li>Login ke m-banking atau internet banking {{ strtoupper($bank) }} Anda</li>
            <li>Pilih menu Pembayaran/Transfer Virtual Account</li>
            <li>Masukkan nomor Virtual Account: <span class="font-medium">{{ $payment->payment_code }}</span></li>
            <li>Periksa detail pembayaran:
                <ul class="list-disc list-inside ml-4 mt-2">
                    <li>Nama: {{ $payment->customer_name }}</li>
                    <li>Total: Rp {{ number_format($payment->amount, 0, ',', '.') }}</li>
                </ul>
            </li>
            <li>Konfirmasi dan selesaikan pembayaran</li>
        </ol>
    </div>

    <div class="mt-4 p-4 bg-yellow-50 rounded-lg">
        <div class="flex items-center gap-2 text-yellow-800">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-8h2m-4 0h2m-5 4h10M7 8h10"></path>
            </svg>
            <p>Waktu pembayaran tersisa:</p>
        </div>
        <p class="text-lg font-semibold text-yellow-800 mt-1" id="countdown"></p>
    </div>
</div>