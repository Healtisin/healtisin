<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome - Healtisin AI</title>
    @vite('resources/css/app.css')
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
    @include('partials.header')

    <main class="pt-24 pb-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center mb-32">
                <div class="w-1/2 pr-8">
                    <h1 class="text-6xl font-serif mb-8">
                        Bertemu<br />
                        Healtisin AI
                    </h1>
                    <p class="text-xl mb-8 font-serif text-gray-600">
                        Healtisin, asisten AI kesehatan terdepan siap menjaga kesehatan Anda 24/7. Dapatkan skrining
                        kesehatan yang cepat dan akurat dengan teknologi AI mutakhir kami.
                    </p>
                    <div class="flex gap-4">
                        <button class="px-6 py-3 bg-[#24b0ba] text-white rounded-full hover:bg-[#73c7e3]">
                            Coba Gratis
                        </button>
                        <!-- <button class="px-6 py-3 border border-black rounded-full hover:bg-gray-50">
                                Dapatkan akses API
                            </button> -->
                    </div>
                </div>

                <div class="w-1/2 flex justify-center items-center">
                    <img src="{{ asset('images/animasi2.png') }}" alt="Animasi Healtisin"
                        class="w-4/5 h-4/5 object-cover rounded-lg">
                </div>
            </div>

            <!-- Capabilities Section -->
            <div class="text-center mb-16">
                <h2 class="text-4xl font-serif mb-4">Kemampuan Healtisin</h2>
                <p class="text-xl text-gray-600 mb-16">Healtisin hadir dengan berbagai fitur untuk membantu kesehatan
                    Anda</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-32">
                <!-- Capability 1 -->
                <div class="text-center">
                    <div class="bg-[#F4F1DE] p-8 rounded-lg mb-4 flex items-center justify-center">
                        <svg class="w-16 h-16" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Skrining Kesehatan</h3>
                    <p class="text-gray-600">Lakukan skrining kesehatan dengan cepat dan mudah melalui chat interaktif
                    </p>
                </div>

                <!-- Capability 2 -->
                <div class="text-center">
                    <div class="bg-[#F4F1DE] p-8 rounded-lg mb-4 flex items-center justify-center">
                        <svg class="w-16 h-16" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Konsultasi 24/7</h3>
                    <p class="text-gray-600">Dapatkan saran kesehatan kapanpun dan dimanapun Anda berada</p>
                </div>

                <!-- Capability 3 -->
                <div class="text-center">
                    <div class="bg-[#F4F1DE] p-8 rounded-lg mb-4 flex items-center justify-center">
                        <svg class="w-16 h-16" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Akurasi Tinggi</h3>
                    <p class="text-gray-600">Didukung data medis terkini dan teknologi AI mutakhir</p>
                </div>

                <!-- Capability 4 -->
                <div class="text-center">
                    <div class="bg-[#F4F1DE] p-8 rounded-lg mb-4 flex items-center justify-center">
                        <svg class="w-16 h-16" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Privasi Terjamin</h3>
                    <p class="text-gray-600">Data kesehatan Anda aman dan terenkripsi dengan standar medis</p>
                </div>
            </div>
        </div>
    </main>

    @include('partials.footer')
</body>

</html>