<aside id="sidebar" class="h-screen w-auto bg-white flex flex-col">
    <div class="p-6 flex items-center justify-start bg-white">
        <a href="/" class="flex items-center">
            <img id="logoImage" src="{{ asset('images/logo.png') }}" alt="Logo" class="h-8 transition-all duration-300">
        </a>
    </div>

    <div class="flex-1 overflow-y-auto p-4 scrollbar-hide" style="max-height: calc(100vh - 96px);">
        <ul class="space-y-2">
            <li class="w-full text-left p-3 rounded-lg hover:bg-gray-100 transition-colors">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                    <span class="w-8 h-8 flex items-center justify-center flex-shrink-0">
                        🏦
                    </span>
                    <div class="flex-1 min-w-0 sidebar-text">
                        <p class="text-sm font-medium text-gray-900 truncate">Dashboard</p>
                    </div>
                </a>
            </li>
        </ul>
        <!-- <h3 class="text-sm font-medium text-gray-500 mb-4 sidebar-text">Navigation</h3> -->
        <ul class="space-y-2">
            <li class="w-full text-left p-3 rounded-lg hover:bg-gray-100 transition-colors">
                <a href="{{ route('admin.users') }}" class="flex items-center gap-3">
                    <span class="w-8 h-8 flex items-center justify-center flex-shrink-0">
                        📊
                    </span>
                    <div class="flex-1 min-w-0 sidebar-text">
                        <p class="text-sm font-medium text-gray-900 truncate">Users</p>
                    </div>
                </a>
            </li>
            <li class="w-full text-left p-3 rounded-lg hover:bg-gray-100 transition-colors">
                <a href="{{ route('admin.transactions') }}" class="flex items-center gap-3">
                    <span class="w-8 h-8 flex items-center justify-center flex-shrink-0">
                        🏦
                    </span>
                    <div class="flex-1 min-w-0 sidebar-text">
                        <p class="text-sm font-medium text-gray-900 truncate">Transaction</p>
                    </div>
                </a>
            </li>
            <li class="w-full text-left rounded-lg">
                <button onclick="toggleWebsiteInfo()"
                    class="w-full p-3 hover:bg-gray-100 transition-colors rounded-lg cursor-pointer">
                    <div class="flex items-center gap-3">
                        <span class="w-8 h-8 flex items-center justify-center flex-shrink-0">
                            💳
                        </span>
                        <div class="flex-1 min-w-0 sidebar-text">
                            <p class="text-sm font-medium text-gray-900 truncate">Website Information</p>
                        </div>
                        <svg id="website-info-arrow" class="w-4 h-4 transition-transform duration-200"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </div>
                </button>

                <div id="website-info-dropdown" class="hidden pl-11 mt-1 space-y-2 transition-all duration-200">
                    <a href=""
                        class="block py-2 px-3 text-sm text-gray-700 hover:text-gray-900 hover:bg-gray-50 rounded-lg transition-colors">
                        Description
                    </a>
                    <a href=""
                        class="block py-2 px-3 text-sm text-gray-700 hover:text-gray-900 hover:bg-gray-50 rounded-lg transition-colors">
                        Footer
                    </a>
                    <a href=""
                        class="block py-2 px-3 text-sm text-gray-700 hover:text-gray-900 hover:bg-gray-50 rounded-lg transition-colors">
                        Meta Data
                    </a>
                    <a href=""
                        class="block py-2 px-3 text-sm text-gray-700 hover:text-gray-900 hover:bg-gray-50 rounded-lg transition-colors">
                        Logo
                    </a>
                </div>
            </li>
            <li class="w-full text-left p-3 rounded-lg hover:bg-gray-100 transition-colors">
                <a href="#" class="flex items-center gap-3">
                    <span class="w-8 h-8 flex items-center justify-center flex-shrink-0">
                        💸
                    </span>
                    <div class="flex-1 min-w-0 sidebar-text">
                        <p class="text-sm font-medium text-gray-900 truncate">API</p>
                    </div>
                </a>
            </li>
            <li class="w-full text-left p-3 rounded-lg hover:bg-gray-100 transition-colors">
                <a href="{{ route('admin.payments') }}" class="flex items-center gap-3">
                    <span class="w-8 h-8 flex items-center justify-center flex-shrink-0">
                        📅
                    </span>
                    <div class="flex-1 min-w-0 sidebar-text">
                        <p class="text-sm font-medium text-gray-900 truncate">Payment</p>
                    </div>
                </a>
            </li>
            <li class="w-full text-left p-3 rounded-lg hover:bg-gray-100 transition-colors">
                <a href="{{ route('admin.pricing') }}" class="flex items-center gap-3">
                    <span class="w-8 h-8 flex items-center justify-center flex-shrink-0">
                        📅
                    </span>
                    <div class="flex-1 min-w-0 sidebar-text">
                        <p class="text-sm font-medium text-gray-900 truncate">Pricing</p>
                    </div>
                </a>
            </li>
            <li class="w-full text-left p-3 rounded-lg hover:bg-gray-100 transition-colors">
                <a href="{{route('admin.messages')}}" class="flex items-center gap-3">
                    <span class="w-8 h-8 flex items-center justify-center flex-shrink-0">
                        📅
                    </span>
                    <div class="flex-1 min-w-0 sidebar-text">
                        <p class="text-sm font-medium text-gray-900 truncate">Messages</p>
                    </div>
                </a>
            </li>
            <li class="w-full text-left p-3 rounded-lg hover:bg-gray-100 transition-colors">
                <a href="#" class="flex items-center gap-3">
                    <span class="w-8 h-8 flex items-center justify-center flex-shrink-0">
                        📅
                    </span>
                    <div class="flex-1 min-w-0 sidebar-text">
                        <p class="text-sm font-medium text-gray-900 truncate">Berita</p>
                    </div>
                </a>
            </li>
            <li class="w-full text-left p-3 rounded-lg hover:bg-gray-100 transition-colors">
                <a href="#" class="flex items-center gap-3">
                    <span class="w-8 h-8 flex items-center justify-center flex-shrink-0">
                        📅
                    </span>
                    <div class="flex-1 min-w-0 sidebar-text">
                        <p class="text-sm font-medium text-gray-900 truncate">Log Detail</p>
                    </div>
                </a>
            </li>
        </ul>
    </div>
</aside>

<script>
    let isWebsiteInfoOpen = false;

    function toggleWebsiteInfo() {
        const dropdown = document.getElementById('website-info-dropdown');
        const arrow = document.getElementById('website-info-arrow');

        isWebsiteInfoOpen = !isWebsiteInfoOpen;

        if (isWebsiteInfoOpen) {
            dropdown.classList.remove('hidden');
            arrow.classList.add('rotate-180');
        } else {
            dropdown.classList.add('hidden');
            arrow.classList.remove('rotate-180');
        }
    }
</script>

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

    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }

    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>