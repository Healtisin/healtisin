<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home - Healtisin AI</title>
    @include('partials.dark-mode-init')
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    @vite('resources/js/translate.js')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('lang.language-modal')
</head>

<body class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200 transition-colors duration-200">
    <div class="flex min-h-screen">
        <!-- Include Sidebar -->
        @include('partials.sidebar')

        <!-- Main Content -->
        <main class="flex-1">
            <div class="max-w-4xl mx-auto px-4 py-8">
                <!-- Chat Interface -->
                <div class="flex flex-col h-[calc(100vh-4rem)]">
                    <!-- Chat Messages -->
                    <div class="flex-1 overflow-y-auto mb-4 space-y-4 p-4 pr-2 dark:bg-gray-800 rounded-lg" id="chatMessages">
                        <!-- Welcome Message Template (hidden) -->
                        <div id="welcomeMessageTemplate" class="hidden">
                            <div class="flex flex-col gap-2 mb-4">
                                <div class="flex justify-start gap-2 items-start">
                                    <div class="w-10 h-10 bg-[#24b0ba] rounded-full flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                                        </svg>
                                    </div>
                                    <div class="flex flex-col max-w-[75%]">
                                        <div class="bg-white border border-gray-200 rounded-2xl px-4 py-2 inline-block shadow-sm">
                                            <div class="text-gray-800 break-words">
                                                <p><span data-translate="welcome-greeting">Hai {{ Auth::user()->name }}, saya Healtisin 👋</span></p>
                                                <p><span data-translate="welcome-intro">Saya adalah asisten AI kesehatan yang siap membantu Anda dengan informasi kesehatan umum.</span></p><br>
                                                <p><span data-translate="welcome-capabilities">⚕️ Saya dapat membantu Anda dengan:</span></p>
                                                <ul class="list-disc pl-5 space-y-0">
                                                    <li><span data-translate="welcome-cap-1">Skrining gejala dan keluhan kesehatan</span></li>
                                                    <li><span data-translate="welcome-cap-2">Informasi penyakit umum</span></li>
                                                    <li><span data-translate="welcome-cap-3">Tips kesehatan dan gaya hidup sehat</span></li>
                                                    <li><span data-translate="welcome-cap-4">Pertolongan pertama dasar</span></li>
                                                    <li><span data-translate="welcome-cap-5">Informasi nutrisi dan diet sehat</span></li>
                                                </ul><br>
                                                <p><span data-translate="welcome-important">⚠️ Penting untuk diingat:</span></p>
                                                <ul class="list-disc pl-5 space-y-0">
                                                    <li><span data-translate="welcome-imp-1">Saya TIDAK memberikan diagnosis medis</span></li>
                                                    <li><span data-translate="welcome-imp-2">Saya TIDAK meresepkan obat</span></li>
                                                    <li><span data-translate="welcome-imp-3">Saya TIDAK menggantikan konsultasi dokter</span></li>
                                                    <li><span data-translate="welcome-imp-4">Untuk kondisi serius, segera kunjungi fasilitas kesehatan</span></li>
                                                </ul>
                                                <p><span data-translate="welcome-ask">Silakan ceritakan keluhan atau pertanyaan kesehatan Anda.</span></p>
                                            </div>
                                            <div class="flex items-center mt-2">
                                                <span class="text-xs text-gray-400">{{ now()->toTimeString('minute') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                            <button id="start-record-btn" class="p-2 text-gray-500 hover:text-gray-700">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z" />
                                </svg>
                            </button>
                            <button id="sendButton"
                                class="p-2 rounded-full bg-[#24b0ba] text-white hover:bg-[#1d8f98] transition-colors"
                                onclick="handleSendButtonClick()">
                                <svg id="sendIcon" class="w-5 h-5 transform rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                </svg>
                                <svg id="cancelIcon" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
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
        document.getElementById('start-record-btn').addEventListener('click', function() {
            const recognition = new(window.SpeechRecognition || window.webkitSpeechRecognition)();
            recognition.lang = 'id-ID'; // Atur bahasa sesuai kebutuhan

            recognition.start();

            recognition.onresult = function(event) {
                const transcript = event.results[0][0].transcript;
                document.getElementById('chatInput').value = transcript;
                sendMessage();
            };

            recognition.onerror = function(event) {
                console.error('Error occurred in recognition: ' + event.error);
            };
        });

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

        let isWaitingForResponse = false;
        let currentRequest = null;
        let messageBeingCancelled = false; // Flag untuk menandai proses pembatalan

        // Tambahkan variabel untuk mode edit
        let isEditing = false;
        let editingMessageId = null;
        let originalMessage = '';

        function handleSendButtonClick() {
            if (isWaitingForResponse) {
                // Set flag pembatalan
                messageBeingCancelled = true;
                
                // Cancel request
                if (currentRequest) {
                    currentRequest.abort();
                }
                
                // Remove loading message
                const loadingElement = document.getElementById('loadingMessage');
                if (loadingElement) {
                    loadingElement.remove();
                }
                
                // Kembalikan pesan terakhir ke chat input
                const lastUserMessage = document.querySelector('#chatMessages > div:last-of-type:not(#loadingMessage)');
                if (lastUserMessage && lastUserMessage.classList.contains('justify-end')) {
                    // Ambil teks pesan dari elemen terakhir
                    const messageText = lastUserMessage.querySelector('p').textContent;
                    
                    // Masukkan kembali ke chat input
                    document.getElementById('chatInput').value = messageText;
                    adjustTextareaHeight();
                    
                    // Hapus pesan yang dibatalkan dari chat
                    lastUserMessage.remove();
                    
                    // Hapus pesan dari database jika ada chatId
                    if (window.currentChatId) {
                        deleteLastMessage(window.currentChatId);
                    }
                }
                
                // Reset button state
                toggleSendButton(false);
                
                // Show notification
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });

                Toast.fire({
                    icon: 'info',
                    title: 'Permintaan dibatalkan'
                });
                
                // Reset flag pembatalan setelah semua proses selesai
                setTimeout(() => {
                    messageBeingCancelled = false;
                }, 500);
            } else {
                // Send message
                sendMessage();
            }
        }

        function toggleSendButton(isWaiting) {
            const sendIcon = document.getElementById('sendIcon');
            const cancelIcon = document.getElementById('cancelIcon');
            const sendButton = document.getElementById('sendButton');
            
            isWaitingForResponse = isWaiting;
            
            if (isWaiting) {
                sendIcon.classList.add('hidden');
                cancelIcon.classList.remove('hidden');
                sendButton.classList.remove('bg-[#24b0ba]', 'hover:bg-[#1d8f98]');
                sendButton.classList.add('bg-red-500', 'hover:bg-red-600');
            } else {
                sendIcon.classList.remove('hidden');
                cancelIcon.classList.add('hidden');
                sendButton.classList.add('bg-[#24b0ba]', 'hover:bg-[#1d8f98]');
                sendButton.classList.remove('bg-red-500', 'hover:bg-red-600');
            }
        }

        async function sendMessage() {
            const input = document.getElementById('chatInput');
            const messagesContainer = document.getElementById('chatMessages');
            const message = input.value.trim();

            if (message) {
                // Jika sedang mode edit
                if (isEditing && editingMessageId) {
                    // Jika pesan tidak berubah, batalkan edit
                    if (message === originalMessage) {
                        cancelEditMode(editingMessageId.querySelector('button[title="Batal edit"]'));
                        return;
                    }
                    
                    // Hapus pesan lama dari tampilan
                    const oldMessageText = editingMessageId.querySelector('p');
                    if (oldMessageText) {
                        oldMessageText.textContent = message;
                    }
                    
                    // Reset input dan mode edit
                    input.value = '';
                    adjustTextareaHeight();
                    
                    // Hapus respons AI setelah pesan yang diedit
                    const allMessages = document.querySelectorAll('#chatMessages > div');
                    const editedIndex = Array.from(allMessages).indexOf(editingMessageId);
                    
                    // Hapus semua pesan setelah pesan yang diedit (respons AI)
                    if (editedIndex >= 0 && editedIndex < allMessages.length - 1) {
                        for (let i = allMessages.length - 1; i > editedIndex; i--) {
                            allMessages[i].remove();
                        }
                    }
                    
                    // Tambahkan loading message
                    messagesContainer.insertAdjacentHTML('beforeend', loadingMessage);
                    
                    // Change button to cancel
                    toggleSendButton(true);
                    
                    // Kirim ke server jika ada chat ID
                    if (window.currentChatId) {
                        try {
                            const response = await fetch('/chat/edit-message', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                    'Accept': 'application/json'
                                },
                                body: JSON.stringify({
                                    chatId: window.currentChatId,
                                    messageIndex: getMessageIndex(editingMessageId),
                                    newContent: message
                                })
                            });
                            
                            if (!response.ok) {
                                throw new Error('Gagal mengedit pesan');
                            }
                            
                            const data = await response.json();
                            
                            // Hapus loading message
                            const loadingElement = document.getElementById('loadingMessage');
                            if (loadingElement) {
                                loadingElement.remove();
                            }
                            
                            // Tambahkan respons AI baru jika ada
                            if (data.aiResponse) {
                                const aiResponse = createAIMessageHtml(data.aiResponse);
                                messagesContainer.insertAdjacentHTML('beforeend', aiResponse);
                            }
                            
                            // Reset status tombol kirim
                            toggleSendButton(false);
                            
                            // Scroll ke bawah
                            scrollToBottom(messagesContainer);
                            
                        } catch (error) {
                            console.error('Error editing message:', error);
                            showErrorMessage(error.message);
                            toggleSendButton(false);
                        }
                    }
                    
                    // Reset mode edit
                    const editButton = editingMessageId.querySelector('button[title="Batal edit"]');
                    if (editButton) {
                        cancelEditMode(editButton);
                    } else {
                        isEditing = false;
                        editingMessageId = null;
                        originalMessage = '';
                    }
                    
                    return;
                }
                
                // Proses pengiriman pesan normal (tidak dalam mode edit)
                input.value = '';
                adjustTextareaHeight();

                // Add user message
                const userMessage = createUserMessageHtml(message);
                messagesContainer.insertAdjacentHTML('beforeend', userMessage);

                // Add loading message
                messagesContainer.insertAdjacentHTML('beforeend', loadingMessage);
                
                // Change button to cancel
                toggleSendButton(true);

                try {
                    const controller = new AbortController();
                    currentRequest = controller;
                    
                    if (messageBeingCancelled) {
                        throw new Error('AbortError');
                    }
                    
                    const response = await fetch('/chat/send', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            message: message,
                            chatId: window.currentChatId
                        }),
                        signal: controller.signal
                    });

                    // Remove loading message
                    const loadingElement = document.getElementById('loadingMessage');
                    if (loadingElement) {
                        loadingElement.remove();
                    }
                    
                    toggleSendButton(false);
                    
                    if (messageBeingCancelled) {
                        throw new Error('AbortError');
                    }

                    if (!response.ok) {
                        const data = await response.json();
                        throw new Error(data.message || 'Terjadi kesalahan saat memproses pesan');
                    }

                    const data = await response.json();
                    
                    if (messageBeingCancelled) {
                        if (!window.currentChatId && data.chatId) {
                            await fetch(`/chat/delete/${data.chatId}`, {
                                method: 'DELETE',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                                }
                            });
                        }
                        throw new Error('AbortError');
                    }

                    // Add AI response
                    const aiResponse = createAIMessageHtml(data.message);
                    messagesContainer.insertAdjacentHTML('beforeend', aiResponse);

                    // Update currentChatId
                    if (!window.currentChatId && data.chatId) {
                        window.currentChatId = data.chatId;
                        
                        // Update sidebar tanpa reload
                        if (data.chatHistory) {
                            addNewChatToSidebar(data.chatHistory);
                        }
                    }

                    scrollToBottom(messagesContainer);

                } catch (error) {
                    toggleSendButton(false);
                    
                    if (error.name !== 'AbortError' && error.message !== 'AbortError') {
                        console.error('Error:', error);
                        showErrorMessage(error.message);
                    } else {
                        console.log('Permintaan dibatalkan');
                        
                        if (window.currentChatId) {
                            deleteLastMessage(window.currentChatId);
                        }
                    }
                }
            }

            // Setelah menambahkan pesan baru
            updateScrollbars();
        }

        // Tambahkan fungsi untuk menambah chat baru ke sidebar
        function addNewChatToSidebar(chatData) {
            const chatHistoryContainer = document.querySelector('.chat-history');
            const newChatHtml = `
                <div class="relative group">
                    <button class="w-full text-left p-3 rounded-lg hover:bg-gray-100 transition-colors"
                        onclick="loadChat(${chatData.id})">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-[#24b0ba] rounded-full flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0 sidebar-text">
                                <p class="text-sm font-medium text-gray-900 truncate">${chatData.title}</p>
                                <p class="text-xs text-gray-400">${chatData.last_interaction}</p>
                            </div>
                        </div>
                    </button>
                    <button onclick="showDeleteChatModal(${chatData.id})"
                        class="absolute right-2 top-1/2 -translate-y-1/2 p-2 rounded-full hover:bg-red-50 text-red-500 opacity-0 group-hover:opacity-100 transition-opacity">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </button>
                </div>
            `;
            chatHistoryContainer.insertAdjacentHTML('afterbegin', newChatHtml);
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
            scrollToBottom(messagesContainer);
            updateScrollbars();
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
                    console.error('Gagal memperbarui sidebar:', response.status);
                    return;
                }
                const html = await response.text();
                const chatHistoryContainer = document.querySelector('.chat-history');
                if (chatHistoryContainer) {
                    chatHistoryContainer.innerHTML = html;

                    // Tambahkan event listeners untuk tombol chat
                    const chatButtons = chatHistoryContainer.querySelectorAll('.relative button:first-child');
                    chatButtons.forEach(button => {
                        const chatId = button.getAttribute('onclick')?.match(/\d+/)?.[0];
                        if (chatId) {
                            button.onclick = () => loadChat(parseInt(chatId));
                        }
                    });

                    // Tambahkan event listeners untuk tombol hapus
                    const deleteButtons = chatHistoryContainer.querySelectorAll('.relative button:last-child');
                    deleteButtons.forEach(button => {
                        const chatId = button.getAttribute('onclick')?.match(/\d+/)?.[0];
                        if (chatId) {
                            button.onclick = (e) => {
                                e.stopPropagation(); // Hentikan event bubbling
                                showDeleteChatModal(parseInt(chatId));
                            };
                        }
                    });
                }
            } catch (error) {
                console.error('Error updating sidebar:', error);
            }

            // Setelah update sidebar
            updateScrollbars();
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
                const futureText = this.value.slice(0, this.selectionStart) + '\n' + this.value.slice(this.selectionEnd);
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
            const timestamp = message.timestamp ? new Date(message.timestamp).toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit'
            }) : new Date().toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit'
            });

            return `
                <div class="flex flex-col gap-2 mb-4">
                    <div class="flex justify-end gap-2 items-start">
                        <div class="flex flex-col items-end max-w-[75%]">
                            <div class="bg-[#24b0ba] text-white rounded-2xl px-4 py-2 inline-block">
                                <div class="flex flex-col">
                                    <p class="break-words whitespace-pre-wrap">${message.content || message}</p>
                                    <div class="flex justify-end">
                                        <span class="text-xs text-white/70 mt-1">${timestamp}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-10 h-10 bg-[#24b0ba] rounded-full flex items-center justify-center flex-shrink-0 overflow-hidden">
                            ${Auth.user.profile_photo 
                                ? `<img src="/storage/${Auth.user.profile_photo}" alt="Profile" class="w-full h-full object-cover">` 
                                : `<span class="text-white font-medium">${Auth.user.name.charAt(0).toUpperCase()}</span>`
                            }
                        </div>
                    </div>
                    <div class="flex justify-end mr-14">
                        <button onclick="copyMessage(this.closest('.flex.flex-col.gap-2').querySelector('p').textContent)" 
                            class="text-[#24b0ba] hover:text-[#1d8f98] p-1 rounded-full hover:bg-gray-100 transition-colors"
                            title="Salin pesan">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                            </svg>
                        </button>
                        <button onclick="editUserMessage(this)" 
                            class="text-[#24b0ba] hover:text-[#1d8f98] p-1 rounded-full hover:bg-gray-100 transition-colors"
                            title="Edit message">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </button>
                    </div>
                </div>
            `;
        }

        function createAIMessageHtml(message) {
            const timestamp = message.timestamp ? new Date(message.timestamp).toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit'
            }) : new Date().toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit'
            });

            // Cek apakah ini pesan pembuka
            const isWelcomeMessage = (message.content || message)?.includes('Hai') && 
                                    (message.content || message)?.includes('saya Healtisin') && 
                                    (message.content || message)?.includes('Saya dapat membantu Anda dengan:');
            
            return `
                <div class="flex flex-col gap-2 mb-4">
                    <div class="flex justify-start gap-2 items-start">
                        <div class="w-10 h-10 bg-[#24b0ba] rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                            </svg>
                        </div>
                        <div class="flex flex-col max-w-[75%]">
                            <div class="bg-white border border-gray-200 rounded-2xl px-4 py-2 inline-block shadow-sm">
                                <p class="text-gray-800 break-words whitespace-pre-wrap">${message.content || message}</p>
                                <div class="flex items-center mt-2">
                                    <span class="text-xs text-gray-400">${timestamp}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    ${!isWelcomeMessage ? `
                        <div class="flex justify-start ml-14">
                            <button onclick="copyMessage(this.closest('.flex.flex-col.gap-2').querySelector('p').textContent)" 
                                class="text-[#24b0ba] hover:text-[#1d8f98] p-1 rounded-full hover:bg-gray-100 transition-colors"
                                title="Salin pesan">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                                </svg>
                            </button>
                            <button onclick="regenerateResponse()" 
                                class="text-[#24b0ba] hover:text-[#1d8f98] p-1 rounded-full hover:bg-gray-100 transition-colors"
                                title="Regenerate response">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                            </button>
                        </div>
                    ` : ''}
                </div>
            `;
        }

        let chatToDelete = null;

        function showDeleteChatModal(chatId) {
            chatToDelete = chatId;

            Swal.fire({
                title: 'Hapus Chat?',
                text: "Anda tidak dapat mengembalikan chat yang sudah dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    confirmDeleteChat();
                }
            });
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

                const data = await response.json();

                if (!response.ok) {
                    throw new Error(data.message || 'Gagal menghapus chat');
                }

                // Hapus elemen chat dari sidebar secara langsung
                const chatElement = document.querySelector(`button[onclick="loadChat(${chatToDelete})"]`).closest('.relative');
                if (chatElement) {
                    chatElement.remove();
                }

                // Jika chat yang dihapus adalah chat yang sedang aktif
                if (window.currentChatId === chatToDelete) {
                    window.currentChatId = null;
                    document.getElementById('chatMessages').innerHTML = '';
                }

                // Tampilkan notifikasi sukses SEBELUM update sidebar
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });

                Toast.fire({
                    icon: 'success',
                    title: 'Chat berhasil dihapus'
                });

                // Update sidebar untuk memastikan sinkronisasi data
                updateSidebar();

            } catch (error) {
                console.error('Error deleting chat:', error);
                showErrorMessage(error.message);
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
                        createUserMessageHtml(messageData) :
                        createAIMessageHtml(messageData);
                    messagesContainer.insertAdjacentHTML('beforeend', messageHtml);
                });

                // Set currentChatId
                window.currentChatId = chatId;

                // Scroll ke bawah setelah memuat pesan
                scrollToBottom(messagesContainer);

            } catch (error) {
                console.error('Error loading chat:', error);
                showErrorMessage(error.message);
            }

            // Setelah memuat chat history
            updateScrollbars();
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

        // Fungsi untuk menghapus pesan terakhir dari database
        async function deleteLastMessage(chatId) {
            try {
                const response = await fetch(`/chat/delete-last-message/${chatId}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    }
                });
                
                if (!response.ok) {
                    const data = await response.json();
                    throw new Error(data.message || 'Gagal menghapus pesan terakhir');
                }
                
                const data = await response.json();
                
                // Jika chat dihapus sepenuhnya, reset currentChatId
                if (data.chatDeleted) {
                    window.currentChatId = null;
                }
                
                // Update sidebar setelah pesan dihapus
                await updateSidebar();
                
            } catch (error) {
                console.error('Error deleting last message:', error);
            }
        }

        // Tampilkan pesan pembuka saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            const messagesContainer = document.getElementById('chatMessages');
            
            // Menggunakan template yang sudah ada di HTML
            const welcomeTemplate = document.getElementById('welcomeMessageTemplate');
            
            if (welcomeTemplate) {
                // Clone template welcome message
                const welcomeMsg = welcomeTemplate.cloneNode(true);
                welcomeMsg.classList.remove('hidden');
                welcomeMsg.removeAttribute('id');
                
                // Tambahkan ke container pesan
                messagesContainer.appendChild(welcomeMsg);
                
                // Terapkan terjemahan pada pesan selamat datang
                if (typeof applyTranslation === 'function') {
                    applyTranslation();
                }
            }
        });

        async function regenerateResponse() {
            if (isWaitingForResponse) return;
            
            try {
                // Cek apakah ada chat history
                if (!window.currentChatId) {
                    throw new Error('Tidak dapat meregenerasi pesan pembuka');
                }
                
                // Ambil semua pesan dalam chat
                const messages = document.querySelectorAll('#chatMessages > div');
                let lastUserMessage = null;
                let lastAiMessage = null;
                
                // Cari pesan user terakhir dan pesan AI terakhir
                for (let i = messages.length - 1; i >= 0; i--) {
                    const message = messages[i];
                    if (!lastAiMessage && !message.querySelector('.flex.justify-end')) {
                        lastAiMessage = message;
                    } else if (!lastUserMessage && message.querySelector('.flex.justify-end')) {
                        lastUserMessage = message;
                        break;
                    }
                }
                
                if (!lastUserMessage) {
                    throw new Error('Tidak dapat menemukan pesan terakhir user');
                }
                
                const messageText = lastUserMessage.querySelector('p').textContent;
                
                // Hapus pesan AI terakhir jika ada
                if (lastAiMessage) {
                    lastAiMessage.remove();
                }
                
                // Tambahkan loading message
                const messagesContainer = document.getElementById('chatMessages');
                messagesContainer.insertAdjacentHTML('beforeend', loadingMessage);
                
                // Set status menunggu
                toggleSendButton(true);
                
                // Kirim request regenerate
                const response = await fetch('/chat/regenerate', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        message: messageText,
                        chatId: window.currentChatId
                    })
                });

                if (!response.ok) {
                    const data = await response.json();
                    throw new Error(data.message || 'Gagal meregenerasi jawaban');
                }

                const data = await response.json();
                
                // Hapus loading message
                const loadingElement = document.getElementById('loadingMessage');
                if (loadingElement) {
                    loadingElement.remove();
                }
                
                // Tambahkan respons baru
                const aiResponse = createAIMessageHtml(data.message);
                messagesContainer.insertAdjacentHTML('beforeend', aiResponse);
                
                // Reset status
                toggleSendButton(false);
                
                // Scroll ke bawah
                scrollToBottom(messagesContainer);

            } catch (error) {
                console.error('Error regenerating response:', error);
                showErrorMessage(error.message);
                toggleSendButton(false);
            }
        }

        function editUserMessage(button) {
            const messageContainer = button.closest('.flex.flex-col.gap-2');
            const messageText = messageContainer.querySelector('p').textContent;
            const messageElement = messageContainer.closest('#chatMessages > div');
            
            // Simpan pesan asli
            originalMessage = messageText;
            
            // Masukkan pesan ke input
            document.getElementById('chatInput').value = messageText;
            adjustTextareaHeight();
            
            // Set state editing
            isEditing = true;
            editingMessageId = messageElement;
            
            // Ubah tombol edit menjadi tombol batal
            button.innerHTML = `
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            `;
            button.title = "Batal edit";
            button.onclick = function() { cancelEditMode(button); };
            
            // Fokus ke input
            document.getElementById('chatInput').focus();
        }

        function cancelEditMode(button) {
            // Reset input
            document.getElementById('chatInput').value = '';
            adjustTextareaHeight();
            
            // Reset state editing
            isEditing = false;
            editingMessageId = null;
            originalMessage = '';
            
            // Kembalikan tombol ke bentuk edit
            button.innerHTML = `
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
            `;
            button.title = "Edit message";
            button.onclick = function() { editUserMessage(button); };
        }

        function getMessageIndex(messageElement) {
            const messages = document.querySelectorAll('#chatMessages > div');
            return Array.from(messages).indexOf(messageElement);
        }

        // Tambahkan fungsi copyMessage untuk menyalin pesan
        function copyMessage(text) {
            // Tambahkan footer pesan
            const textToCopy = text + "\n\nDibuat oleh: Healtisin";
            
            // Gunakan Clipboard API untuk menyalin teks
            navigator.clipboard.writeText(textToCopy)
                .then(() => {
                    // Tampilkan notifikasi berhasil menggunakan SweetAlert2
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        iconColor: '#24b0ba'
                    });
                    
                    Toast.fire({
                        icon: 'success',
                        title: 'Teks berhasil disalin!'
                    });
                })
                .catch(err => {
                    console.error('Gagal menyalin teks: ', err);
                    showErrorMessage('Gagal menyalin teks');
                });
        }

        function updateScrollbars() {
            // Update chat messages scrollbar
            if (window.chatMessagesPS) {
                window.chatMessagesPS.update();
            }
            
            // Update chat history scrollbar
            if (window.chatHistoryPS) {
                window.chatHistoryPS.update();
            }
        }

        function scrollToBottom(element) {
            element.scrollTop = element.scrollHeight;
            if (window.chatMessagesPS) {
                window.chatMessagesPS.update();
            }
        }

        // Inisialisasi Perfect Scrollbar
        document.addEventListener('DOMContentLoaded', function() {
            // Tambahkan padding untuk memberi jarak antara scrollbar dan konten
            const chatMessages = document.getElementById('chatMessages');
            if (chatMessages) {
                // Tambahkan padding kanan untuk memberi jarak
                chatMessages.style.paddingRight = '16px';
                
                // Pastikan posisi relative agar Perfect Scrollbar bekerja dengan baik
                chatMessages.style.position = 'relative';
                
                // Inisialisasi Perfect Scrollbar dengan konfigurasi khusus
                window.chatMessagesPS = new PerfectScrollbar(chatMessages, {
                    wheelSpeed: 1,
                    wheelPropagation: true,
                    minScrollbarLength: 20,
                    suppressScrollX: true,
                    // Geser scrollbar ke kanan sedikit
                    scrollbarYMarginRight: 8
                });
            }
            
            const chatHistory = document.querySelector('.chat-history');
            if (chatHistory) {
                chatHistory.style.position = 'relative';
                chatHistory.style.paddingRight = '16px';
                window.chatHistoryPS = new PerfectScrollbar(chatHistory, {
                    wheelSpeed: 1,
                    wheelPropagation: false,
                    minScrollbarLength: 20,
                    suppressScrollX: true
                });
            }
            
            // Update scrollbar setelah inisialisasi
            updateScrollbars();
        });

        // Perbarui scrollbar saat ukuran window berubah
        window.addEventListener('resize', function() {
            updateScrollbars();
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>

