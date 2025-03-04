<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layanan AI Tidak Tersedia - Healtisin AI</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex flex-col items-center justify-center px-4">
        <div class="mb-4 relative flex justify-center items-center">
            <img src="{{ asset('images/animasi3.png') }}" alt="Animasi Healtisin"
                style="width: 300px; height: 300px;"
                class="object-cover rounded-lg">
        </div>

        <div class="text-center max-w-lg">
            <h1 class="text-3xl font-bold text-gray-900 mb-4">
                Oops! Layanan AI Sedang Bermasalah
            </h1>
            <p class="text-lg text-gray-600 mb-8">
                {{ $message }}
            </p>

            <div class="space-y-4 mb-8">
                <a href="{{ url()->previous() !== url()->current() ? url()->previous() : '/' }}" 
                   class="group inline-flex items-center gap-2 px-6 py-3 bg-[#24b0ba] text-white rounded-full 
                          hover:bg-[#73c7e3] transition-all duration-300 transform hover:scale-105">
                    <svg class="w-5 h-5 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali
                </a>
            </div>
        </div>
    </div>
</body>
</html>
