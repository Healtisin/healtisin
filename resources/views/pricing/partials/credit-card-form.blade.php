<div class="space-y-4">
    <div class="p-4 bg-gray-50 dark:bg-gray-800 rounded-lg">
        <h4 class="font-medium mb-4 dark:text-gray-200">Detail Kartu Kredit</h4>
        
        <form id="creditCardForm" class="space-y-4">
            <div>
                <label class="block text-sm text-gray-600 dark:text-gray-400 mb-1">Nomor Kartu</label>
                <input type="text" 
                       id="cardNumber" 
                       class="w-full p-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200" 
                       placeholder="1234 1234 1234 1234"
                       required>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-gray-600 dark:text-gray-400 mb-1">Tanggal Kadaluarsa</label>
                    <input type="text" 
                           id="expiry" 
                           class="w-full p-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200" 
                           placeholder="MM/YY"
                           required>
                </div>
                <div>
                    <label class="block text-sm text-gray-600 dark:text-gray-400 mb-1">CVV/CVC</label>
                    <input type="text" 
                           id="cvv" 
                           class="w-full p-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200" 
                           placeholder="123"
                           required>
                </div>
            </div>

            <div>
                <label class="block text-sm text-gray-600 dark:text-gray-400 mb-1">Nama Pemegang Kartu</label>
                <input type="text" 
                       id="cardHolder" 
                       class="w-full p-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200" 
                       placeholder="Nama sesuai kartu"
                       required>
            </div>

            <button type="submit" 
                    class="w-full bg-[#24b0ba] text-white py-3 rounded-full hover:bg-[#73c7e3] transition-colors">
                Bayar Sekarang
            </button>
        </form>
    </div>

    <div class="flex items-center justify-center gap-2">
        <img src="/images/payments/visa.png" alt="Visa" class="h-6 dark:opacity-80">
        <img src="/images/payments/mastercard.png" alt="Mastercard" class="h-6 dark:opacity-80">
        <img src="/images/payments/jcb.png" alt="JCB" class="h-6 dark:opacity-80">
    </div>
</div>