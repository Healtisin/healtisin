<div id="passwordVerificationModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg w-[400px] p-6">
        <div class="flex items-center justify-between mb-4">
            <h4 class="text-lg font-medium">Verifikasi Password</h4>
            <button onclick="closePasswordVerificationModal()" class="p-1 hover:bg-gray-100 rounded-full">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        
        <p class="text-sm text-gray-600 mb-4">
            Masukkan password Anda saat ini untuk melihat password.
        </p>

        <div class="mb-4">
            <input type="password" 
                   id="verification_password" 
                   class="w-full px-3 py-2 border rounded-md"
                   placeholder="Masukkan password Anda">
            <p id="verification_error" class="text-red-500 text-sm mt-1 hidden">
                Password yang Anda masukkan salah
            </p>
        </div>

        <div class="flex justify-end gap-2">
            <button onclick="closePasswordVerificationModal()" 
                    class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-md">
                Batal
            </button>
            <button onclick="verifyPassword()" 
                    class="px-4 py-2 bg-[#24b0ba] text-white rounded-md hover:bg-[#73c7e3]">
                Lihat Password
            </button>
        </div>
    </div>
</div>
