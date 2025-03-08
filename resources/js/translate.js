// Fungsi untuk menerjemahkan teks menggunakan API MyMemory (gratis)
async function translateText(text, targetLang) {
    if (!text || text.trim() === '' || text.length > 500) return text;
    
    try {
        // MyMemory API (gratis hingga 5000 kata per hari)
        const sourceLang = targetLang === 'id' ? 'en' : 'id';
        const url = `https://api.mymemory.translated.net/get?q=${encodeURIComponent(text)}&langpair=${sourceLang}|${targetLang}`;
        
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error('Terjemahan gagal');
        }

        const data = await response.json();
        
        // Periksa apakah terjemahan berhasil
        if (data.responseStatus === 200 && data.responseData && data.responseData.translatedText) {
            return data.responseData.translatedText;
        } else {
            // Jika gagal, kembalikan teks asli
            console.warn('Translation warning:', data.responseStatus, data.responseData);
            return text;
        }
    } catch (error) {
        console.error('Error translating:', error);
        return text; // Kembalikan teks asli jika terjadi kesalahan
    }
}

// Fungsi untuk menerjemahkan elemen node dan semua anak-anaknya
async function translateNode(element, targetLang) {
    // Tambahkan pengecekan untuk elemen valid
    if (!element) return;
    
    // Jika elemen memiliki atribut data-no-translate, lewati
    if (element.hasAttribute && element.hasAttribute('data-no-translate')) {
        return;
    }
    
    // Periksa juga apakah elemen induk memiliki data-no-translate
    let parent = element.parentElement;
    while (parent) {
        if (parent.hasAttribute && parent.hasAttribute('data-no-translate')) {
            return; // Lewati jika ada induk dengan data-no-translate
        }
        parent = parent.parentElement;
    }

    // Jika elemen adalah TextNode, terjemahkan kontennya jika memiliki teks
    if (element.nodeType === Node.TEXT_NODE) {
        const trimmedText = element.textContent.trim();
        if (trimmedText.length > 0 && trimmedText.length < 500) {
            try {
                // Periksa cache terjemahan
                const cacheKey = `${trimmedText}_${targetLang}`;
                const cachedTranslation = sessionStorage.getItem(cacheKey);
                
                if (cachedTranslation) {
                    element.textContent = element.textContent.replace(trimmedText, cachedTranslation);
                } else {
                    // Terjemahkan teks
                    console.log(`Menerjemahkan: "${trimmedText}"`);
                    const translatedText = await translateText(trimmedText, targetLang);
                    
                    // Simpan di cache
                    if (translatedText !== trimmedText) {
                        sessionStorage.setItem(cacheKey, translatedText);
                        element.textContent = element.textContent.replace(trimmedText, translatedText);
                    }
                }
            } catch (e) {
                console.error("Error saat menerjemahkan node teks:", e);
            }
        }
    } 
    // Jika ini adalah elemen biasa, terjemahkan atribut dan anak-anak
    else if (element.nodeType === Node.ELEMENT_NODE) {
        // Lewati beberapa elemen yang tidak perlu diterjemahkan
        const skipTags = ['SCRIPT', 'STYLE', 'SVG', 'CODE', 'PRE'];
        if (skipTags.includes(element.tagName)) {
            return;
        }
        
        // Terjemahkan atribut seperti placeholder, title, alt
        try {
            const attributesToTranslate = ['placeholder', 'title', 'alt'];
            
            for (const attr of attributesToTranslate) {
                if (element.hasAttribute(attr) && element.getAttribute(attr).trim().length > 0) {
                    const originalText = element.getAttribute(attr);
                    if (originalText.length < 500) {
                        const cacheKey = `${originalText}_${targetLang}_attr`;
                        const cachedTranslation = sessionStorage.getItem(cacheKey);
                        
                        if (cachedTranslation) {
                            element.setAttribute(attr, cachedTranslation);
                        } else {
                            console.log(`Menerjemahkan atribut ${attr}: "${originalText}"`);
                            const translatedText = await translateText(originalText, targetLang);
                            if (translatedText !== originalText) {
                                sessionStorage.setItem(cacheKey, translatedText);
                                element.setAttribute(attr, translatedText);
                            }
                        }
                    }
                }
            }
        } catch (e) {
            console.error("Error saat menerjemahkan atribut:", e);
        }
        
        // Terjemahkan semua anak-anak elemen
        try {
            const childNodes = Array.from(element.childNodes);
            for (const child of childNodes) {
                await translateNode(child, targetLang);
            }
        } catch (e) {
            console.error("Error saat menerjemahkan anak elemen:", e);
        }
    }
}

