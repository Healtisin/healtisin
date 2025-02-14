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
                            <input type="email" value="{{ Auth::user()->email }}" class="w-full px-3 py-2 border rounded-md bg-gray-50" readonly data-no-translate>
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
                            <input type="text" value="{{ Auth::user()->name }}" class="w-full px-3 py-2 border rounded-md bg-gray-50" readonly data-no-translate>
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
                    <div class="mb-4">
                        <label class="block text-sm text-gray-600 mb-1">Bahasa</label>
                        <div class="relative">
                            <input type="text" 
                                   value="{{ config('app.available_languages')[App::getLocale()]['native'] }}"
                                   class="w-full px-3 py-2 border rounded-md bg-gray-50" 
                                   readonly>
                            <button onclick="showLanguageModal()" 
                                    class="text-blue-500 text-sm mt-1 hover:underline">
                                Ubah
                            </button>
                        </div>
                    </div>

                    <!-- Account Upgrade -->
                    <div>
                        <h4 class="text-lg font-medium mb-4">Status Akun</h4>
                        @if(Auth::user()->subscription_status == 'free')
                            <div class="space-y-4">
                                <p class="text-sm text-gray-600">
                                    Tingkatkan ke Healtisin Pro untuk mendapatkan fitur premium lainnya.
                                </p>
                                <a href="{{ route('pricing.pro') }}" 
                                   class="inline-block px-4 py-2 bg-[#24b0ba] text-white rounded-md 
                                          hover:bg-[#73c7e3] transition-colors duration-200">
                                    Tingkatkan paket langganan
                                </a>
                            </div>
                        @elseif(Auth::user()->subscription_status == 'pro')
                            <div class="space-y-4">
                                <div class="flex items-center gap-2">
                                    <span class="text-sm font-medium text-[#24b0ba]">Pro Member</span>
                                    <svg class="w-5 h-5 text-[#24b0ba]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <p class="text-sm text-gray-600">
                                    Selamat! Anda telah menjadi bagian dari Healtisin Pro. Nikmati akses penuh ke semua fitur premium kami:
                                </p>
                                <ul class="text-sm text-gray-600 space-y-2">
                                    <li class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-[#24b0ba]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Konsultasi tanpa batas dengan dokter spesialis
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-[#24b0ba]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Akses prioritas 24/7
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-[#24b0ba]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Riwayat medis lengkap dan terorganisir
                                    </li>
                                </ul>
                            </div>
                        @endif
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

<!-- Language Modal -->
<div id="languageModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-[60]">
    <div class="bg-white rounded-lg w-[400px]">
        <div class="flex items-center justify-between p-4 border-b">
            <h3 class="text-xl font-semibold">Ubah Bahasa</h3>
            <button onclick="closeLanguageModal()" class="p-1 hover:bg-gray-100 rounded-full">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        
        <div class="p-6">
            @foreach(config('app.available_languages') as $code => $lang)
                <button onclick="changeLanguage('{{ $code }}')"
                        class="w-full text-left px-4 py-3 rounded-lg hover:bg-gray-50 flex items-center justify-between mb-2">
                    <div>
                        <span class="text-sm">{{ $lang['native'] }}</span>
                        <span class="text-xs text-gray-500">({{ $lang['name'] }})</span>
                    </div>
                    @if(App::getLocale() == $code)
                        <svg class="w-5 h-5 text-[#24b0ba]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    @endif
                </button>
            @endforeach
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

function showLanguageModal() {
    document.getElementById('languageModal').classList.remove('hidden');
    document.getElementById('languageModal').classList.add('flex');
}

function closeLanguageModal() {
    document.getElementById('languageModal').classList.add('hidden');
    document.getElementById('languageModal').classList.remove('flex');
}

async function changeLanguage(lang) {
    try {
        const response = await fetch('/language/change', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ language: lang })
        });

        if (!response.ok) {
            throw new Error('Gagal mengubah bahasa');
        }

        window.location.reload();
    } catch (error) {
        console.error('Language change error:', error);
        alert('Gagal mengubah bahasa: ' + error.message);
    }
}
</script>



