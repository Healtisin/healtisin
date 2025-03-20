@php
use App\Helpers\InformationHelper;
@endphp
<div class="px-4 sm:px-6 lg:px-8 py-8 sm:py-12 lg:py-16">
    <div class="text-center mb-10 md:mb-16">
        <h2 class="text-2xl sm:text-3xl md:text-4xl font-serif mb-3 sm:mb-4 dark:text-gray-100">Kemampuan {{ InformationHelper::getProductName() }}</h2>
        <p class="text-lg sm:text-xl text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
            {{ InformationHelper::getProductName() }} hadir dengan berbagai fitur untuk membantu kesehatan Anda
        </p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 md:gap-8 lg:gap-12 mb-8 sm:mb-12 md:mb-16 lg:mb-32">
        <!-- Capability 1 -->
        <div class="text-center">
            <div class="bg-[#f0f2ff] dark:bg-[#24b0ba]/10 p-4 sm:p-6 md:p-8 rounded-lg mb-3 sm:mb-4 flex items-center justify-center">
                <svg class="w-10 h-10 sm:w-12 sm:h-12 md:w-16 md:h-16" viewBox="0 0 24 24" fill="none" stroke="#24b0ba">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
            </div>
            <h3 class="text-base sm:text-lg md:text-xl font-semibold mb-2 dark:text-gray-100">Skrining Kesehatan</h3>
            <p class="text-sm sm:text-base text-gray-600 dark:text-gray-400">
                Lakukan skrining kesehatan dengan cepat dan mudah melalui chat interaktif
            </p>
        </div>

        <!-- Capability 2 -->
        <div class="text-center">
            <div class="bg-[#f0f2ff] dark:bg-[#24b0ba]/10 p-4 sm:p-6 md:p-8 rounded-lg mb-3 sm:mb-4 flex items-center justify-center">
                <svg class="w-10 h-10 sm:w-12 sm:h-12 md:w-16 md:h-16" viewBox="0 0 24 24" fill="none" stroke="#24b0ba">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h3 class="text-base sm:text-lg md:text-xl font-semibold mb-2 dark:text-gray-100">Konsultasi 24/7</h3>
            <p class="text-sm sm:text-base text-gray-600 dark:text-gray-400">
                Dapatkan saran kesehatan kapanpun dan dimanapun Anda berada
            </p>
        </div>

        <!-- Capability 3 -->
        <div class="text-center">
            <div class="bg-[#f0f2ff] dark:bg-[#24b0ba]/10 p-4 sm:p-6 md:p-8 rounded-lg mb-3 sm:mb-4 flex items-center justify-center">
                <svg class="w-10 h-10 sm:w-12 sm:h-12 md:w-16 md:h-16" viewBox="0 0 24 24" fill="none" stroke="#24b0ba">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h3 class="text-base sm:text-lg md:text-xl font-semibold mb-2 dark:text-gray-100">Akurasi Tinggi</h3>
            <p class="text-sm sm:text-base text-gray-600 dark:text-gray-400">
                Didukung data medis terkini dan teknologi AI mutakhir
            </p>
        </div>

        <!-- Capability 4 -->
        <div class="text-center">
            <div class="bg-[#f0f2ff] dark:bg-[#24b0ba]/10 p-4 sm:p-6 md:p-8 rounded-lg mb-3 sm:mb-4 flex items-center justify-center">
                <svg class="w-10 h-10 sm:w-12 sm:h-12 md:w-16 md:h-16" viewBox="0 0 24 24" fill="none" stroke="#24b0ba">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </div>
            <h3 class="text-base sm:text-lg md:text-xl font-semibold mb-2 dark:text-gray-100">Privasi Terjamin</h3>
            <p class="text-sm sm:text-base text-gray-600 dark:text-gray-400">
                Data kesehatan Anda aman dan terenkripsi dengan standar medis
            </p>
        </div>
    </div>
</div>