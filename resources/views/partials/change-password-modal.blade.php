<div id="changePasswordModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4">
    <div class="bg-white dark:bg-gray-800 rounded-lg w-full max-w-[500px]">
        <!-- Modal Header -->
        <div class="flex items-center justify-between p-3 sm:p-4 border-b dark:border-gray-700">
            <div class="flex items-center gap-2 sm:gap-3">
                <button onclick="closeChangePasswordModal()" class="p-1.5 sm:p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <h3 class="text-lg sm:text-xl font-semibold dark:text-gray-100">Ubah Password</h3>
            </div>
        </div>

        <!-- Alert Messages -->
        <div id="passwordChangeAlert" class="hidden mx-4 sm:mx-6 mt-3 sm:mt-4"></div>

        <!-- Modal Content -->
        <div class="p-4 sm:p-6">
            <form id="changePasswordForm" method="POST" action="{{ route('password.change.update') }}" onsubmit="handlePasswordChange(event)">
                @csrf
                <div class="mb-4">
                    <label class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Password Saat Ini</label>
                    <input type="password" id="current_password" name="current_password" 
                           class="w-full px-3 py-2 text-sm sm:text-base border rounded-md bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200" required>
                    <span id="current_password_error" class="text-red-600 text-xs sm:text-sm hidden"></span>
                </div>

                <div class="mb-4">
                    <label class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Password Baru</label>
                    <input type="password" id="password" name="password" 
                           class="w-full px-3 py-2 text-sm sm:text-base border rounded-md bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200" required>
                    <span id="password_error" class="text-red-600 text-xs sm:text-sm hidden"></span>
                </div>

                <div class="mb-6">
                    <label class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Konfirmasi Password Baru</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" 
                           class="w-full px-3 py-2 text-sm sm:text-base border rounded-md bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200" required>
                </div>

                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeChangePasswordModal()" 
                            class="px-3 sm:px-4 py-2 text-sm sm:text-base text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md">
                        Batal
                    </button>
                    <button type="submit" class="px-3 sm:px-4 py-2 text-sm sm:text-base bg-[#24b0ba] text-white rounded-md hover:bg-[#73c7e3]">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
async function handlePasswordChange(e) {
    e.preventDefault();
    const form = document.getElementById('changePasswordForm');
    const formData = new FormData(form);
    const alertDiv = document.getElementById('passwordChangeAlert');

    try {
        const response = await fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value,
                'Accept': 'application/json'
            },
            body: formData
        });
        
        const data = await response.json();
        if (!response.ok) {
            throw new Error(data.message || 'Terjadi kesalahan');
        }
        
        alertDiv.innerHTML = `<div class="bg-green-100 border border-green-400 text-green-700 px-3 sm:px-4 py-2 sm:py-3 rounded text-sm sm:text-base">${data.message}</div>`;
        alertDiv.classList.remove('hidden');
        form.reset();
        
        setTimeout(() => {
            closeChangePasswordModal();
        }, 2000);
    } catch (error) {
        alertDiv.innerHTML = `<div class="bg-red-100 border border-red-400 text-red-700 px-3 sm:px-4 py-2 sm:py-3 rounded text-sm sm:text-base">${error.message}</div>`;
        alertDiv.classList.remove('hidden');
    }
}

function closeChangePasswordModal() {
    const modal = document.getElementById('changePasswordModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}
</script>


