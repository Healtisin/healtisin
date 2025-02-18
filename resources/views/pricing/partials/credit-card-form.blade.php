<div class="space-y-4">
    <div class="p-4 bg-gray-50 rounded-lg">
        <h4 class="font-medium mb-4">Detail Kartu Kredit</h4>
        
        <form id="creditCardForm" class="space-y-4">
            <div>
                <label class="block text-sm text-gray-600 mb-1">Nomor Kartu</label>
                <input type="text" 
                       id="cardNumber" 
                       class="w-full p-2 border rounded-lg" 
                       placeholder="1234 1234 1234 1234"
                       required>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-gray-600 mb-1">Tanggal Kadaluarsa</label>
                    <input type="text" 
                           id="expiry" 
                           class="w-full p-2 border rounded-lg" 
                           placeholder="MM/YY"
                           required>
                </div>
                <div>
                    <label class="block text-sm text-gray-600 mb-1">CVV/CVC</label>
                    <input type="text" 
                           id="cvv" 
                           class="w-full p-2 border rounded-lg" 
                           placeholder="123"
                           required>
                </div>
            </div>

            <div>
                <label class="block text-sm text-gray-600 mb-1">Nama Pemegang Kartu</label>
                <input type="text" 
                       id="cardHolder" 
                       class="w-full p-2 border rounded-lg" 
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
        <img src="/images/payments/visa.png" alt="Visa" class="h-6">
        <img src="/images/payments/mastercard.png" alt="Mastercard" class="h-6">
        <img src="/images/payments/jcb.png" alt="JCB" class="h-6">
    </div>
</div>