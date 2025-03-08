<div class="space-y-4">
    <div class="p-4 bg-gray-50 dark:bg-gray-800 rounded-lg text-center">
        @if($method == 'qris')
            <p class="font-medium mb-2 dark:text-gray-200">Scan QRIS</p>
            <img src="{{ $payment->qr_code }}" alt="QRIS Code" class="mx-auto h-48 mb-2 dark:opacity-90">
        @else
            <p class="font-medium mb-2 dark:text-gray-200">Kode Pembayaran {{ strtoupper($method) }}</p>
            <p class="text-xl font-bold dark:text-gray-100">{{ $payment->payment_code }}</p>
        @endif
    </div>
    
    <div class="space-y-2">
        <p class="font-medium dark:text-gray-200">Langkah-langkah:</p>
        <ol class="list-decimal list-inside space-y-2 text-gray-600 dark:text-gray-400">
            @if($method == 'gopay')
                <li>Buka aplikasi Gojek</li>
                <li>Pilih menu Bayar</li>
                <li>Masukkan kode pembayaran</li>
            @elseif($method == 'ovo')
                <li>Buka aplikasi OVO</li>
                <li>Pilih menu Scan</li>
                <li>Scan QR Code atau masukkan kode pembayaran</li>
            @elseif($method == 'dana')
                <li>Buka aplikasi DANA</li>
                <li>Pilih menu Scan</li>
                <li>Scan QR Code atau masukkan kode pembayaran</li>
            @endif
            <li>Periksa detail pembayaran</li>
            <li>Konfirmasi pembayaran</li>
        </ol>
    </div>

    <div class="mt-4 p-4 bg-yellow-50 dark:bg-yellow-900/30 rounded-lg">
        <div class="flex items-center gap-2 text-yellow-800 dark:text-yellow-400">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-8h2m-4 0h2m-5 4h10M7 8h10"></path>
            </svg>
            <p>Waktu pembayaran tersisa:</p>
        </div>
        <p class="text-lg font-semibold text-yellow-800 dark:text-yellow-400 mt-1" id="countdown"></p>
    </div>
</div>