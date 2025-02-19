<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Berita - Healtisin AI</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50">
    @include('partials.header')

    <main class="pt-24 pb-16">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-12">
                <h1 class="text-3xl font-bold text-gray-900 mb-4">Berita Terkini</h1>
                <p class="text-gray-600">Temukan informasi terbaru seputar kesehatan dan teknologi</p>
            </div>

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
</body>
</html>
