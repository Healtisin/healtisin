<aside id="sidebar" class="bg-white dark:bg-gray-800 border-r dark:border-gray-700 flex flex-col transition-all duration-300 w-80 fixed md:relative h-full z-40 transform -translate-x-full md:translate-x-0">
    <!-- Toggle Button -->
    <button id="sidebarToggle" class="absolute -right-3 top-6 bg-white dark:bg-gray-800 border dark:border-gray-700 rounded-full p-1 hover:bg-gray-100 dark:hover:bg-gray-700 z-10 hidden md:block">
        <svg id="toggleIcon" class="w-4 h-4 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
    </button>

    <!-- Close Button (Visible only on mobile) -->
    <button id="closeSidebar" class="absolute top-4 right-4 p-2 text-gray-500 hover:text-gray-700 md:hidden">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>

    <!-- Logo -->
    <div class="p-6 border-b dark:border-gray-700 flex items-center justify-center">
        <a href="/" class="flex items-center">
            <img id="logoImage" src="{{ asset('images/logo.png') }}" alt="Logo" class="h-8 transition-all duration-300">
        </a>
    </div>

    <!-- New Chat Button -->
    <div class="p-4 border-b dark:border-gray-700 mt-auto">
        <button onclick="window.location.reload()"
            class="w-full text-left p-3 rounded-lg bg-[#24b0ba] dark:bg-[#24b0ba]/80 hover:bg-[#1d8f98] dark:hover:bg-[#73c7e3]/80 transition-colors">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-white dark:bg-gray-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-[#24b0ba]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-white sidebar-text">Chat Baru</p>
                </div>
            </div>
        </button>
    </div>

    <!-- Recent Chats -->
    <div class="flex-1 overflow-y-auto p-4">
        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-300 mb-4 sidebar-text">Riwayat Chat</h3>
        <div class="space-y-2 max-h-[calc(100vh-21rem)] overflow-y-auto pr-2 chat-history">
            @foreach(Auth::user()->chatHistories()->latest('last_interaction')->get() as $history)
            <div class="relative group">
                <button class="w-full text-left p-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700/50 transition-colors"
                    onclick="loadChat({{ $history->id }})">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-[#24b0ba] dark:bg-[#24b0ba]/80 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0 sidebar-text">
                            <p class="text-sm font-medium text-gray-900 dark:text-gray-100 truncate">{{ $history->title }}</p>
                            <p class="text-xs text-gray-400 dark:text-gray-500">{{ $history->last_interaction->diffForHumans() }}</p>
                        </div>
                    </div>
                </button>
                <button onclick="showDeleteChatModal({{ $history->id }})"
                    class="absolute right-2 top-1/2 -translate-y-1/2 p-2 rounded-full hover:bg-red-50 dark:hover:bg-red-900/20 text-red-500 dark:text-red-400 opacity-0 group-hover:opacity-100 transition-opacity">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </button>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Profile Section -->
    <div class="p-4 border-t dark:border-gray-700">
        <div class="w-full flex flex-col gap-3">
            <!-- User Info -->
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-[#24b0ba] dark:bg-[#24b0ba]/80 rounded-full flex items-center justify-center flex-shrink-0 overflow-hidden relative group profile-photo-container">
                    @if(Auth::user()->profile_photo)
                    <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="Profile photo"
                        class="w-full h-full object-cover">
                    <button type="button" 
                            onclick="showDeletePhotoConfirmation()"
                            class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                        <span class="p-1 text-white hover:text-red-500" title="Hapus Foto">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </span>
                    </button>
                    @else
                    <span class="text-white font-medium">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </span>
                    @endif
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900 dark:text-gray-100 truncate">{{ Auth::user()->name }}</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400 truncate">{{ Auth::user()->email }}</p>
                </div>
            </div>
            
            <!-- Action Buttons -->
            <div class="flex items-center justify-between px-2 pt-2 border-t dark:border-gray-700">
                <div class="flex items-center gap-1">
                    <button onclick="toggleLanguage()" class="p-2 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-full" title="Ganti Bahasa">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129" />
                        </svg>
                    </button>
                    <button onclick="toggleTheme()" class="p-2 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-full" title="Ganti Tema">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400 block dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                        </svg>
                    </button>
                </div>
                <div class="flex items-center gap-1">
                    <button onclick="openSettingsModal()" class="p-2 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-full" title="Pengaturan">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </button>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="p-2 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-full" title="Keluar">
                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</aside>

<div id="sidebarOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 hidden md:hidden"></div>

<!-- Mobile Sidebar Toggle Button (Visible only on mobile) -->
<button id="mobileSidebarToggle" class="fixed bottom-4 right-4 z-50 bg-[#24b0ba] text-white p-3 rounded-full shadow-lg md:hidden">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
    </svg>
</button>

<style>
.rotate-180 {
    transform: rotate(180deg);
}

.transition-all {
    transition: all 0.3s ease;
}

.hidden {
    display: none;
}

.active {
    background-color: #24b0ba !important;
    color: white !important;
}

/* Tambahkan style untuk sidebar minimized */
#sidebar.minimized {
    width: 5rem;
}

#sidebar.minimized .sidebar-text {
    display: none;
}

#sidebar.minimized #logoImage {
    width: 2rem;
}

.active .sidebar-text p {
    color: white !important;
}

/* Dark mode styles */
.dark .active {
    background-color: rgba(36, 176, 186, 0.8) !important;
}

/* Mobile sidebar styles */
@media (max-width: 768px) {
    #sidebar {
        width: 85%;
        max-width: 300px;
    }
    
    #sidebar.open {
        transform: translateX(0);
    }
}
</style>

<script>
// ... existing JavaScript code remains unchanged ...

document.addEventListener('DOMContentLoaded', function() {
    const mobileSidebarToggle = document.getElementById('mobileSidebarToggle');
    const closeSidebar = document.getElementById('closeSidebar');
    const sidebar = document.getElementById('sidebar');
    const sidebarOverlay = document.getElementById('sidebarOverlay');
    
    mobileSidebarToggle.addEventListener('click', function() {
        sidebar.classList.add('open');
        sidebarOverlay.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    });
    
    closeSidebar.addEventListener('click', function() {
        sidebar.classList.remove('open');
        sidebarOverlay.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    });
    
    sidebarOverlay.addEventListener('click', function() {
        sidebar.classList.remove('open');
        sidebarOverlay.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    });
    
    // ... existing JavaScript code remains unchanged ...
});
</script>
