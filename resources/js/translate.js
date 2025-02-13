import { translate } from 'google-translate-api-browser';

async function translateNode(node, targetLang) {
    if (node.nodeName === 'SCRIPT' || 
        node.nodeName === 'STYLE' || 
        node.nodeName === 'INPUT' || 
        node.nodeName === 'TEXTAREA') {
        return;
    }

    if (node.nodeType === Node.TEXT_NODE && node.textContent.trim()) {
        try {
            const { text } = await translate(node.textContent.trim(), { to: targetLang });
            node.textContent = text;
        } catch (error) {
            console.error('Translation error:', error);
        }
    }

    for (let child of node.childNodes) {
        await translateNode(child, targetLang);
    }
}

window.changeLanguage = async function(lang) {
    try {
        // Tampilkan loading indicator
        const loadingDiv = document.createElement('div');
        loadingDiv.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-[60]';
        loadingDiv.innerHTML = `
            <div class="bg-white p-4 rounded-lg flex items-center gap-2">
                <svg class="animate-spin h-5 w-5 text-[#24b0ba]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span>Mengganti Bahasa...</span>
            </div>
        `;
        document.body.appendChild(loadingDiv);

        // Simpan perubahan bahasa ke server
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

        // Terjemahkan konten halaman
        const elementsToTranslate = document.querySelectorAll('p, h1, h2, h3, h4, h5, h6, span, button, a, label');
        for (const element of elementsToTranslate) {
            if (!element.hasAttribute('data-no-translate')) {
                await translateNode(element, lang);
            }
        }

        // Hapus loading indicator
        loadingDiv.remove();
        
        // Tutup modal bahasa
        closeLanguageModal();

    } catch (error) {
        console.error('Language change error:', error);
        alert('Gagal mengubah bahasa: ' + error.message);
    }
}
