@extends('admin.app')

@section('title', 'Logo Website - Admin Panel')

@section('content')
<!-- Breadcrumbs -->
<x-breadcrumbs :route_name="'admin.logo.index'" />

<div class="p-8">
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-800 dark:text-white">Pengaturan Logo Website</h1>
        <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">Kelola logo yang akan ditampilkan di website Healtisin.</p>
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
                <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Logo Website</h2>
                <p class="text-sm text-gray-600 dark:text-gray-400">Unggah logo untuk tampilan website Healtisin.</p>
            </div>

            <form action="{{ route('admin.logo.update') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                @csrf

                <div class="space-y-6">
                    <!-- Default Logo -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-start">
                        <div>
                            <label for="default_logo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Logo Utama</label>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Logo yang digunakan pada latar belakang terang. Format: PNG, JPG. Disarankan ukuran 200×60px.</p>
                        </div>
                        <div class="md:col-span-2">
                            <div class="flex flex-col items-start space-y-3">
                                @if($defaultLogo)
                                <div class="p-4 bg-gray-100 dark:bg-gray-700 rounded-lg flex items-center justify-center">
                                    <img src="{{ $defaultLogo }}?{{ time() }}" alt="Logo Default" class="max-h-14 max-w-full">
                                </div>
                                @else
                                <div class="p-4 bg-gray-100 dark:bg-gray-700 rounded-lg flex items-center justify-center w-full h-20">
                                    <span class="text-sm text-gray-500 dark:text-gray-400">Logo belum diunggah</span>
                                </div>
                                @endif
                                <div class="mt-2 w-full">
                                    <label class="block">
                                        <span class="sr-only">Pilih logo baru</span>
                                        <input type="file" id="default_logo" name="default_logo" accept="image/png,image/jpeg,image/jpg" 
                                            class="block w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-blue-50 dark:file:bg-blue-900/20 file:text-blue-700 dark:file:text-blue-300 hover:file:bg-blue-100 dark:hover:file:bg-blue-900/30">
                                    </label>
                                    @error('default_logo')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- White Logo -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-start">
                        <div>
                            <label for="white_logo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Logo Putih</label>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Logo yang digunakan pada latar belakang gelap. Format: PNG, JPG. Disarankan ukuran 200×60px.</p>
                        </div>
                        <div class="md:col-span-2">
                            <div class="flex flex-col items-start space-y-3">
                                @if($whiteLogo)
                                <div class="p-4 bg-gray-800 rounded-lg flex items-center justify-center">
                                    <img src="{{ $whiteLogo }}?{{ time() }}" alt="Logo Putih" class="max-h-14 max-w-full">
                                </div>
                                @else
                                <div class="p-4 bg-gray-800 rounded-lg flex items-center justify-center w-full h-20">
                                    <span class="text-sm text-gray-400">Logo belum diunggah</span>
                                </div>
                                @endif
                                <div class="mt-2 w-full">
                                    <label class="block">
                                        <span class="sr-only">Pilih logo putih baru</span>
                                        <input type="file" id="white_logo" name="white_logo" accept="image/png,image/jpeg,image/jpg" 
                                            class="block w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-blue-50 dark:file:bg-blue-900/20 file:text-blue-700 dark:file:text-blue-300 hover:file:bg-blue-100 dark:hover:file:bg-blue-900/30">
                                    </label>
                                    @error('white_logo')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Favicon -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-start">
                        <div>
                            <label for="favicon" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Favicon</label>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Ikon kecil yang ditampilkan di tab browser. Format: ICO. Disarankan ukuran 16×16px atau 32×32px.</p>
                        </div>
                        <div class="md:col-span-2">
                            <div class="flex flex-col items-start space-y-3">
                                @if($favicon)
                                <div class="p-4 bg-gray-100 dark:bg-gray-700 rounded-lg flex items-center justify-center">
                                    <img src="{{ $favicon }}?{{ time() }}" alt="Favicon" class="h-8 w-8">
                                </div>
                                @else
                                <div class="p-4 bg-gray-100 dark:bg-gray-700 rounded-lg flex items-center justify-center w-full h-20">
                                    <span class="text-sm text-gray-500 dark:text-gray-400">Favicon belum diunggah</span>
                                </div>
                                @endif
                                <div class="mt-2 w-full">
                                    <label class="block">
                                        <span class="sr-only">Pilih favicon baru</span>
                                        <input type="file" id="favicon" name="favicon" accept=".ico" 
                                            class="block w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-blue-50 dark:file:bg-blue-900/20 file:text-blue-700 dark:file:text-blue-300 hover:file:bg-blue-100 dark:hover:file:bg-blue-900/30">
                                    </label>
                                    @error('favicon')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
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
                <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Panduan Pengaturan Logo</h2>
                <p class="text-sm text-gray-600 dark:text-gray-400">Petunjuk untuk memaksimalkan efektivitas logo website.</p>
            </div>

            <div class="p-6 space-y-4 text-gray-700 dark:text-gray-300">
                <div class="border-l-4 border-blue-500 pl-4 py-2">
                    <h3 class="font-medium text-gray-800 dark:text-white">Logo Utama</h3>
                    <p class="text-sm">Logo utama ditampilkan pada header website dengan latar belakang terang. Logo ini akan terlihat pada mode tampilan terang.</p>
                    <ul class="list-disc ml-5 text-sm mt-2">
                        <li>Format gambar: PNG atau JPG</li>
                        <li>Ukuran ideal: 200×60 piksel</li>
                        <li>Gunakan logo dengan latar belakang transparan</li>
                    </ul>
                </div>

                <div class="border-l-4 border-green-500 pl-4 py-2">
                    <h3 class="font-medium text-gray-800 dark:text-white">Logo Putih</h3>
                    <p class="text-sm">Logo putih ditampilkan pada header website dengan latar belakang gelap. Logo ini akan terlihat pada mode tampilan gelap.</p>
                    <ul class="list-disc ml-5 text-sm mt-2">
                        <li>Format gambar: PNG atau JPG</li>
                        <li>Ukuran ideal: 200×60 piksel</li>
                        <li>Gunakan logo warna putih dengan latar belakang transparan</li>
                    </ul>
                </div>

                <div class="border-l-4 border-yellow-500 pl-4 py-2">
                    <h3 class="font-medium text-gray-800 dark:text-white">Favicon</h3>
                    <p class="text-sm">Favicon adalah ikon kecil yang ditampilkan di tab browser. Favicon membantu pengunjung mengidentifikasi website Anda di antara tab-tab lainnya.</p>
                    <ul class="list-disc ml-5 text-sm mt-2">
                        <li>Format: ICO</li>
                        <li>Ukuran ideal: 16×16 atau 32×32 piksel</li>
                        <li>Gunakan desain sederhana yang masih terlihat jelas pada ukuran kecil</li>
                    </ul>
                </div>

                <div class="border-l-4 border-purple-500 pl-4 py-2">
                    <h3 class="font-medium text-gray-800 dark:text-white">Praktik Terbaik</h3>
                    <p class="text-sm">Beberapa tips untuk memastikan logo terlihat terbaik di website Anda:</p>
                    <ul class="list-disc ml-5 text-sm mt-2">
                        <li>Gunakan logo vektor jika memungkinkan untuk kualitas maksimal</li>
                        <li>Pastikan logo kontras dengan latar belakang</li>
                        <li>Periksa tampilan logo pada berbagai perangkat dan ukuran layar</li>
                        <li>Gunakan latar belakang transparan untuk fleksibilitas lebih baik</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 