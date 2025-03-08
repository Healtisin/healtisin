<script>
    // Inisialisasi preferensi bahasa sebelum halaman dimuat sepenuhnya
    document.addEventListener('DOMContentLoaded', function() {
        // Mengambil bahasa dari URL jika ada
        const urlParams = new URLSearchParams(window.location.search);
        const langParam = urlParams.get('lang');
        
        if (langParam && ['id', 'en'].includes(langParam)) {
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
                'en': 'English'
            };
            
            if (languages[userLocale]) {
                languageDisplayElement.value = languages[userLocale];
            }
        }
    }
</script>