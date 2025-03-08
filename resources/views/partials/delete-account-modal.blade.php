<!-- Delete Account Modal -->
<div id="deleteAccountModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-[60]">
    <div class="bg-white dark:bg-gray-800 rounded-lg w-[500px] p-6">
        <div class="flex items-center justify-between mb-4">
            <h4 class="text-lg font-medium text-red-600 dark:text-red-400">Hapus Akun</h4>
            <button onclick="closeDeleteAccountModal()" class="p-1 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full">
                <svg class="w-6 h-6 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Alert Messages -->
        <div id="deleteAccountAlert" class="hidden mb-4"></div>
        
        <div class="mb-6">
            <!-- Warning Messages -->
            <div class="bg-red-50 dark:bg-red-900/20 border-l-4 border-red-500 p-4 mb-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-600 dark:text-red-400">Peringatan: Tindakan ini tidak dapat dibatalkan</h3>
                        <div class="mt-2 text-sm text-red-500 dark:text-red-300">
                            <ul class="list-disc pl-5 space-y-1">
                                <li>Semua data akun Anda akan dihapus secara permanen</li>
                                <li>Semua riwayat aktivitas akan dihapus</li>
                                <li>Anda tidak dapat memulihkan akun setelah dihapus</li>
                                <li>Anda perlu mendaftar ulang jika ingin menggunakan layanan ini lagi</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            <form id="deleteAccountForm" method="POST" action="{{ route('profile.delete') }}" onsubmit="handleDeleteAccount(event)">
                @csrf
                @method('DELETE')
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Masukkan kata sandi Anda untuk konfirmasi</label>
                    <input type="password" 
                           name="password" 
                           class="w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200" 
                           required>
                    <span id="password_error" class="text-red-600 dark:text-red-400 text-sm hidden"></span>
                </div>
            </form>
        </div>

        <div class="flex justify-end gap-2">
            <button onclick="closeDeleteAccountModal()" 
                    class="px-4 py-2 text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md">
                Batal
            </button>
            <button onclick="document.getElementById('deleteAccountForm').submit()" 
                    class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 dark:bg-red-600 dark:hover:bg-red-700">
                Ya, Saya Mengerti dan Ingin Menghapus Akun
            </button>
        </div>
    </div>
</div>

<script>
async function handleDeleteAccount(e) {
    e.preventDefault();
    const form = document.getElementById('deleteAccountForm');
    const formData = new FormData(form);
    const alertDiv = document.getElementById('deleteAccountAlert');

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
        
        window.location.href = '/login';
    } catch (error) {
        alertDiv.innerHTML = `<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">${error.message}</div>`;
        alertDiv.classList.remove('hidden');
    }
}

function showDeleteAccountModal() {
    closeSettingsModal();
    const modal = document.getElementById('deleteAccountModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeDeleteAccountModal() {
    const modal = document.getElementById('deleteAccountModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    openSettingsModal();
}
</script>