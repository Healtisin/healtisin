<div id="settingsModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg w-[900px]">
        <!-- Modal Header -->
        <div class="flex items-center justify-between p-4 border-b">
            <h3 class="text-xl font-semibold">Perincian akun</h3>
            <button onclick="closeSettingsModal()" class="p-1 hover:bg-gray-100 rounded-full">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Modal Content -->
        <div class="p-6">
            <div class="grid grid-cols-2 gap-12 relative">
                <!-- Left Column -->
                <div class="space-y-6 px-4">
                    <div>
                        <h4 class="text-lg font-medium mb-4">Perincian untuk masuk dan nama</h4>
                        
                        <!-- Email -->
                        <div class="mb-4">
                            <label class="block text-sm text-gray-600 mb-1">Email</label>
                            <input type="email" value="{{ Auth::user()->email }}" class="w-full px-3 py-2 border rounded-md bg-gray-50" readonly>
                        </div>

                        <!-- Password -->
                        <div class="mb-4">
                            <label class="block text-sm text-gray-600 mb-1">Kata sandi</label>
                            <div class="relative">
                                <input type="password" 
                                       value="••••••••" 
                                       class="w-full px-3 py-2 border rounded-md bg-gray-50" 
                                       readonly>
                            </div>
                            <button onclick="showChangePasswordModal()" class="text-blue-500 text-sm mt-1">Ubah</button>
                        </div>

                        <!-- Display Name -->
                        <div class="mb-4">
                            <label class="block text-sm text-gray-600 mb-1">Nama yang ditampilkan</label>
                            <input type="text" value="{{ Auth::user()->name }}" class="w-full px-3 py-2 border rounded-md bg-gray-50" readonly>
                            <button onclick="showChangeNameModal()"  class="text-blue-500 text-sm mt-1">Ubah</button>
                        </div>

                        <!-- Two Factor Auth -->
                        <div class="mt-6">
                            <h4 class="text-sm font-medium mb-2">Atur autentikasi dua faktor untuk akun pribadi Anda</h4>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Dinonaktifkan</span>
                                <button class="text-blue-500 text-sm">Aktifkan</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Vertical Divider -->
                <div class="absolute left-1/2 top-0 bottom-0 -ml-px">
                    <div class="w-[1px] h-full bg-gray-200"></div>
                </div>

                <!-- Right Column -->
                <div class="space-y-6 px-4">
                    <!-- Profile Photo -->
                    <div>
                        <h4 class="text-lg font-medium mb-4">Foto Profil</h4>
                        <div class="flex items-center gap-4">
                            <div class="w-20 h-20 rounded-full overflow-hidden bg-gray-100">
                                @if(Auth::user()->profile_photo)
                                    <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" 
                                         alt="Profile photo" 
                                         class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-[#24b0ba] flex items-center justify-center">
                                        <span class="text-2xl text-white font-medium">
                                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                        </span>
                                    </div>
                                @endif
                            </div>
                            <div>
                                <form action="{{ route('profile.photo.update') }}" 
                                      method="POST" 
                                      enctype="multipart/form-data"
                                      id="profilePhotoForm">
                                    @csrf
                                    <input type="file" 
                                           name="photo" 
                                           id="photoInput" 
                                           accept="image/jpeg,image/jpg,image/png" 
                                           class="hidden"
                                           onchange="validateAndPreviewPhoto(this)">
                                    <button type="button" 
                                            onclick="document.getElementById('photoInput').click()" 
                                            class="text-blue-500 hover:underline">
                                        Ubah foto
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Language Settings -->
                    <div>
                        <h4 class="text-lg font-medium mb-4">Bahasa</h4>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Indonesia</span>
                            <button class="text-blue-500 text-sm">Ubah</button>
                        </div>
                    </div>

                    <!-- Account Upgrade -->
                    <div>
                        <h4 class="text-lg font-medium mb-4">Tingkatkan akun Anda</h4>
                        <p class="text-sm text-gray-600 mb-4">
                            Tingkatkan ke Healtisin Pro untuk mendapatkan fitur premium lainnya.
                        </p>
                        <button class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                            Bandingkan paket langganan
                        </button>
                    </div>
                </div>
            </div>

            <!-- Delete Account -->
            <div class="mt-8 pt-6 border-t px-4">
                <button class="text-red-500 text-sm hover:underline">Hapus akun</button>
            </div>
        </div>
    </div>
</div>

<!-- Tambahkan setelah modal settings -->
<div id="photoConfirmationModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-[60]">
    <div class="bg-white rounded-lg w-[400px] p-6">
        <div class="flex items-center justify-between mb-4">
            <h4 class="text-lg font-medium">Konfirmasi Perubahan Foto</h4>
            <button onclick="closePhotoConfirmationModal()" class="p-1 hover:bg-gray-100 rounded-full">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        
        <div class="mb-4">
            <img id="previewImage" class="w-32 h-32 rounded-full mx-auto object-cover" src="" alt="Preview">
        </div>

        <p class="text-sm text-gray-600 mb-6">Apakah Anda yakin ingin mengubah foto profil?</p>

        <div class="flex justify-end gap-2">
            <button onclick="closePhotoConfirmationModal()" 
                    class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-md">
                Batal
            </button>
            <button onclick="submitPhotoChange()" 
                    class="px-4 py-2 bg-[#24b0ba] text-white rounded-md hover:bg-[#73c7e3]">
                Ya, Ubah Foto
            </button>
        </div>
    </div>
</div>

<script>
function validateAndPreviewPhoto(input) {
    const file = input.files[0];
    const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
    const maxSize = 2 * 1024 * 1024; // 2MB

    if (!allowedTypes.includes(file.type)) {
        alert('Hanya file JPG, JPEG, dan PNG yang diperbolehkan');
        input.value = '';
        return;
    }

    if (file.size > maxSize) {
        alert('Ukuran file maksimal 2MB');
        input.value = '';
        return;
    }

    const reader = new FileReader();
    reader.onload = function(e) {
        document.getElementById('previewImage').src = e.target.result;
        showPhotoConfirmationModal();
    }
    reader.readAsDataURL(file);
}

function showPhotoConfirmationModal() {
    document.getElementById('photoConfirmationModal').classList.remove('hidden');
    document.getElementById('photoConfirmationModal').classList.add('flex');
}

function closePhotoConfirmationModal() {
    document.getElementById('photoConfirmationModal').classList.add('hidden');
    document.getElementById('photoConfirmationModal').classList.remove('flex');
    document.getElementById('photoInput').value = '';
}

async function submitPhotoChange() {
    const form = document.getElementById('profilePhotoForm');
    const formData = new FormData(form);

    try {
        const response = await fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: formData
        });
        
        const data = await response.json();
        if (!response.ok) {
            throw new Error(data.message || 'Terjadi kesalahan');
        }
        
        // Tampilkan notifikasi sukses
        const alertDiv = document.createElement('div');
        alertDiv.className = 'fixed top-4 right-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded z-50';
        alertDiv.textContent = data.message;
        document.body.appendChild(alertDiv);
        
        setTimeout(() => {
            alertDiv.remove();
            window.location.reload();
        }, 2000);
        
        closePhotoConfirmationModal();
    } catch (error) {
        alert(error.message);
        closePhotoConfirmationModal();
    }
}
</script>

