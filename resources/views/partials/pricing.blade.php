<div>
    <div class="text-center mb-16">
        <h2 class="text-4xl font-serif mb-4">Pilihan Paket</h2>
        <p class="text-xl text-gray-600 mb-16">Pilih paket yang sesuai dengan kebutuhan Anda</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-32">
        <!-- Free Plan -->
        <div class="border rounded-xl p-8 hover:shadow-lg transition-shadow flex flex-col h-full">
            <div class="h-40">
                <h3 class="text-2xl font-semibold mb-2">Free</h3>
                <p class="text-gray-600 mb-4">Untuk memulai perjalanan kesehatan Anda</p>
                <div class="text-4xl font-bold">Rp 0</div>
            </div>

            <ul class="space-y-4 flex-grow mb-8">
                <li class="flex items-center">
                    <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Konsultasi kesehatan dasar
                </li>
                <li class="flex items-center">
                    <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Skrining kesehatan terbatas
                </li>
                <li class="flex items-center">
                    <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Akses ke model AI dasar
                </li>
            </ul>

            <div class="mt-auto">
                <button class="w-full px-6 py-3 bg-[#24b0ba] text-white rounded-full hover:bg-[#73c7e3]">
                    Mulai Gratis
                </button>
            </div>
        </div>

        <!-- Pro Plan -->
        <div class="relative border rounded-xl p-8 hover:shadow-lg transition-shadow bg-gray-50 flex flex-col h-full">
            <!-- Label Rekomendasi -->
            <div class="absolute -top-3 left-8">
                <span class="px-4 py-1 bg-[#24b0ba] text-white text-sm rounded-full">
                    Rekomendasi
                </span>
            </div>

            <div class="h-40">
                <h3 class="text-2xl font-semibold mb-2">Pro</h3>
                <p class="text-gray-600 mb-4">Untuk layanan kesehatan yang lebih lengkap</p>
                <div class="text-4xl font-bold">Rp 99.000<span class="text-base font-normal">/bulan</span></div>
            </div>

            <ul class="space-y-4 flex-grow mb-8">
                <li class="flex items-center">
                    <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Semua fitur Free
                </li>
                <li class="flex items-center">
                    <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Konsultasi kesehatan tak terbatas
                </li>
                <li class="flex items-center">
                    <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Akses ke model AI terbaru
                </li>
                <li class="flex items-center">
                    <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Dukungan prioritas 24/7
                </li>
            </ul>

            <div class="mt-auto">
                <a href="{{ route('pricing.pro') }}" class="w-full px-6 py-3 bg-[#24b0ba] text-white rounded-full hover:bg-[#73c7e3] inline-block text-center">
                    Mulai Pro
                </a>
            </div>
        </div>
    </div>
</div>