window.changeLanguage = async function(lang) {
    try {
        // Tampilkan loading indicator
        const loadingDiv = document.createElement('div');
        loadingDiv.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-[60]';
        loadingDiv.innerHTML = `
            <div class="bg-white p-6 rounded-lg flex flex-col items-center gap-4">
                <svg class="animate-spin h-10 w-10 text-[#24b0ba]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span id="translation-status">Mengganti Bahasa...</span>
                <div class="w-full bg-gray-200 rounded-full h-2.5">
                    <div id="translation-progress" class="bg-[#24b0ba] h-2.5 rounded-full" style="width: 0%"></div>
                </div>
            </div>
        `;
        document.body.appendChild(loadingDiv);
        
        const statusElement = document.getElementById('translation-status');
        const progressElement = document.getElementById('translation-progress');

        // Simpan perubahan bahasa ke server
        statusElement.textContent = 'Menyimpan preferensi bahasa...';
        const response = await fetch('/language/change', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ language: lang })
        });

        if (!response.ok) {
            throw new Error('Gagal mengubah bahasa');
        }

        // Jika bahasa yang dipilih adalah Indonesia (default), muat ulang halaman
        if (lang === 'id') {
            sessionStorage.clear();
            window.location.reload();
            return;
        }

        // Terjemahkan konten halaman
        statusElement.textContent = 'Menerjemahkan konten halaman...';
        
        // Fokus pada elemen-elemen teks yang penting saja
        const importantSelectors = [
            'h1', 'h2', 'h3', 'h4', 'h5', 'h6',
            'p', 'span:not(.icon)', 'button:not([data-no-translate])', 
            'a:not([data-no-translate])', 'label', '.card-title', 
            '.card-text', 'li', 'th', 'td'
        ];
        
        const elementsToTranslate = document.querySelectorAll(importantSelectors.join(', '));
        const totalElements = elementsToTranslate.length;
        let processedElements = 0;
        
        console.log(`Menerjemahkan ${totalElements} elemen...`);
        
        for (const element of elementsToTranslate) {
            if (!element.hasAttribute('data-no-translate')) {
                try {
                    await translateNode(element, lang);
                } catch (e) {
                    console.error("Error saat menerjemahkan elemen:", e);
                }
                
                processedElements++;
                const percentage = Math.round((processedElements / totalElements) * 100);
                progressElement.style.width = `${percentage}%`;
                statusElement.textContent = `Menerjemahkan konten... (${percentage}%)`;
            }
        }

        // Berhasil menerjemahkan semua konten
        statusElement.textContent = "Terjemahan selesai!";
        progressElement.style.width = "100%";
        
        // Tampilkan indikator sukses sebelum menutup
        setTimeout(() => {
            // Hapus loading indicator
            loadingDiv.remove();
            
            // Tutup modal bahasa jika ada
            if (typeof closeLanguageModal === 'function') {
                closeLanguageModal();
            }
            
            // Tampilkan notifikasi sukses
            const alertDiv = document.createElement('div');
            alertDiv.className = 'fixed top-4 right-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded z-50';
            
            // Perbarui tanda ceklis di modal bahasa
            const langButtons = document.querySelectorAll('[data-lang-code]');
            langButtons.forEach(button => {
                const checkMark = button.querySelector('.language-check-mark');
                if (button.dataset.langCode === lang) {
                    checkMark.classList.remove('hidden');
                } else {
                    checkMark.classList.add('hidden');
                }
            });
            
            // Perbarui notifikasi sukses di line 211-212 untuk mendukung semua bahasa
            const languageNames = {
                'id': 'Bahasa Indonesia',
                'en': 'Bahasa Inggris',
            };
            
            alertDiv.textContent = 'Bahasa berhasil diubah ke ' + 
                                  (languageNames[lang] || languageNames['id']);
            
            document.body.appendChild(alertDiv);
            
            setTimeout(() => {
                alertDiv.remove();
            }, 3000);

            // Perbarui elemen tampilan bahasa di settings modal
            const languageDisplayElement = document.querySelector('input[value*="Bahasa Indonesia"], input[value*="English"]');
            if (languageDisplayElement) {
                // Gunakan nilai native dari config bahasa
                const languages = {
                    'id': 'Bahasa Indonesia',
                    'en': 'English',
                };
                
                if (languages[lang]) {
                    languageDisplayElement.value = languages[lang];
                }
            }
        }, 1000);
        
    } catch (error) {
        console.error('Language change error:', error);
        alert('Gagal mengubah bahasa: ' + error.message);
        document.querySelector('.fixed.inset-0.bg-black')?.remove();
    }
}

// Fungsi debug untuk memeriksa apakah translate.js dimuat dengan benar
console.log('Translate.js loaded successfully!');

// Fungsi untuk menguji koneksi API terjemahan
window.testTranslateAPI = async function() {
    try {
        const result = await translateText('Halo dunia', 'en');
        console.log('Test translation result:', result);
        alert(`Test translation: "Halo dunia" -> "${result}"`);
        return result;
    } catch (e) {
        console.error('Test translation failed:', e);
        alert('Test translation failed: ' + e.message);
    }
}
