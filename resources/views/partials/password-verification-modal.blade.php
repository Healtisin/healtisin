<div id="passwordVerificationModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white dark:bg-gray-800 rounded-lg w-[400px] p-6">
        <div class="flex items-center justify-between mb-4">
            <h4 class="text-lg font-medium dark:text-gray-100">Verifikasi Password</h4>
            <button onclick="closePasswordVerificationModal()" class="p-1 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full">
                <svg class="w-6 h-6 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        
        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
            Masukkan password Anda saat ini untuk melihat password.
        </p>

        <div class="mb-4">
            <input type="password" 
                   id="verification_password" 
                   class="w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200"
                   placeholder="Masukkan password Anda">
            <p id="verification_error" class="text-red-500 dark:text-red-400 text-sm mt-1 hidden">
                Password yang Anda masukkan salah
            </p>
        </div>

        <div class="flex justify-end gap-2">
            <button onclick="closePasswordVerificationModal()" 
                    class="px-4 py-2 text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md">
                Batal
            </button>
            <button onclick="verifyPassword()" 
                    class="px-4 py-2 bg-[#24b0ba] text-white rounded-md hover:bg-[#73c7e3] dark:bg-[#24b0ba]/80 dark:hover:bg-[#73c7e3]/80">
                Lihat Password
            </button>
        </div>
    </div>
</div>

<script>
function closePasswordVerificationModal() {
    const modal = document.getElementById('passwordVerificationModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

function verifyPassword() {
    // Contoh logika verifikasi minimal; pastikan implementasi logika verifikasi sesuai kebutuhan.
    const input = document.getElementById('verification_password');
    if (input.value === 'passwordAnda') {
        alert("Password yang Anda masukkan benar!");
        closePasswordVerificationModal();
    } else {
        document.getElementById('verification_error').classList.remove('hidden');
    }
}
</script>

