@extends('admin.app')

@section('title', 'Footer Website - Admin Panel')

@section('content')
<!-- Breadcrumbs -->
<x-breadcrumbs :route_name="'admin.footer.index'" />

<div class="p-8">
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-800 dark:text-white">Pengaturan Footer Website</h1>
        <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">Kelola informasi yang ditampilkan di footer website Healtisin.</p>
    </div>

    @if(session('success'))
    <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded" role="alert">
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <p>{{ session('success') }}</p>
        </div>
    </div>
    @endif

    <div class="grid grid-cols-1 gap-6">
        <!-- Form Section -->
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Informasi Footer</h2>
                <p class="text-sm text-gray-600 dark:text-gray-400">Atur informasi yang akan ditampilkan di bagian footer website.</p>
            </div>

            <form action="{{ route('admin.footer.update') }}" method="POST" class="p-6 space-y-6">
                @csrf
                @method('PUT')

                <!-- Deskripsi -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Deskripsi Website</label>
                    <textarea id="description" name="description" rows="4" 
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white @error('description') border-red-500 @enderror"
                        placeholder="Masukkan deskripsi singkat tentang Healtisin">{{ old('description', $footer->description ?? '') }}</textarea>
                    @error('description')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Informasi Kontak -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nomor Telepon -->
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nomor Telepon</label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone', $footer->phone ?? '') }}"
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white @error('phone') border-red-500 @enderror"
                            placeholder="+62 878-7156-3112">
                        @error('phone')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $footer->email ?? '') }}"
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white @error('email') border-red-500 @enderror"
                            placeholder="healtisin@gmail.com">
                        @error('email')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Lokasi -->
                <div>
                    <label for="location" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Lokasi</label>
                    <input type="text" id="location" name="location" value="{{ old('location', $footer->location ?? '') }}"
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white @error('location') border-red-500 @enderror"
                        placeholder="Daerah Istimewa Yogyakarta">
                    @error('location')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Social Media Links -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- GitHub -->
                    <div>
                        <label for="github_link" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Link GitHub</label>
                        <input type="url" id="github_link" name="github_link" value="{{ old('github_link', $footer->github_link ?? '') }}"
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white @error('github_link') border-red-500 @enderror"
                            placeholder="https://github.com/Healtisin">
                        @error('github_link')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Twitter -->
                    <div>
                        <label for="twitter_link" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Link Twitter</label>
                        <input type="url" id="twitter_link" name="twitter_link" value="{{ old('twitter_link', $footer->twitter_link ?? '') }}"
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white @error('twitter_link') border-red-500 @enderror"
                            placeholder="https://twitter.com/Healtisin">
                        @error('twitter_link')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end pt-4 border-t border-gray-200 dark:border-gray-700 mt-6">
                    <button type="submit" class="flex items-center justify-center px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

        <!-- Guide Section -->
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Panduan Pengaturan Footer</h2>
                <p class="text-sm text-gray-600 dark:text-gray-400">Petunjuk untuk mengoptimalkan informasi di footer website.</p>
            </div>

            <div class="p-6 space-y-4 text-gray-700 dark:text-gray-300">
                <div class="border-l-4 border-blue-500 pl-4 py-2">
                    <h3 class="font-medium text-gray-800 dark:text-white">Deskripsi Website</h3>
                    <p class="text-sm">Tuliskan deskripsi singkat dan menarik tentang Healtisin yang akan muncul di footer website. Deskripsi ini membantu pengunjung memahami layanan yang ditawarkan.</p>
                </div>

                <div class="border-l-4 border-green-500 pl-4 py-2">
                    <h3 class="font-medium text-gray-800 dark:text-white">Informasi Kontak</h3>
                    <p class="text-sm">Pastikan informasi kontak (nomor telepon, email, dan lokasi) selalu up-to-date. Informasi ini penting untuk memudahkan pengunjung menghubungi tim Healtisin.</p>
                </div>

                <div class="border-l-4 border-yellow-500 pl-4 py-2">
                    <h3 class="font-medium text-gray-800 dark:text-white">Social Media</h3>
                    <p class="text-sm">Tambahkan link media sosial yang aktif untuk meningkatkan engagement dengan pengguna. Pastikan link yang dimasukkan valid dan mengarah ke profil yang benar.</p>
                </div>

                <div class="border-l-4 border-purple-500 pl-4 py-2">
                    <h3 class="font-medium text-gray-800 dark:text-white">Praktik Terbaik</h3>
                    <ul class="list-disc ml-5 text-sm mt-2">
                        <li>Gunakan bahasa yang jelas dan profesional</li>
                        <li>Pastikan semua link berfungsi dengan baik</li>
                        <li>Update informasi secara berkala</li>
                        <li>Periksa tampilan footer di berbagai perangkat</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 