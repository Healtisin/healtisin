<aside id="sidebar" class="bg-white border-r flex flex-col transition-all duration-300 w-80 relative">
    <!-- Toggle Button -->
    <button id="sidebarToggle" class="absolute -right-3 top-6 bg-white border rounded-full p-1 hover:bg-gray-100 z-10">
        <svg id="toggleIcon" class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
    </button>

    <!-- Logo -->
    <div class="p-6 border-b flex items-center justify-center">
        <a href="/" class="flex items-center">
            <img id="logoImage" src="{{ asset('images/logo.png') }}" alt="Logo" class="h-8 transition-all duration-300">
        </a>
    </div>

    <!-- New Chat Button -->
    <div class="p-4 border-b mt-auto">
        <button onclick="window.location.reload()" class="w-full text-left p-3 rounded-lg bg-[#24b0ba] hover:bg-[#1d8f98] transition-colors">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-white rounded-full flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-[#24b0ba]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-white">Chat Baru</p>
                </div>
            </div>
        </button>
    </div>

    <!-- Recent Chats -->
    <div class="flex-1 overflow-y-auto p-4">
        <h3 class="text-sm font-medium text-gray-500 mb-4 sidebar-text">Riwayat Chat</h3>
        <div class="space-y-2 max-h-[calc(100vh-21rem)] overflow-y-auto pr-2 chat-history">
            @foreach(Auth::user()->chatHistories()->latest('last_interaction')->get() as $history)
                <div class="relative group">
                    <button class="w-full text-left p-3 rounded-lg hover:bg-gray-100 transition-colors" 
                            onclick="loadChat({{ $history->id }})">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-[#24b0ba] rounded-full flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0 sidebar-text">
                                <p class="text-sm font-medium text-gray-900 truncate">{{ $history->title }}</p>
                                <p class="text-xs text-gray-400">{{ $history->last_interaction->diffForHumans() }}</p>
                            </div>
                        </div>
                    </button>
                    <button onclick="showDeleteChatModal({{ $history->id }})" 
                            class="absolute right-2 top-1/2 -translate-y-1/2 p-2 rounded-full hover:bg-red-50 text-red-500 opacity-0 group-hover:opacity-100 transition-opacity">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                    </button>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Profile Section -->
    <div class="p-4 border-t">
        <div class="w-full flex items-center gap-3 p-3 rounded-lg hover:bg-gray-100 transition-colors">
            <div class="w-10 h-10 bg-[#24b0ba] rounded-full flex items-center justify-center flex-shrink-0 overflow-hidden">
                @if(Auth::user()->profile_photo)
                    <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" 
                         alt="Profile photo" 
                         class="w-full h-full object-cover">
                @else
                    <span class="text-white font-medium">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </span>
                @endif
            </div>
            <div class="flex-1 min-w-0 sidebar-text">
                <p class="text-sm font-medium text-gray-900 truncate">{{ Auth::user()->name }}</p>
                <p class="text-sm text-gray-500 truncate">{{ Auth::user()->email }}</p>
            </div>
            <div class="flex items-center gap-2 sidebar-text">
                <button onclick="openSettingsModal()" class="p-2 hover:bg-gray-200 rounded-full">
                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </button>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="p-2 hover:bg-gray-200 rounded-full">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
</aside>

<style>
    /* Menyembunyikan scrollbar secara default */
    .chat-history {
        scrollbar-width: thin;
        scrollbar-color: transparent transparent;
    }

    .chat-history::-webkit-scrollbar {
        width: 6px;
    }

    .chat-history::-webkit-scrollbar-track {
        background: transparent;
    }

    .chat-history::-webkit-scrollbar-thumb {
        background-color: transparent;
        border-radius: 3px;
        transition: background-color 0.3s ease;
    }

    /* Menampilkan scrollbar saat hover */
    .chat-history:hover {
        scrollbar-color: rgba(156, 163, 175, 0.5) transparent;
    }

    .chat-history:hover::-webkit-scrollbar-thumb {
        background-color: rgba(156, 163, 175, 0.5);
    }

    .chat-history:hover::-webkit-scrollbar-thumb:hover {
        background-color: rgba(156, 163, 175, 0.7);
    }
</style>
