<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Healtisin AI</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

<body class="bg-gray-100">
    <div class="flex h-screen overflow-hidden">
        <div class="flex-shrink-0 bg-white h-screen w-auto overflow-y-auto">
            @include('admin.sidebar')
        </div>

        <div class="flex-1 h-screen overflow-y-auto">
            @yield('content')
        </div>
    </div>
</body>

</html>