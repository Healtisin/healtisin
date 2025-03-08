<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Berita - Healtisin AI</title>
    @include('partials.dark-mode-init')
    @vite('resources/css/app.css')
    @vite('resources/js/translate.js')
    @include('lang.language-modal')
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200 transition-colors duration-200">
    @include('partials.header')

    <main class="pt-18 pb-16">
        <!-- Hero Section dengan Animasi Paralaks -->
        <div class="relative h-[500px] overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-[#24b0ba] to-[#73c7e3] dark:from-[#1a8a91] dark:to-[#5ba5bd]">
                <div class="absolute inset-0 opacity-20">
                    <div class="floating-dots"></div>
                </div>
            </div>
            <div class="relative max-w-6xl mx-auto px-4 h-full flex items-center">
                <div class="text-white">
                    <h1 class="text-5xl font-bold mb-6 animate-fade-in">Berita Terkini</h1>
                    <p class="text-xl opacity-90 max-w-2xl animate-slide-up">
                        Temukan informasi terbaru seputar kesehatan dan teknologi
                    </p>
                </div>
            </div>
        </div>

        <!-- Existing news content with adjusted padding -->
        <div class="max-w-7xl mx-auto px-4 -mt-20 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($news as $item)
                <article class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <span class="inline-block px-3 py-1 text-sm font-medium text-[#24b0ba] bg-[#e8f7f9] rounded-full mb-4">
                            {{ $item->category }}
                        </span>
                        <h2 class="text-xl font-bold text-gray-900 mb-2">{{ $item->title }}</h2>
                        <p class="text-gray-600 mb-4">{{ Str::limit(strip_tags($item->content), 120) }}</p>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500">
                                {{ $item->published_at->locale('id')->diffForHumans() }}
                            </span>
                            <a href="{{ route('news.show', $item->slug) }}" class="text-[#24b0ba] hover:text-[#1d8f98]">
                                Baca selengkapnya →
                            </a>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $news->links() }}
            </div>
        </div>
    </main>

    @include('partials.footer')

    <style>
        .floating-dots {
            background-image: radial-gradient(circle, white 2px, transparent 0.5px);
            background-size: 30px 30px;
            height: 200%;
            animation: float 20s linear infinite;
            position: absolute;
            width: 100%;
            top: 0;
        }

        .animate-fade-in {
            opacity: 0;
            animation: fadeIn 1s ease-out forwards;
        }

        .animate-slide-up {
            opacity: 0;
            transform: translateY(20px);
            animation: slideUp 1s ease-out 0.5s forwards;
        }

        @keyframes float {
            0% { transform: translateY(0); }
            100% { transform: translateY(-50%); }
        }

        @keyframes fadeIn {
            to { opacity: 1; }
        }

        @keyframes slideUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</body>
</html>
