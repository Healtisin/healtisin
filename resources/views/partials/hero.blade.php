@php
use App\Helpers\InformationHelper;
@endphp

<div class="flex flex-col md:flex-row items-center justify-center mb-16 md:mb-32 px-4 md:px-0">
    <!-- Bagian Teks -->
    <div class="w-full md:w-1/2 md:pr-8 text-center md:text-left">
        <h1 class="text-4xl md:text-6xl font-serif mb-6 md:mb-8 dark:text-gray-100">
            Bertemu<br />
            {{ InformationHelper::getProductName() }}
        </h1>
        <p class="text-lg md:text-xl mb-6 md:mb-8 font-serif text-gray-600 dark:text-gray-400">
            {{ InformationHelper::getWebsiteDescription() }}
        </p>
        <div class="flex justify-center md:justify-start gap-4">
            <a href="{{ route('login') }}"
                class="px-6 py-3 bg-[#24b0ba] text-white rounded-full hover:bg-[#73c7e3] dark:bg-[#24b0ba]/80 dark:hover:bg-[#73c7e3]/80">
                Coba Gratis
            </a>
        </div>
    </div>

    <!-- Bagian Gambar -->
    <div class="w-full md:w-1/2 flex justify-center items-center mt-8 md:mt-0">
        <img src="{{ asset('images/animasi2.png') }}" alt="Animasi {{ InformationHelper::getProductName() }}"
            class="w-full md:w-4/5 h-auto object-cover rounded-lg dark:opacity-90">
    </div>
</div>