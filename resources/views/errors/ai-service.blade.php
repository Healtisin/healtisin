<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Halaman error layanan AI Healtisin">
    
    {{-- Tambahkan status code untuk SEO --}}
    @if(isset($exception))
        <meta name="robots" content="noindex">
    @endif
    
    <title>{{ isset($exception) ? "{$exception->getStatusCode()} |" : "" }} Layanan AI Tidak Tersedia - Healtisin AI</title>
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
            {{-- Tampilkan status code jika tersedia --}}
            @if(isset($exception))
                <p class="text-5xl font-bold text-[#24b0ba] mb-4">
                    {{ $exception->getStatusCode() }}
                </p>
            @endif

            <h1 class="text-3xl font-bold text-gray-900 mb-4">
                @if(isset($exception))
                    @switch($exception->getStatusCode())
                        @case(404)
                            Oops! Halaman Tidak Ditemukan
                            @break
                        @case(500)
                            Oops! Terjadi Kesalahan Server
                            @break
                        @case(503)
                            Oops! Layanan Sedang Dalam Pemeliharaan
                            @break
                        @default
                            Oops! Layanan AI Sedang Bermasalah
                    @endswitch
                @else
                    Oops! Layanan AI Sedang Bermasalah
                @endif
            </h1>

            <p class="text-lg text-gray-600 mb-8">
                {{ $message ?? $exception->getMessage() ?? 'Terjadi kesalahan yang tidak diketahui' }}
            </p>

            {{-- Tambahkan saran tindakan --}}
            <div class="text-gray-600 mb-8">
                <p>Silakan coba:</p>
                <ul class="mt-2 space-y-2">
                    <li>• Muat ulang halaman</li>
                    <li>• Periksa koneksi internet Anda</li>
                    <li>• Kembali beberapa saat lagi</li>
                </ul>
            </div>

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

            {{-- Tambahkan contact support --}}
            <p class="text-sm text-gray-500">
                Jika masalah berlanjut, silakan hubungi 
                <a href="mailto:support@healtisin.com" class="text-[#24b0ba] hover:underline">
                    support@healtisin.com
                </a>
            </p>
        </div>
    </div>
</body>
</html>
