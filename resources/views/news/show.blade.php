<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $news->title }} - Healtisin AI</title>
    @vite('resources/css/app.css')
    @vite('resources/js/translate.js')
    <script>
        // Inisialisasi preferensi bahasa sebelum halaman dimuat sepenuhnya
        document.addEventListener('DOMContentLoaded', function() {
            // Mengambil bahasa dari URL jika ada
            const urlParams = new URLSearchParams(window.location.search);
            const langParam = urlParams.get('lang');
            
            if (langParam && ['id', 'en', 'ja', 'ko', 'zh'].includes(langParam)) {
                changeLanguage(langParam);
            } else {
                // Perbarui tampilan bahasa sesuai dengan bahasa yang disimpan di cookie
                updateLanguageDisplay();
            }
        });

        // Fungsi untuk memperbarui tampilan bahasa
function updateLanguageDisplay() {
            // Perbarui tanda ceklis di modal bahasa
            const langButtons = document.querySelectorAll('[data-lang-code]');
            if (langButtons.length === 0) return;
            
            // Cek cookie untuk mendapatkan bahasa yang disimpan
            const cookies = document.cookie.split(';');
            let userLocale = '{{ App::getLocale() }}'; // Default dari server
            
            for (const cookie of cookies) {
                const [name, value] = cookie.trim().split('=');
                if (name === 'user_locale') {
                    userLocale = value;
                    break;
                }
            }
            
            // Perbarui tanda ceklis
            langButtons.forEach(button => {
                const checkMark = button.querySelector('.language-check-mark');
                if (button.dataset.langCode === userLocale) {
                    checkMark.classList.remove('hidden');
                } else {
                    checkMark.classList.add('hidden');
                }
            });
            
            // Perbarui tampilan bahasa di input jika ada
            const languageDisplayElement = document.getElementById('current-language-display');
            if (languageDisplayElement) {
                const languages = {
                    'id': 'Bahasa Indonesia',
                    'en': 'English',
                    'ja': '日本語',
                    'ko': '한국어',
                    'zh': '中文'
                };
                
                if (languages[userLocale]) {
                    languageDisplayElement.value = languages[userLocale];
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50">
    @include('partials.header')

    <main class="pt-24 pb-16">
        <div class="max-w-4xl mx-auto px-4">
            <!-- Breadcrumb -->
            <nav class="flex mb-8" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('news.index') }}" class="text-gray-500 hover:text-gray-700">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                            </svg>
                            Berita
                        </a>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                            <span class="ml-1 text-gray-500">{{ Str::limit($news->title, 40) }}</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <!-- Article Content -->
            <article class="bg-white rounded-xl shadow-sm overflow-hidden">
                <img src="{{ asset('storage/' . $news->image) }}" 
                     alt="{{ $news->title }}" 
                     class="w-full h-[400px] object-cover">
                
                <div class="p-8">
                    <div class="mb-6">
                        <span class="inline-block px-3 py-1 text-sm font-medium text-[#24b0ba] bg-[#e8f7f9] rounded-full">
                            {{ $news->category }}
                        </span>
                        <time class="text-sm text-gray-500 ml-4">
                            {{ $news->published_at->locale('id')->isoFormat('D MMMM Y') }}
                        </time>
                    </div>

                    <h1 class="text-3xl font-bold text-gray-900 mb-6">{{ $news->title }}</h1>
                    
                    <div class="prose max-w-none">
                        {!! $news->content !!}
                    </div>
                </div>
            </article>

            <!-- Share Buttons -->
            <div class="mt-8 flex items-center justify-center gap-4">
                <span class="text-gray-600">Bagikan artikel ini:</span>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" 
                   target="_blank"
                   class="text-blue-600 hover:text-blue-700">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M18.77 7.46H14.5v-1.9c0-.9.6-1.1 1-1.1h3V.5h-4.33C10.24.5 9.5 3.44 9.5 5.32v2.15h-3v4h3v12h5v-12h3.85l.42-4z"/>
                    </svg>
                </a>
                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($news->title) }}" 
                   target="_blank"
                   class="text-blue-400 hover:text-blue-500">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M23.44 4.83c-.8.37-1.5.38-2.22.02.93-.56.98-.96 1.32-2.02-.88.52-1.86.9-2.9 1.1-.82-.88-2-1.43-3.3-1.43-2.5 0-4.55 2.04-4.55 4.54 0 .36.03.7.1 1.04-3.77-.2-7.12-2-9.36-4.75-.4.67-.6 1.45-.6 2.3 0 1.56.8 2.95 2 3.77-.74-.03-1.44-.23-2.05-.57v.06c0 2.2 1.56 4.03 3.64 4.44-.67.2-1.37.2-2.06.08.58 1.8 2.26 3.12 4.25 3.16C5.78 18.1 3.37 18.74 1 18.46c2 1.3 4.4 2.04 6.97 2.04 8.35 0 12.92-6.92 12.92-12.93 0-.2 0-.4-.02-.6.9-.63 1.96-1.22 2.56-2.14z"/>
                    </svg>
                </a>
                <a href="https://wa.me/?text={{ urlencode($news->title . ' ' . request()->url()) }}" 
                   target="_blank"
                   class="text-green-600 hover:text-green-700">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                    </svg>
                </a>
            </div>

            <!-- Related Articles -->
            <div class="mt-16">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Artikel Terkait</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($relatedNews as $item)
                    <article class="bg-white rounded-xl shadow-sm overflow-hidden">
                        <img src="{{ asset('storage/' . $item->image) }}" 
                             alt="{{ $item->title }}" 
                             class="w-full h-48 object-cover">
                        <div class="p-6">
                            <span class="inline-block px-3 py-1 text-sm font-medium text-[#24b0ba] bg-[#e8f7f9] rounded-full mb-4">
                                {{ $item->category }}
                            </span>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $item->title }}</h3>
                            <p class="text-gray-600 mb-4">{{ Str::limit(strip_tags($item->content), 100) }}</p>
                            <a href="{{ route('news.show', $item->slug) }}" 
                               class="text-[#24b0ba] hover:text-[#1d8f98]">
                                Baca selengkapnya →
                            </a>
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
</body>
</html>