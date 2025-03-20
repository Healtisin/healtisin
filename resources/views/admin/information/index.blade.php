@extends('admin.app')

@section('title', 'Informasi Website')

@section('content')
<div class="p-8">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
        
        <h1 class="text-2xl font-bold mb-6 text-gray-800 dark:text-gray-200">Pengaturan Informasi Website</h1>
        
        <p class="mb-6 text-gray-600 dark:text-gray-400">
            Kelola informasi utama website seperti nama website, produk, dan deskripsi. Informasi ini akan ditampilkan di berbagai bagian website.
        </p>

        @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6">
            <p>{{ session('success') }}</p>
        </div>
        @endif

        <form action="{{ route('admin.information.update') }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Website Name -->
                <div>
                    <label for="website_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Nama Website
                    </label>
                    <input type="text" name="website_name" id="website_name" 
                        class="w-full px-3 py-2 border rounded-md bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300"
                        value="{{ old('website_name', $information->website_name) }}" required>
                    @error('website_name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-gray-500 text-xs mt-1">Nama utama website (default: Healtisin)</p>
                </div>
                
                <!-- Product Name -->
                <div>
                    <label for="product_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Nama Produk
                    </label>
                    <input type="text" name="product_name" id="product_name" 
                        class="w-full px-3 py-2 border rounded-md bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300"
                        value="{{ old('product_name', $information->product_name) }}" required>
                    @error('product_name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-gray-500 text-xs mt-1">Nama produk yang ditampilkan (default: Healtisin AI)</p>
                </div>
            </div>
            
            <!-- Website Description -->
            <div class="mb-6">
                <label for="website_description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Deskripsi Website
                </label>
                <textarea name="website_description" id="website_description" rows="4"
                    class="w-full px-3 py-2 border rounded-md bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">{{ old('website_description', $information->website_description) }}</textarea>
                @error('website_description')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
                <p class="text-gray-500 text-xs mt-1">
                    Deskripsi singkat tentang website yang ditampilkan pada hero section di halaman utama.
                </p>
            </div>
            
            <!-- Product Description -->
            <div class="mb-8">
                <label for="product_description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Deskripsi Produk
                </label>
                <textarea name="product_description" id="product_description" rows="4"
                    class="w-full px-3 py-2 border rounded-md bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">{{ old('product_description', $information->product_description) }}</textarea>
                @error('product_description')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
                <p class="text-gray-500 text-xs mt-1">
                    Deskripsi detil tentang produk yang ditampilkan pada halaman About.
                </p>
            </div>

            <!-- Informasi Kontak -->
            <div class="mb-8">
                <h2 class="text-xl font-bold mb-4 text-gray-800 dark:text-gray-200 border-b pb-2">Informasi Kontak</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Phone -->
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Nomor Telepon
                        </label>
                        <input type="text" name="phone" id="phone" 
                            class="w-full px-3 py-2 border rounded-md bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300"
                            value="{{ old('phone', $information->phone) }}">
                        @error('phone')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-gray-500 text-xs mt-1">Format: +62 8xx-xxxx-xxxx</p>
                    </div>
                    
                    <!-- WhatsApp -->
                    <div>
                        <label for="whatsapp" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            WhatsApp
                        </label>
                        <input type="text" name="whatsapp" id="whatsapp" 
                            class="w-full px-3 py-2 border rounded-md bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300"
                            value="{{ old('whatsapp', $information->whatsapp) }}">
                        @error('whatsapp')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-gray-500 text-xs mt-1">Format: 08xxxxxxxxxx (tanpa spasi atau tanda baca)</p>
                    </div>
                </div>
                
                <!-- Email -->
                <div class="mb-6">
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Email
                    </label>
                    <input type="email" name="email" id="email" 
                        class="w-full px-3 py-2 border rounded-md bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300"
                        value="{{ old('email', $information->email) }}">
                    @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Address -->
                <div class="mb-6">
                    <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Alamat
                    </label>
                    <input type="text" name="address" id="address" 
                        class="w-full px-3 py-2 border rounded-md bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300"
                        value="{{ old('address', $information->address) }}">
                    @error('address')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Map Coordinates -->
                <div class="mb-6">
                    <label for="map_coordinates" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Kode Embed Peta Google Maps
                    </label>
                    <textarea name="map_coordinates" id="map_coordinates" rows="4"
                        class="w-full px-3 py-2 border rounded-md bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">{{ old('map_coordinates', $information->map_coordinates) }}</textarea>
                    @error('map_coordinates')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-gray-500 text-xs mt-1">
                        Tempel kode embed iframe dari Google Maps. Dapatkan dari fitur "Share" > "Embed a map" pada Google Maps.
                    </p>
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

    <div class="mt-8 bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold mb-4 text-gray-800 dark:text-gray-200">Panduan Penggunaan</h2>
        
        <div class="text-gray-600 dark:text-gray-400 space-y-3">
            <p>
                <strong>Nama Website:</strong> Nama ini akan ditampilkan pada tab browser dan beberapa tempat lain di website.
            </p>
            <p>
                <strong>Nama Produk:</strong> Nama produk utama yang ditawarkan, akan ditampilkan pada Hero Section dan About Page.
            </p>
            <p>
                <strong>Deskripsi Website:</strong> Deskripsi singkat tentang website yang ditampilkan pada Hero Section di halaman utama.
            </p>
            <p>
                <strong>Deskripsi Produk:</strong> Deskripsi lengkap tentang produk yang ditampilkan pada halaman About.
            </p>
            <p>
                <strong>Informasi Kontak:</strong> Informasi kontak seperti telepon, whatsapp, email, dan alamat yang akan ditampilkan pada halaman Kontak.
            </p>
            <p>
                <strong>Kode Embed Peta:</strong> Kode iframe peta dari Google Maps untuk menampilkan lokasi pada halaman Kontak.
            </p>
        </div>
    </div>
</div>
@endsection 