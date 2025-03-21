<!-- Change Phone Modal -->
<div id="changePhoneModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4">
    <div class="bg-white dark:bg-gray-800 rounded-lg w-full max-w-[500px]">
        <!-- Modal Header -->
        <div class="flex items-center justify-between p-3 sm:p-4 border-b dark:border-gray-700">
            <div class="flex items-center gap-2 sm:gap-3">
                <button onclick="closeChangePhoneModal()" class="p-1.5 sm:p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <h3 class="text-lg sm:text-xl font-semibold dark:text-gray-100">Ubah Nomor Telepon</h3>
            </div>
        </div>

        <!-- Alert Messages -->
        <div id="phoneChangeAlert" class="hidden mx-4 sm:mx-6 mt-3 sm:mt-4"></div>

        <!-- Modal Content -->
        <div class="p-4 sm:p-6">
            <form id="changePhoneForm" method="POST" action="{{ route('profile.phone.update') }}" onsubmit="handlePhoneChange(event)">
                @csrf
                <!-- Nomor Telepon Saat Ini -->
                <div class="mb-4">
                    <label class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nomor Telepon Saat Ini</label>
                    <input type="text" 
                           class="w-full px-3 py-2 text-sm sm:text-base border rounded-md bg-gray-100 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200" 
                           value="{{ Auth::user()->phone ?? '-' }}"
                           readonly>
                </div>

                <!-- Nomor Telepon Baru -->
                <div class="mb-6">
                    <label class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nomor Telepon Baru</label>
                    <input type="tel" 
                           id="new_phone" 
                           name="phone" 
                           class="w-full px-3 py-2 text-sm sm:text-base border rounded-md bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200" 
                           placeholder="Contoh: 08123456789"
                           required>
                    <span id="phone_error" class="text-red-600 text-xs sm:text-sm hidden"></span>
                </div>

                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeChangePhoneModal()" 
                            class="px-3 sm:px-4 py-2 text-sm sm:text-base text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md">
                        Kembali
                    </button>
                    <button type="button" onclick="confirmPhoneChange()" 
                            class="px-3 sm:px-4 py-2 text-sm sm:text-base bg-[#24b0ba] text-white rounded-md hover:bg-[#73c7e3]">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Phone Confirmation Modal -->
<div id="phoneConfirmationModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-[60] p-4">
    <div class="bg-white dark:bg-gray-800 rounded-lg w-full max-w-[400px] p-4 sm:p-6">
        <div class="flex items-center justify-between mb-3 sm:mb-4">
            <h4 class="text-base sm:text-lg font-medium dark:text-gray-100">Konfirmasi Perubahan Nomor</h4>
            <button onclick="closePhoneConfirmationModal()" class="p-1 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full">
                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        
        <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-400 mb-4 sm:mb-6" id="phoneConfirmationMessage"></p>

        <div class="flex justify-end gap-2">
            <button onclick="closePhoneConfirmationModal()" 
                    class="px-3 sm:px-4 py-2 text-sm sm:text-base text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md">
                Batal
            </button>
            <button onclick="submitPhoneChange()" 
                    class="px-3 sm:px-4 py-2 text-sm sm:text-base bg-[#24b0ba] text-white rounded-md hover:bg-[#73c7e3]">
                Ya, Ubah Nomor
            </button>
        </div>
    </div>
</div>

<script>
function confirmPhoneChange() {
    const newPhone = document.getElementById('new_phone').value;
    const confirmationMessage = document.getElementById('phoneConfirmationMessage');
    confirmationMessage.textContent = `Apakah Anda yakin ingin mengubah nomor telepon menjadi "${newPhone}"?`;
    
    document.getElementById('phoneConfirmationModal').classList.remove('hidden');
    document.getElementById('phoneConfirmationModal').classList.add('flex');
}

function closePhoneConfirmationModal() {
    document.getElementById('phoneConfirmationModal').classList.add('hidden');
    document.getElementById('phoneConfirmationModal').classList.remove('flex');
}

function submitPhoneChange() {
    closePhoneConfirmationModal();
    document.getElementById('changePhoneForm').dispatchEvent(new Event('submit'));
}

async function handlePhoneChange(e) {
    e.preventDefault();
    const form = document.getElementById('changePhoneForm');
    const formData = new FormData(form);
    const alertDiv = document.getElementById('phoneChangeAlert');

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
        
        setTimeout(() => {
            window.location.reload();
        }, 2000);
    } catch (error) {
        alertDiv.innerHTML = `<div class="bg-red-100 border border-red-400 text-red-700 px-3 sm:px-4 py-2 sm:py-3 rounded text-sm sm:text-base">${error.message}</div>`;
        alertDiv.classList.remove('hidden');
    }
}

function closeChangePhoneModal() {
    const modal = document.getElementById('changePhoneModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    openSettingsModal();
}

function showChangePhoneModal() {
    closeSettingsModal();
    const modal = document.getElementById('changePhoneModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}
</script>