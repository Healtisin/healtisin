<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Paket Pro - Healtisin AI</title>
    @vite('resources/css/app.css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex flex-col">
        <!-- Header dengan tombol kembali -->
        <header class="fixed w-full bg-white shadow-sm z-10">
            <div class="max-w-7xl mx-auto px-4 py-4">
                <a href="{{ url()->previous() == url('/') ? '/' : '/home' }}" 
                   class="inline-flex items-center text-gray-600 hover:text-[#24b0ba]">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali
                </a>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-1 pt-20">
            <div class="max-w-4xl mx-auto px-4 py-12">
                <div class="text-center mb-12">
                    <h1 class="text-4xl font-bold mb-4">Tingkatkan ke Pro</h1>
                    <p class="text-xl text-gray-600">Nikmati layanan kesehatan yang lebih lengkap dengan Healtisin Pro</p>
                </div>

                <!-- Perbandingan Fitur -->
                @include('pricing.partials.feature-comparison', ['features' => $features])

                <!-- Perbandingan Harga -->
                @include('pricing.partials.price-comparison', ['packages' => $packages])

                <!-- Tombol Lanjutkan -->
                <div class="mt-8 text-center">
                    @auth
                        <a href="{{ route('pricing.select-package') }}" 
                           class="inline-block px-8 py-3 bg-[#24b0ba] text-white rounded-full 
                                  hover:bg-[#73c7e3] text-lg font-semibold">
                            Lanjutkan Berlangganan
                        </a>
                    @else
                        <div class="space-y-4">
                            <p class="text-gray-600">Silakan login terlebih dahulu untuk melanjutkan</p>
                            <a href="{{ route('login', ['redirect' => 'pricing.select-package']) }}" 
                               class="inline-block px-8 py-3 bg-[#24b0ba] text-white rounded-full 
                                      hover:bg-[#73c7e3] text-lg font-semibold">
                                Login untuk Melanjutkan
                            </a>
                        </div>
                    @endauth
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-white border-t">
            <div class="max-w-7xl mx-auto px-4 py-6 text-center text-sm text-gray-600">
                <p>&copy; {{ date('Y') }} Healtisin AI. Hak Cipta Dilindungi.</p>
            </div>
        </footer>
    </div>
</body>
</html>

