<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Tidak Ditemukan - Healtisin AI</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex flex-col items-center justify-center px-4">
        <!-- Animasi Ilustrasi -->
        <div class="mb-4 relative flex justify-center items-center">
            <img src="{{ asset('images/animasi3.png') }}" alt="Animasi Healtisin"
                style="width: 300px; height: 300px;"
                class="object-cover rounded-lg">
        </div>

        <!-- Pesan Error -->
        <div class="text-center max-w-lg">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">
                Oops! Sepertinya Anda Tersesat
            </h1>
            <p class="text-lg text-gray-600 mb-8">
                Halaman yang Anda cari mungkin sedang dalam pemeriksaan atau telah dipindahkan ke ruangan lain.
            </p>

            <!-- Tombol Navigasi dengan Efek Hover -->
            <div class="space-y-4 mb-8">
                <a href="{{ url()->previous() }}" 
                   class="group inline-flex items-center gap-2 px-6 py-3 bg-[#24b0ba] text-white rounded-full 
                          hover:bg-[#73c7e3] transition-all duration-300 transform hover:scale-105">
                    <svg class="w-5 h-5 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali
                </a>
            </div>
        </div>

        <!-- Footer dengan Elemen Medis -->
        <div class="mt-16 text-center">
            <div class="flex items-center justify-center gap-2 text-gray-400 mb-2">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
                <span>&copy; {{ date('Y') }} Healtisin AI</span>
            </div>
            <p class="text-sm text-gray-400">Tetap sehat dan jangan lupa jaga kesehatan!</p>
        </div>
    </div>
</body>
</html>