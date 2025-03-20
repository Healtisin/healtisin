<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('partials.title', ['segment' => 'Berita'])
    @include('partials.dark-mode-init')
    @vite('resources/css/app.css')
    @vite('resources/js/translate.js')
    @include('lang.language-modal')
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200 transition-colors duration-200">
    @include('partials.header')

    <main class="pt-16 sm:pt-18 pb-16">
        <!-- Hero Section dengan Animasi Paralaks -->
        <div class="relative h-[250px] sm:h-[300px] md:h-[500px] overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-[#24b0ba] to-[#73c7e3] dark:from-[#1a8a91] dark:to-[#5ba5bd]">
                <div class="absolute inset-0 opacity-20">
                    <div class="floating-dots"></div>
                </div>
            </div>
            <div class="relative max-w-6xl mx-auto px-4 h-full flex items-center">
                <div class="text-white text-center md:text-left w-full">
                    <h1 class="text-2xl sm:text-3xl md:text-5xl font-bold mb-3 sm:mb-6 animate-fade-in">Berita Terkini</h1>
                    <p class="text-base sm:text-lg md:text-xl opacity-90 max-w-2xl mx-auto md:mx-0 animate-slide-up">
                        Temukan informasi terbaru seputar kesehatan dan teknologi
                    </p>
                </div>
            </div>
        </div>

        <!-- Existing news content with adjusted padding -->
        <div class="max-w-7xl mx-auto px-4 -mt-10 sm:-mt-16 md:-mt-20 relative z-10">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                @foreach($news as $item)
                <article class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden">
                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="w-full h-40 sm:h-48 object-cover">
                    <div class="p-4 sm:p-6">
                        <span class="inline-block px-2 sm:px-3 py-1 text-xs sm:text-sm font-medium text-[#24b0ba] bg-[#e8f7f9] dark:bg-[#24b0ba]/10 rounded-full mb-3 sm:mb-4">
                            {{ $item->category }}
                        </span>
                        <h2 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">{{ $item->title }}</h2>
                        <p class="text-sm sm:text-base text-gray-600 dark:text-gray-400 mb-4">{{ Str::limit(strip_tags($item->content), 100) }}</p>
                        <div class="flex items-center justify-between">
                            <span class="text-xs sm:text-sm text-gray-500 dark:text-gray-400">
                                {{ $item->published_at->locale('id')->diffForHumans() }}
                            </span>
                            <a href="{{ route('news.show', $item->slug) }}" class="text-sm sm:text-base text-[#24b0ba] hover:text-[#1d8f98] dark:text-[#73c7e3] dark:hover:text-[#24b0ba]">
                                Baca selengkapnya →
                            </a>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>

            <div class="mt-6 sm:mt-8">
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

        @media (max-width: 640px) {
            .floating-dots {
                background-size: 20px 20px;
            }
        }
    </style>
</body>
</html>
