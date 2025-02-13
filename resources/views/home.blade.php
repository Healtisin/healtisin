<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home - Healtisin AI</title>
    @vite('resources/css/app.css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <style>
        /* Scrollbar untuk Webkit (Chrome, Safari, Edge) */
        #chatMessages::-webkit-scrollbar {
            width: 8px;
        }

        #chatMessages::-webkit-scrollbar-track {
            border-radius: 10px;           
            background-color: #f8f8f8;     /* Warna background lebih terang/samar */
            margin: 5px;                   
        }

        #chatMessages::-webkit-scrollbar-thumb {
            border-radius: 10px;           
            background: rgba(156, 163, 175, 0.5);  /* Warna thumb abu-abu transparan */
            border: 2px solid transparent; 
            background-clip: padding-box;  
            min-height: 50px;             
            transition: background .2s;    
        }

        #chatMessages::-webkit-scrollbar-thumb:hover {
            background: rgba(156, 163, 175, 0.7);  /* Warna hover sedikit lebih gelap */
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
    </style>
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
                        <input type="text" 
                               id="chatInput"
                               class="w-full px-4 py-5 pr-24 rounded-full border border-gray-300 focus:outline-none focus:border-[#24b0ba]" 
                               placeholder="Ketik pertanyaan Anda">
                        
                        <div class="absolute right-4 top-1/2 -translate-y-1/2 flex items-center gap-2">
                            <button class="p-2 text-gray-500 hover:text-gray-700">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                </svg>
                            </button>
                            <button class="p-2 text-gray-500 hover:text-gray-700">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z" />
                                </svg>
                            </button>
                            <button class="p-2 rounded-full bg-[#24b0ba] text-white hover:bg-[#1d8f98] transition-colors" onclick="sendMessage()">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
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

    <!-- JavaScript for modal functionality -->
    <script>
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

        async function sendMessage() {
            const input = document.getElementById('chatInput');
            const messagesContainer = document.getElementById('chatMessages');
            const message = input.value.trim();
            
            if (message) {
                // Tampilkan pesan user
                const userMessage = `
                    <div class="flex justify-end gap-2 items-start mb-4">
                        <div class="flex flex-col items-end max-w-[75%]">
                            <div class="bg-[#24b0ba] text-white rounded-2xl rounded-tr-none px-4 py-2 inline-block">
                                <p class="break-words whitespace-pre-wrap">${message}</p>
                            </div>
                        </div>
                        <div class="w-10 h-10 bg-[#24b0ba] rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-white font-medium">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </span>
                        </div>
                    </div>
                `;
                messagesContainer.insertAdjacentHTML('beforeend', userMessage);

                // Tampilkan indikator loading
                const loadingMessage = `
                    <div id="loadingMessage" class="flex justify-start gap-2 items-start mb-4">
                        <div class="w-10 h-10 bg-[#24b0ba] rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-white animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </div>
                        <div class="flex flex-col max-w-[75%]">
                            <div class="bg-white border border-gray-200 rounded-2xl rounded-tl-none px-4 py-2 inline-block shadow-sm">
                                <p class="text-gray-600">Sedang mengetik...</p>
                            </div>
                        </div>
                    </div>
                `;
                messagesContainer.insertAdjacentHTML('beforeend', loadingMessage);

                try {
                    const response = await fetch('/chat/send', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({ message })
                    });

                    const data = await response.json();
                    
                    // Hapus pesan loading
                    document.getElementById('loadingMessage').remove();

                    // Tampilkan respons AI
                    const aiResponse = `
                        <div class="flex justify-start gap-2 items-start mb-4">
                            <div class="w-10 h-10 bg-[#24b0ba] rounded-full flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                                </svg>
                            </div>
                            <div class="flex flex-col max-w-[75%]">
                                <div class="bg-white border border-gray-200 rounded-2xl rounded-tl-none px-4 py-2 inline-block shadow-sm">
                                    <p class="text-gray-800 break-words whitespace-pre-wrap">${data.message}</p>
                                </div>
                            </div>
                        </div>
                    `;
                    messagesContainer.insertAdjacentHTML('beforeend', aiResponse);
                } catch (error) {
                    console.error('Error:', error);
                    // Tampilkan pesan error
                    const errorMessage = `
                        <div class="flex justify-start gap-2 items-start mb-4">
                            <div class="w-10 h-10 bg-red-500 rounded-full flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="flex flex-col max-w-[75%]">
                                <div class="bg-red-50 border border-red-200 rounded-2xl rounded-tl-none px-4 py-2 inline-block shadow-sm">
                                    <p class="text-red-600">Maaf, terjadi kesalahan saat memproses pesan Anda.</p>
                                </div>
                            </div>
                        </div>
                    `;
                    messagesContainer.insertAdjacentHTML('beforeend', errorMessage);
                }

                // Bersihkan input dan scroll ke bawah
                input.value = '';
                messagesContainer.scrollTop = messagesContainer.scrollHeight;
            }
        }

        // Tambahkan event listener untuk tombol Enter
        document.getElementById('chatInput').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                sendMessage();
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
    </script>
</body>
</html>



