@extends('admin.app')

@section('title', 'Meta Data - Admin Panel')

@section('content')
<!-- Breadcrumbs -->
<x-breadcrumbs :route_name="'admin.meta-data.index'" />

<div class="p-8">
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-800 dark:text-white">Pengaturan Metadata Website</h1>
        <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">Kelola metadata yang akan ditampilkan di website untuk meningkatkan SEO dan tampilan di mesin pencari.</p>
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
                <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Data Metadata</h2>
                <p class="text-sm text-gray-600 dark:text-gray-400">Masukkan informasi metadata sesuai dengan panduan SEO.</p>
            </div>

            <form action="{{ route('admin.meta-data.update') }}" method="POST" class="p-6 space-y-6">
                @csrf

                <div class="space-y-6">
                    <!-- Title Tag -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-start">
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title Tag (Judul Halaman)</label>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Judul yang akan ditampilkan di tab browser dan hasil pencarian Google.</p>
                        </div>
                        <div class="md:col-span-2">
                            <input type="text" id="title" name="title" value="{{ old('title', $metaData['title']->value ?? '') }}" 
                                class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                maxlength="70">
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Ideal: 50-60 karakter. Maksimal: 70 karakter.</p>
                            @error('title')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Meta Description -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-start">
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Meta Description (Deskripsi Meta)</label>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Ringkasan singkat tentang konten website yang akan ditampilkan di hasil pencarian.</p>
                        </div>
                        <div class="md:col-span-2">
                            <textarea id="description" name="description" rows="3" 
                                class="form-textarea mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                maxlength="160">{{ old('description', $metaData['description']->value ?? '') }}</textarea>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Ideal: 120-158 karakter. Maksimal: 160 karakter.</p>
                            @error('description')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Meta Keywords -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-start">
                        <div>
                            <label for="keywords" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Meta Keywords</label>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Kata kunci yang relevan dengan isi website, dipisahkan dengan koma.</p>
                        </div>
                        <div class="md:col-span-2">
                            <input type="text" id="keywords" name="keywords" value="{{ old('keywords', $metaData['keywords']->value ?? '') }}" 
                                class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Contoh: kesehatan, konsultasi medis, dokter online</p>
                            @error('keywords')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Meta Charset -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-start">
                        <div>
                            <label for="charset" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Meta Charset</label>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Pengkodean karakter yang digunakan oleh website.</p>
                        </div>
                        <div class="md:col-span-2">
                            <select id="charset" name="charset" 
                                class="form-select mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <option value="UTF-8" {{ (old('charset', $metaData['charset']->value ?? '') == 'UTF-8') ? 'selected' : '' }}>UTF-8 (Rekomendasi)</option>
                                <option value="ISO-8859-1" {{ (old('charset', $metaData['charset']->value ?? '') == 'ISO-8859-1') ? 'selected' : '' }}>ISO-8859-1</option>
                            </select>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">UTF-8 direkomendasikan untuk mendukung semua bahasa dan karakter.</p>
                            @error('charset')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Author -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-start">
                        <div>
                            <label for="author" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Meta Author</label>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Nama penulis atau organisasi pemilik website.</p>
                        </div>
                        <div class="md:col-span-2">
                            <input type="text" id="author" name="author" value="{{ old('author', $metaData['author']->value ?? '') }}" 
                                class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            @error('author')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Viewport -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-start">
                        <div>
                            <label for="viewport" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Meta Viewport</label>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Mengontrol tampilan responsive pada perangkat mobile.</p>
                        </div>
                        <div class="md:col-span-2">
                            <input type="text" id="viewport" name="viewport" value="{{ old('viewport', $metaData['viewport']->value ?? '') }}" 
                                class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Nilai default: width=device-width, initial-scale=1.0</p>
                            @error('viewport')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Robots -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-start">
                        <div>
                            <label for="robots" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Meta Robots</label>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Mengarahkan perilaku crawler mesin pencari.</p>
                        </div>
                        <div class="md:col-span-2">
                            <input type="text" id="robots" name="robots" value="{{ old('robots', $metaData['robots']->value ?? '') }}" 
                                class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Contoh: index, follow, noindex, nofollow</p>
                            @error('robots')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
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
                <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Panduan Pengaturan Metadata</h2>
                <p class="text-sm text-gray-600 dark:text-gray-400">Petunjuk untuk memaksimalkan efektivitas metadata untuk SEO.</p>
            </div>

            <div class="p-6 space-y-4 text-gray-700 dark:text-gray-300">
                <div class="border-l-4 border-blue-500 pl-4 py-2">
                    <h3 class="font-medium text-gray-800 dark:text-white">Title Tag</h3>
                    <p class="text-sm">Title tag adalah elemen HTML yang menentukan judul halaman. Title tag penting untuk SEO karena memberikan gambaran singkat tentang isi halaman kepada pengguna dan mesin pencari.</p>
                    <ul class="list-disc ml-5 text-sm mt-2">
                        <li>Maksimal 70 karakter (ideal 50-60 karakter)</li>
                        <li>Sertakan kata kunci utama di awal</li>
                        <li>Setiap halaman harus memiliki title yang unik</li>
                    </ul>
                </div>

                <div class="border-l-4 border-green-500 pl-4 py-2">
                    <h3 class="font-medium text-gray-800 dark:text-white">Meta Description</h3>
                    <p class="text-sm">Meta description adalah ringkasan singkat tentang konten halaman. Meskipun tidak berpengaruh langsung pada peringkat, meta description dapat meningkatkan CTR (Click-Through Rate) di hasil pencarian.</p>
                    <ul class="list-disc ml-5 text-sm mt-2">
                        <li>Maksimal 160 karakter (ideal 120-158 karakter)</li>
                        <li>Sertakan kata kunci target secara alami</li>
                        <li>Berikan deskripsi yang menarik dan informatif untuk mendorong klik</li>
                    </ul>
                </div>

                <div class="border-l-4 border-yellow-500 pl-4 py-2">
                    <h3 class="font-medium text-gray-800 dark:text-white">Meta Keywords</h3>
                    <p class="text-sm">Meta keywords adalah kata kunci yang relevan dengan isi website. Meskipun pengaruhnya pada SEO tidak sebesar dulu, masih bermanfaat untuk kategori dan pengindeksan internal.</p>
                    <ul class="list-disc ml-5 text-sm mt-2">
                        <li>Gunakan 5-10 kata kunci yang paling relevan</li>
                        <li>Pisahkan kata kunci dengan koma</li>
                        <li>Jangan berlebihan menggunakan kata kunci (keyword stuffing)</li>
                    </ul>
                </div>

                <div class="border-l-4 border-purple-500 pl-4 py-2">
                    <h3 class="font-medium text-gray-800 dark:text-white">Meta Charset</h3>
                    <p class="text-sm">Meta charset menentukan pengkodean karakter yang digunakan oleh website. UTF-8 adalah pilihan yang direkomendasikan untuk mendukung karakter dari berbagai bahasa.</p>
                </div>

                <div class="border-l-4 border-red-500 pl-4 py-2">
                    <h3 class="font-medium text-gray-800 dark:text-white">Tips Konsistensi</h3>
                    <p class="text-sm">Pastikan metadata relevan dengan isi halaman untuk menghindari bounce rate tinggi dan meningkatkan kepercayaan pengguna.</p>
                    <ul class="list-disc ml-5 text-sm mt-2">
                        <li>Title dan meta description harus mencerminkan konten halaman</li>
                        <li>Gunakan kata kunci yang benar-benar relevan dengan konten</li>
                        <li>Perbarui metadata saat konten halaman berubah secara signifikan</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Karakter counter untuk Title
    const titleInput = document.getElementById('title');
    const titleCounter = document.createElement('span');
    titleCounter.className = 'text-xs text-gray-500 dark:text-gray-400 ml-2';
    titleInput.parentNode.querySelector('p').appendChild(titleCounter);

    titleInput.addEventListener('input', function() {
        titleCounter.textContent = `(${this.value.length}/70 karakter)`;
        if (this.value.length > 60) {
            titleCounter.classList.add('text-yellow-500');
            titleCounter.classList.remove('text-gray-500', 'text-red-500');
        } else if (this.value.length > 70) {
            titleCounter.classList.add('text-red-500');
            titleCounter.classList.remove('text-gray-500', 'text-yellow-500');
        } else {
            titleCounter.classList.add('text-gray-500');
            titleCounter.classList.remove('text-yellow-500', 'text-red-500');
        }
    });
    titleInput.dispatchEvent(new Event('input'));

    // Karakter counter untuk Description
    const descriptionInput = document.getElementById('description');
    const descriptionCounter = document.createElement('span');
    descriptionCounter.className = 'text-xs text-gray-500 dark:text-gray-400 ml-2';
    descriptionInput.parentNode.querySelector('p').appendChild(descriptionCounter);

    descriptionInput.addEventListener('input', function() {
        descriptionCounter.textContent = `(${this.value.length}/160 karakter)`;
        if (this.value.length > 120 && this.value.length <= 158) {
            descriptionCounter.classList.add('text-green-500');
            descriptionCounter.classList.remove('text-gray-500', 'text-yellow-500', 'text-red-500');
        } else if (this.value.length > 158) {
            descriptionCounter.classList.add('text-yellow-500');
            descriptionCounter.classList.remove('text-gray-500', 'text-green-500', 'text-red-500');
        } else if (this.value.length > 160) {
            descriptionCounter.classList.add('text-red-500');
            descriptionCounter.classList.remove('text-gray-500', 'text-green-500', 'text-yellow-500');
        } else {
            descriptionCounter.classList.add('text-gray-500');
            descriptionCounter.classList.remove('text-green-500', 'text-yellow-500', 'text-red-500');
        }
    });
    descriptionInput.dispatchEvent(new Event('input'));
</script>
@endsection 