<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home - Healtisin AI</title>
    @vite('resources/css/app.css')

    <style>
        /* Scrollbar untuk Webkit (Chrome, Safari, Edge) */
        #chatMessages::-webkit-scrollbar {
            width: 8px;
        }

        #chatMessages::-webkit-scrollbar-track {
            border-radius: 10px;
            background-color: #f8f8f8;
            /* Warna background lebih terang/samar */
            margin: 5px;
        }

        #chatMessages::-webkit-scrollbar-thumb {
            border-radius: 10px;
            background: rgba(156, 163, 175, 0.5);
            /* Warna thumb abu-abu transparan */
            border: 2px solid transparent;
            background-clip: padding-box;
            min-height: 50px;
            transition: background .2s;
        }

        #chatMessages::-webkit-scrollbar-thumb:hover {
            background: rgba(156, 163, 175, 0.7);
            /* Warna hover sedikit lebih gelap */
            border: 2px solid transparent;
        }

        /* Scrollbar untuk Firefox */
        #chatMessages {
            scrollbar-width: thin;
            scrollbar-color: rgba(156, 163, 175, 0.5) transparent;
        }

        #chatMessages:hover {
            scrollbar-color: rgba(156, 163, 175, 0.7) transparent;
        }

        /* Styling scrollbar untuk Webkit browsers (Chrome, Safari, Edge) */
        #chatInput::-webkit-scrollbar {
            width: 4px;
        }

        #chatInput::-webkit-scrollbar-track {
            background: transparent;
        }

        #chatInput::-webkit-scrollbar-thumb {
            background: rgba(156, 163, 175, 0.5);
            border-radius: 4px;
        }

        #chatInput::-webkit-scrollbar-thumb:hover {
            background: rgba(156, 163, 175, 0.7);
        }

        /* Styling scrollbar untuk Firefox */
        #chatInput {
            scrollbar-width: thin;
            scrollbar-color: rgba(156, 163, 175, 0.5) transparent;
        }

        /* Styling untuk textarea */
        #chatInput {
            min-height: 56px;
            /* Tinggi minimum untuk 1 baris (24px line-height + 32px padding) */
            max-height: 128px;
            /* Tinggi maksimum untuk 4 baris ((24px × 4) + 32px padding) */
            padding: 16px 148px 16px 24px;
            line-height: 24px;
            font-size: 16px;
            overflow-y: auto;
            resize: none;
            box-sizing: border-box;
            display: block;
            position: relative;
        }

        /* Efek fade untuk konten yang tersembunyi */
        #chatInput.overflow::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 40px;
            background: linear-gradient(transparent, rgba(255, 255, 255, 0.9) 70%);
            pointer-events: none;
        }

        /* Menyembunyikan scrollbar untuk Chrome, Safari dan Opera */
        #chatInput::-webkit-scrollbar {
            display: none;
        }

        /* Menyembunyikan scrollbar untuk IE, Edge dan Firefox */
        #chatInput {
            -ms-overflow-style: none;
            /* IE dan Edge */
            scrollbar-width: none;
            /* Firefox */
            line-height: 20px;
            /* Jarak antar baris */
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="bg-gray-50">
    <div class="flex min-h-screen">
        <!-- Include Sidebar -->
        @include('partials.sidebar')

        <!-- Main Content -->
        <main class="flex-1">
            <div class="max-w-4xl mx-auto px-4 py-8">
                <!-- Chat Interface -->
                <div class="flex flex-col h-[calc(100vh-4rem)]">
                    <!-- Chat Messages -->
                    <div class="flex-1 overflow-y-auto mb-4 space-y-4 p-4 pr-2" id="chatMessages">
                        <!-- Pesan akan ditambahkan secara dinamis di sini -->
                    </div>

                    <!-- Chat Input -->
                    <div class="relative flex items-center gap-2">
                        <textarea id="chatInput"
                            class="w-full px-6 py-3 pr-[148px] rounded-full border border-gray-300 focus:outline-none focus:border-[#24b0ba] resize-none"
                            placeholder="Ketik pertanyaan Anda" rows="1"></textarea>

                        <div class="absolute right-5 top-1/2 -translate-y-1/2 flex items-center gap-2">
                            <button class="p-2 text-gray-500 hover:text-gray-700">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                </svg>
                            </button>
                            <button class="p-2 text-gray-500 hover:text-gray-700">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z" />
                                </svg>
                            </button>
                            <button
                                class="p-2 rounded-full bg-[#24b0ba] text-white hover:bg-[#1d8f98] transition-colors"
                                onclick="sendMessage()">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Settings Modal -->
    @include('partials.settings-modal')

    <!-- Password Verification Modal -->
    @include('partials.password-verification-modal')

    <!-- Change Password Modal -->
    @include('partials.change-password-modal')

    <!-- Change Name Modal -->
    @include('partials.change-name-modal')

    <!-- Delete Chat Modal -->
    @include('partials.delete-chat-modal')

    <!-- JavaScript for modal functionality -->
    <script>
        const Auth = {
            user: {
                name: "{{ Auth::user()->name }}",
                profile_photo: "{{ Auth::user()->profile_photo }}"
            }
        };

        // Fungsi untuk menyesuaikan tinggi textarea
        function adjustTextareaHeight() {
            const chatInput = document.getElementById('chatInput');
            chatInput.style.height = 'auto'; // Reset height
            chatInput.style.height = chatInput.scrollHeight + 'px'; // Sesuaikan tinggi berdasarkan scrollHeight
        }

        function openSettingsModal() {
            document.getElementById('settingsModal').classList.remove('hidden');
            document.getElementById('settingsModal').classList.add('flex');
        }

        function closeSettingsModal() {
            document.getElementById('settingsModal').classList.add('hidden');
            document.getElementById('settingsModal').classList.remove('flex');
        }

        const sidebar = document.getElementById('sidebar');
        const toggleIcon = document.getElementById('toggleIcon');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarTexts = document.querySelectorAll('.sidebar-text');
        const logoImage = document.getElementById('logoImage');
        const profileIcon = document.getElementById('profileIcon');

        let isExpanded = true;

        sidebarToggle.addEventListener('click', () => {
            isExpanded = !isExpanded;

            if (isExpanded) {
                sidebar.classList.remove('w-[90px]');
                sidebar.classList.add('w-80');
                toggleIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                `;
                logoImage.src = "{{ asset('images/logo.png') }}";
                sidebarTexts.forEach(text => text.classList.remove('hidden'));
                profileIcon.style.transform = 'translateX(0)';
            } else {
                sidebar.classList.remove('w-80');
                sidebar.classList.add('w-[90px]');
                toggleIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                `;
                logoImage.src = "{{ asset('images/animasi2.png') }}";
                sidebarTexts.forEach(text => text.classList.add('hidden'));
                profileIcon.style.transform = 'translateX(-3px)';
            }
        });

        const loadingMessage = `
            <div id="loadingMessage" class="flex justify-start gap-2 items-start mb-4">
                <div class="w-10 h-10 bg-[#24b0ba] rounded-full flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-white animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </div>
                <div class="flex flex-col max-w-[75%]">
                    <div class="bg-white border border-gray-200 rounded-2xl px-4 py-2 inline-block shadow-sm">
                        <p class="text-gray-600">Sedang mengetik...</p>
                    </div>
                </div>
            </div>
        `;

        async function sendMessage() {
            const input = document.getElementById('chatInput');
            const messagesContainer = document.getElementById('chatMessages');
            const message = input.value.trim();

            if (message) {
                // Clear input
                input.value = '';
                adjustTextareaHeight();

                // Add user message
                const userMessage = createUserMessageHtml(message);
                messagesContainer.insertAdjacentHTML('beforeend', userMessage);

                // Add loading message
                messagesContainer.insertAdjacentHTML('beforeend', loadingMessage);

                try {
                    const response = await fetch('/chat/send', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            message: message,
                            chatId: window.currentChatId // Kirim currentChatId jika ada
                        })
                    });

                    // Remove loading message
                    const loadingElement = document.getElementById('loadingMessage');
                    if (loadingElement) {
                        loadingElement.remove();
                    }

                    if (!response.ok) {
                        const data = await response.json();
                        throw new Error(data.message || 'Terjadi kesalahan saat memproses pesan');
                    }

                    const data = await response.json();

                    // Add AI response with timestamp
                    const aiResponse = createAIMessageHtml(data.message);
                    messagesContainer.insertAdjacentHTML('beforeend', aiResponse);

                    // Scroll to bottom
                    messagesContainer.scrollTop = messagesContainer.scrollHeight;

                    // Update currentChatId jika ini chat baru
                    if (!window.currentChatId && data.chatId) {
                        window.currentChatId = data.chatId;
                    }

                    // Update sidebar setelah pesan berhasil dikirim
                    await updateSidebar();

                } catch (error) {
                    console.error('Error:', error);
                    showErrorMessage(error.message);
                }
            }
        }

        // Helper function untuk menampilkan pesan error
        function showErrorMessage(message) {
            const messagesContainer = document.getElementById('chatMessages');
            const errorMessage = `
                <div class="flex justify-start gap-2 items-start mb-4">
                    <div class="w-10 h-10 bg-red-500 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="flex flex-col max-w-[75%]">
                        <div class="bg-white border border-red-200 rounded-2xl px-4 py-2 inline-block shadow-sm">
                            <p class="text-red-600">${message}</p>
                        </div>
                    </div>
                </div>
            `;
            messagesContainer.insertAdjacentHTML('beforeend', errorMessage);
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }

        // Fungsi untuk menyimpan chat history
        async function saveChatHistory(userMessage, aiResponse) {
            try {
                const response = await fetch('/chat/history', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        title: userMessage.substring(0, 50),
                        last_message: aiResponse,
                        messages: [{
                                role: 'user',
                                content: userMessage
                            },
                            {
                                role: 'assistant',
                                content: aiResponse
                            }
                        ],
                        last_interaction: new Date().toISOString()
                    })
                });

                if (!response.ok) {
                    throw new Error('Gagal menyimpan riwayat chat');
                }

                const data = await response.json();
                window.currentChatId = data.id;

                // Update sidebar tanpa reload
                updateSidebar();

            } catch (error) {
                console.error('Error saving chat history:', error);
                showErrorMessage('Gagal menyimpan riwayat chat: ' + error.message);
            }
        }

        // Fungsi untuk update sidebar
        async function updateSidebar() {
            try {
                const response = await fetch('/chat/histories');
                if (!response.ok) {
                    throw new Error('Gagal memperbarui sidebar');
                }
                const html = await response.text();
                const chatHistoryContainer = document.querySelector('.chat-history');
                if (chatHistoryContainer) {
                    chatHistoryContainer.innerHTML = html;

                    // Tambahkan kembali event listeners untuk tombol-tombol di sidebar
                    const chatButtons = chatHistoryContainer.querySelectorAll('button[onclick^="loadChat"]');
                    chatButtons.forEach(button => {
                        const chatId = button.getAttribute('onclick').match(/\d+/)[0];
                        button.onclick = () => loadChat(chatId);
                    });
                }
            } catch (error) {
                console.error('Error updating sidebar:', error);
            }
        }

        const chatInput = document.getElementById('chatInput');

        function getTextHeight(text, width, lineHeight) {
            // Buat elemen temporary untuk mengukur tinggi teks
            const temp = document.createElement('div');
            temp.style.width = width + 'px';
            temp.style.position = 'absolute';
            temp.style.visibility = 'hidden';
            temp.style.lineHeight = lineHeight + 'px';
            temp.style.whiteSpace = 'pre-wrap';
            temp.style.wordWrap = 'break-word';
            temp.style.fontFamily = window.getComputedStyle(chatInput).fontFamily;
            temp.style.fontSize = window.getComputedStyle(chatInput).fontSize;
            temp.innerText = text;
            document.body.appendChild(temp);
            const height = temp.offsetHeight;
            document.body.removeChild(temp);
            return height;
        }

        function adjustTextareaHeight() {
            const lineHeight = 24; // Tinggi satu baris
            const padding = 32; // Padding atas dan bawah
            const maxLines = 4; // Batasan tampilan maksimum baris
            const maxHeight = (lineHeight * maxLines) + padding; // Tinggi maksimum tampilan textarea

            // Reset height
            chatInput.style.height = 'auto';

            // Hitung tinggi teks saat ini
            const textHeight = chatInput.scrollHeight;

            // Jika tinggi teks melebihi batas tampilan, set tinggi maksimum dan aktifkan scroll
            if (textHeight > maxHeight) {
                chatInput.style.height = maxHeight + 'px';
                chatInput.style.overflowY = 'auto'; // Aktifkan scroll
            } else {
                chatInput.style.height = textHeight + 'px';
                chatInput.style.overflowY = 'hidden'; // Nonaktifkan scroll jika tidak diperlukan
            }
        }

        // Event listener untuk input
        chatInput.addEventListener('input', function(e) {
            adjustTextareaHeight();
        });

        // Event listener untuk paste
        chatInput.addEventListener('paste', function(e) {
            // Tunda eksekusi untuk mendapatkan teks yang di-paste
            setTimeout(() => {
                adjustTextareaHeight();
            }, 0);
        });

        // Event listener untuk keydown
        chatInput.addEventListener('keydown', function(e) {
            const lineHeight = 24;
            const padding = 32;
            const maxHeight = (lineHeight * 4) + padding;
            const textWidth = this.clientWidth - 172;

            // Cek apakah penambahan enter akan melebihi batas
            if (e.key === 'Enter' && !e.shiftKey) {
                const futureText = this.value.slice(0, this.selectionStart) + '\n' + this.value.slice(this
                    .selectionEnd);
                const futureHeight = getTextHeight(futureText, textWidth, lineHeight) + padding;

                if (futureHeight > maxHeight) {
                    e.preventDefault();
                }
            }
        });

        function showChangePasswordModal() {
            closeSettingsModal();
            document.getElementById('changePasswordModal').classList.remove('hidden');
            document.getElementById('changePasswordModal').classList.add('flex');
        }

        function closeChangePasswordModal() {
            document.getElementById('changePasswordModal').classList.add('hidden');
            document.getElementById('changePasswordModal').classList.remove('flex');
            openSettingsModal();
        }

        function showChangeNameModal() {
            closeSettingsModal();
            const modal = document.getElementById('changeNameModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function createUserMessageHtml(message) {
            return `
                <div class="flex justify-end gap-2 items-start mb-4">
                    <div class="flex flex-col items-end max-w-[75%]">
                        <div class="bg-[#24b0ba] text-white rounded-2xl px-4 py-2 inline-block">
                            <p class="break-words whitespace-pre-wrap">${message}</p>
                        </div>
                    </div>
                    <div class="w-10 h-10 bg-[#24b0ba] rounded-full flex items-center justify-center flex-shrink-0 overflow-hidden">
                        ${Auth.user.profile_photo 
                            ? `<img src="/storage/${Auth.user.profile_photo}" alt="Profile" class="w-full h-full object-cover">` 
                            : `<span class="text-white font-medium">${Auth.user.name.charAt(0).toUpperCase()}</span>`
                        }
                    </div>
                </div>
            `;
        }

        function createAIMessageHtml(message) {
            const timestamp = new Date().toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit'
            });

            return `
                <div class="flex justify-start gap-2 items-start mb-4">
                    <div class="w-10 h-10 bg-[#24b0ba] rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                        </svg>
                    </div>
                    <div class="flex flex-col max-w-[75%]">
                        <div class="bg-white border border-gray-200 rounded-2xl px-4 py-2 inline-block shadow-sm">
                            <p class="text-gray-800 break-words whitespace-pre-wrap">${message}</p>
                            <span class="text-xs text-gray-400 mt-1">${timestamp}</span>
                        </div>
                    </div>
                </div>
            `;
        }

        let chatToDelete = null;

        function showDeleteChatModal(chatId) {
            event.stopPropagation();
            chatToDelete = chatId;
            const modal = document.getElementById('deleteChatModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeDeleteChatModal() {
            const modal = document.getElementById('deleteChatModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            chatToDelete = null;
        }

        async function confirmDeleteChat() {
            if (!chatToDelete) return;

            try {
                const response = await fetch(`/chat/delete/${chatToDelete}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    }
                });

                if (!response.ok) {
                    throw new Error('Gagal menghapus chat');
                }

                // Update sidebar
                await updateSidebar();

                // Jika chat yang dihapus adalah chat yang sedang aktif
                if (window.currentChatId === chatToDelete) {
                    window.currentChatId = null;
                    document.getElementById('chatMessages').innerHTML = '';
                }

                closeDeleteChatModal();
            } catch (error) {
                console.error('Error deleting chat:', error);
                showErrorMessage('Gagal menghapus chat: ' + error.message);
            }
        }

        // Fungsi untuk memuat chat history berdasarkan chatId
        async function loadChat(chatId) {
            try {
                const response = await fetch(`/chat/${chatId}`); // Panggil rute /chat/{id}
                if (!response.ok) {
                    const data = await response.json();
                    throw new Error(data.message || 'Gagal memuat riwayat chat');
                }

                const data = await response.json();
                const messages = data.messages;
                const messagesContainer = document.getElementById('chatMessages');

                // Bersihkan tampilan chat messages
                messagesContainer.innerHTML = '';

                // Tampilkan pesan-pesan dari riwayat chat
                messages.forEach(messageData => {
                    const messageHtml = messageData.role === 'user' ?
                        createUserMessageHtml(messageData.content) :
                        createAIMessageHtml(messageData.content);
                    messagesContainer.insertAdjacentHTML('beforeend', messageHtml);
                });

                // Set currentChatId
                window.currentChatId = chatId;

                // Scroll ke bawah setelah memuat pesan
                messagesContainer.scrollTop = messagesContainer.scrollHeight;

            } catch (error) {
                console.error('Error loading chat:', error);
                showErrorMessage(error.message);
            }
        }


        // Menyesuaikan tinggi textarea saat input atau paste
        chatInput.addEventListener('input', adjustTextareaHeight);
        chatInput.addEventListener('paste', () => setTimeout(adjustTextareaHeight, 0));

        // Mengirim pesan saat tombol Enter ditekan
        chatInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                sendMessage();
            }
        });

        // Fungsi untuk modal change password
        function showChangePasswordModal() {
            closeSettingsModal();
            document.getElementById('changePasswordModal').classList.remove('hidden');
            document.getElementById('changePasswordModal').classList.add('flex');
        }

        function closeChangePasswordModal() {
            document.getElementById('changePasswordModal').classList.add('hidden');
            document.getElementById('changePasswordModal').classList.remove('flex');
            openSettingsModal();
        }

        // Fungsi untuk modal change name
        function showChangeNameModal() {
            closeSettingsModal();
            const modal = document.getElementById('changeNameModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }
    </script>
    <script src="{{ mix('js/translate.js') }}"></script>
</body>

</html>