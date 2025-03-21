@php
    // Ambil konfigurasi harga dari database
    $pricingConfig = App\Models\PricingConfig::where('is_active', true)->first();
    if (!$pricingConfig) {
        $pricingConfig = App\Models\PricingConfig::first();
    }
    
    // Jika tidak ada konfigurasi, gunakan default
    $monthlyPrice = $pricingConfig ? $pricingConfig->monthly_price : 99000;
@endphp

<div class="px-4 sm:px-6 lg:px-8 py-8 sm:py-12 lg:py-16">
    <div class="text-center mb-6 sm:mb-8 md:mb-16">
        <h2 class="text-2xl sm:text-3xl md:text-4xl font-serif mb-3 sm:mb-4 dark:text-gray-100">Paket</h2>
        <p class="text-base sm:text-lg md:text-xl text-gray-600 dark:text-gray-400 mb-6 sm:mb-8 md:mb-16">
            Pilih paket yang sesuai dengan kebutuhan Anda
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6 md:gap-8 mb-8 sm:mb-16 md:mb-32">
        <!-- Free Plan -->
        <div class="border dark:border-gray-700 rounded-xl p-4 sm:p-6 md:p-8 hover:shadow-lg transition-shadow flex flex-col h-full dark:bg-gray-800">
            <div class="h-32 sm:h-40">
                <h3 class="text-lg sm:text-xl md:text-2xl font-semibold mb-2 dark:text-gray-100">Free</h3>
                <p class="text-sm sm:text-base md:text-lg text-gray-600 dark:text-gray-400 mb-3 sm:mb-4">
                    Untuk memulai perjalanan kesehatan Anda
                </p>
                <div class="text-2xl sm:text-3xl md:text-4xl font-bold dark:text-gray-100">Rp 0</div>
            </div>

            <ul class="space-y-2 sm:space-y-3 md:space-y-4 flex-grow mb-4 sm:mb-6 md:mb-8">
                <li class="flex items-center text-sm sm:text-base dark:text-gray-300">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Konsultasi kesehatan dasar
                </li>
                <li class="flex items-center text-sm sm:text-base dark:text-gray-300">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Skrining kesehatan terbatas
                </li>
                <li class="flex items-center text-sm sm:text-base dark:text-gray-300">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Akses ke model AI dasar
                </li>
            </ul>

            <div class="mt-auto">
                <button class="w-full px-3 sm:px-4 py-2 sm:py-3 text-sm sm:text-base bg-[#24b0ba] text-white rounded-full hover:bg-[#73c7e3] dark:bg-[#24b0ba]/80 dark:hover:bg-[#73c7e3]/80">
                    Mulai Gratis
                </button>
            </div>
        </div>

        <!-- Pro Plan -->
        <div class="relative border dark:border-gray-700 rounded-xl p-4 sm:p-6 md:p-8 hover:shadow-lg transition-shadow bg-gray-50 dark:bg-gray-800 flex flex-col h-full">
            <!-- Label Rekomendasi -->
            <div class="absolute -top-3 left-4 sm:left-6 md:left-8">
                <span class="px-2 sm:px-3 py-1 bg-[#24b0ba] text-white text-xs sm:text-sm rounded-full dark:bg-[#24b0ba]/80">
                    Rekomendasi
                </span>
            </div>

            <div class="h-32 sm:h-40">
                <h3 class="text-lg sm:text-xl md:text-2xl font-semibold mb-2 dark:text-gray-100">Pro</h3>
                <p class="text-sm sm:text-base md:text-lg text-gray-600 dark:text-gray-400 mb-3 sm:mb-4">
                    Untuk layanan kesehatan yang lebih lengkap
                </p>
                <div class="text-2xl sm:text-3xl md:text-4xl font-bold dark:text-gray-100">
                    Rp {{ number_format($monthlyPrice, 0, ',', '.') }}<span class="text-xs sm:text-sm md:text-base font-normal dark:text-gray-400">/bulan</span>
                </div>
            </div>

            <ul class="space-y-2 sm:space-y-3 md:space-y-4 flex-grow mb-4 sm:mb-6 md:mb-8">
                <li class="flex items-center text-sm sm:text-base dark:text-gray-300">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Semua fitur Free
                </li>
                <li class="flex items-center text-sm sm:text-base dark:text-gray-300">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Konsultasi kesehatan tak terbatas
                </li>
                <li class="flex items-center text-sm sm:text-base dark:text-gray-300">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Akses ke model AI terbaru
                </li>
                <li class="flex items-center text-sm sm:text-base dark:text-gray-300">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Dukungan prioritas 24/7
                </li>
            </ul>

            <div class="mt-auto">
                <a href="{{ route('pricing.pro') }}" class="w-full px-3 sm:px-4 py-2 sm:py-3 text-sm sm:text-base bg-[#24b0ba] text-white rounded-full hover:bg-[#73c7e3] dark:bg-[#24b0ba]/80 dark:hover:bg-[#73c7e3]/80 inline-block text-center">
                    Mulai Pro
                </a>
            </div>
        </div>
    </div>
</div>