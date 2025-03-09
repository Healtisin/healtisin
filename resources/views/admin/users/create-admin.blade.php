@extends('admin.app')

@section('content')
@include('components.breadcrumbs')

<div class="container mx-auto px-4 sm:px-8">
    <div class="py-8">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-2xl font-semibold leading-tight text-gray-900 dark:text-gray-100">Tambah Admin Baru</h2>
            <a href="{{ route('admin.admins') }}" class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 px-4 py-2 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition duration-300 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Daftar
            </a>
        </div>
        
        @if(session('success'))
            <div class="mb-8 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative dark:bg-green-800/20 dark:border-green-700 dark:text-green-400" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                </span>
            </div>
        @endif
        
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-8">
            <form action="{{ route('admin.admins.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="role" value="admin">
                
                <!-- Profile Photo Upload -->
                <div class="mb-8">
                    <label class="block text-base font-medium text-gray-700 dark:text-gray-300 mb-4">Foto Profil</label>
                    <div class="flex items-center space-x-6">
                        <div class="w-24 h-24 rounded-full overflow-hidden bg-gray-200 dark:bg-gray-700" id="profile-photo-container">
                            <div class="w-full h-full flex items-center justify-center" id="no-photo">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-10 h-10 text-gray-500 dark:text-gray-400">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 12a4 4 0 100-8 4 4 0 000 8z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 21a8 8 0 10-16 0" />
                                </svg>
                            </div>
                            <img src="#" alt="Pratinjau Foto" class="w-full h-full object-cover hidden" id="photo-preview">
                        </div>
                        <div class="flex flex-col space-y-2">
                            <label for="profile_photo" class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-300 dark:hover:bg-gray-600 px-4 py-2 rounded-lg cursor-pointer transition duration-300">
                                Pilih Foto
                                <input type="file" name="profile_photo" id="profile_photo" class="hidden" accept="image/*">
                            </label>
                            <p class="text-sm text-gray-500 dark:text-gray-400">JPG, PNG atau GIF (Maks. 2MB)</p>
                            
                            <div id="preview-actions" class="hidden mt-2 flex space-x-2">
                                <button type="button" id="cancel-preview" class="bg-gray-300 dark:bg-gray-600 text-gray-700 dark:text-gray-300 px-4 py-2 rounded-lg hover:bg-gray-400 dark:hover:bg-gray-500 transition duration-300 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    Batal
                                </button>
                            </div>
                        </div>
                    </div>
                    @error('profile_photo')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Field: Name -->
                    <div class="space-y-4">
                        <label for="name" class="block text-base font-medium text-gray-700 dark:text-gray-300">Nama Lengkap</label>
                        <input type="text" name="name" id="name"
                            class="mt-2 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-base h-12 px-4"
                            placeholder="Masukkan nama lengkap" value="{{ old('name') }}">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Field: Username -->
                    <div class="space-y-4">
                        <label for="username" class="block text-base font-medium text-gray-700 dark:text-gray-300">Nama Pengguna</label>
                        <input type="text" name="username" id="username"
                            class="mt-2 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-base h-12 px-4"
                            placeholder="Masukkan nama pengguna" value="{{ old('username') }}">
                        @error('username')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Field: Email -->
                    <div class="space-y-4">
                        <label for="email" class="block text-base font-medium text-gray-700 dark:text-gray-300">Email</label>
                        <input type="email" name="email" id="email"
                            class="mt-2 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-base h-12 px-4"
                            placeholder="Masukkan alamat email" value="{{ old('email') }}">
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Field: Phone -->
                    <div class="space-y-4">
                        <label for="phone" class="block text-base font-medium text-gray-700 dark:text-gray-300">Nomor Telepon</label>
                        <input type="text" name="phone" id="phone"
                            class="mt-2 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-base h-12 px-4"
                            placeholder="Masukkan nomor telepon" value="{{ old('phone') }}">
                        @error('phone')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Field: Password -->
                    <div class="space-y-4">
                        <label for="password" class="block text-base font-medium text-gray-700 dark:text-gray-300">Kata Sandi</label>
                        <input type="password" name="password" id="password"
                            class="mt-2 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-base h-12 px-4"
                            placeholder="Masukkan kata sandi">
                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Field: Subscription Status -->
                    <div class="space-y-4">
                        <label for="subscription_status" class="block text-base font-medium text-gray-700 dark:text-gray-300">Status Langganan</label>
                        <select name="subscription_status" id="subscription_status"
                            class="mt-2 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-base h-12 px-4">
                            <option value="free" {{ old('subscription_status') == 'free' ? 'selected' : '' }}>Gratis</option>
                            <option value="premium" {{ old('subscription_status') == 'premium' ? 'selected' : '' }}>Premium</option>
                        </select>
                        @error('subscription_status')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Field: Status -->
                    <div class="space-y-4">
                        <label for="is_active" class="block text-base font-medium text-gray-700 dark:text-gray-300">Status</label>
                        <select name="is_active" id="is_active"
                            class="mt-2 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-base h-12 px-4">
                            <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                        @error('is_active')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="mt-10 flex space-x-4">
                    <button type="submit"
                        class="bg-[#24b0ba] dark:bg-[#24b0ba]/80 text-white px-8 py-3 rounded-lg hover:bg-[#73c7e3] dark:hover:bg-[#73c7e3]/80 transition duration-300 text-base font-medium">
                        Simpan Admin
                    </button>
                    <a href="{{ route('admin.admins') }}"
                        class="bg-gray-300 dark:bg-gray-600 text-gray-700 dark:text-gray-200 px-8 py-3 rounded-lg hover:bg-gray-400 dark:hover:bg-gray-500 transition duration-300 text-base font-medium">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JavaScript for image preview -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const photoInput = document.getElementById('profile_photo');
        const photoPreview = document.getElementById('photo-preview');
        const noPhoto = document.getElementById('no-photo');
        const previewActions = document.getElementById('preview-actions');
        const cancelPreview = document.getElementById('cancel-preview');
        
        // Tampilkan preview ketika file dipilih
        photoInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    // Tampilkan preview
                    photoPreview.src = e.target.result;
                    photoPreview.classList.remove('hidden');
                    
                    // Sembunyikan elemen lain
                    noPhoto.classList.add('hidden');
                    
                    // Tampilkan tombol batal
                    previewActions.classList.remove('hidden');
                };
                
                reader.readAsDataURL(this.files[0]);
            }
        });
        
        // Batalkan preview
        cancelPreview.addEventListener('click', function() {
            // Reset file input
            photoInput.value = '';
            
            // Sembunyikan preview
            photoPreview.classList.add('hidden');
            
            // Tampilkan kembali ikon no photo
            noPhoto.classList.remove('hidden');
            
            // Sembunyikan tombol batal
            previewActions.classList.add('hidden');
        });
    });
</script>
@endsection 