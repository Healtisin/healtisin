<aside id="sidebar" class="h-screen w-auto bg-white flex flex-col">
    <div class="p-6 flex items-center justify-start bg-white">
        <a href="/" class="flex items-center">
            <img id="logoImage" src="{{ asset('images/logo.png') }}" alt="Logo" class="h-8 transition-all duration-300">
        </a>
    </div>

    <div class="flex-1 overflow-y-auto p-4" style="max-height: calc(100vh - 96px);">
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
        <h3 class="text-sm font-medium text-gray-500 mb-4 sidebar-text">Navigation</h3>
        <ul class="space-y-2">
            <li class="w-full text-left p-3 rounded-lg hover:bg-gray-100 transition-colors">
                <a href="{{ route('admin.users') }}" class="flex items-center gap-3">
                    <span class="w-8 h-8 flex items-center justify-center flex-shrink-0">
                        📊
                    </span>
                    <div class="flex-1 min-w-0 sidebar-text">
                        <p class="text-sm font-medium text-gray-900 truncate">Pengguna</p>
                    </div>
                </a>
            </li>
            <li class="w-full text-left p-3 rounded-lg hover:bg-gray-100 transition-colors">
                <a href="#" class="flex items-center gap-3">
                    <span class="w-8 h-8 flex items-center justify-center flex-shrink-0">
                        🏦
                    </span>
                    <div class="flex-1 min-w-0 sidebar-text">
                        <p class="text-sm font-medium text-gray-900 truncate">Pembayaran</p>
                    </div>
                </a>
            </li>
            <li class="w-full text-left p-3 rounded-lg hover:bg-gray-100 transition-colors">
                <a href="#" class="flex items-center gap-3">
                    <span class="w-8 h-8 flex items-center justify-center flex-shrink-0">
                        💳
                    </span>
                    <div class="flex-1 min-w-0 sidebar-text">
                        <p class="text-sm font-medium text-gray-900 truncate">Input Berita</p>
                    </div>
                </a>
            </li>
            <li class="w-full text-left p-3 rounded-lg hover:bg-gray-100 transition-colors">
                <a href="#" class="flex items-center gap-3">
                    <span class="w-8 h-8 flex items-center justify-center flex-shrink-0">
                        💸
                    </span>
                    <div class="flex-1 min-w-0 sidebar-text">
                        <p class="text-sm font-medium text-gray-900 truncate">Expenses Issued</p>
                    </div>
                </a>
            </li>
        </ul>
        <h3 class="text-sm font-medium text-gray-500 mt-3 mb-4 sidebar-text">Settings</h3>
        <ul class="space-y-2">
            <li class="w-full text-left p-3 rounded-lg hover:bg-gray-100 transition-colors">
                <a href="#" class="flex items-center gap-3">
                    <span class="w-8 h-8 flex items-center justify-center flex-shrink-0">
                        📅
                    </span>
                    <div class="flex-1 min-w-0 sidebar-text">
                        <p class="text-sm font-medium text-gray-900 truncate">Ganti Akun</p>
                    </div>
                </a>
            </li>
            <li class="w-full text-left p-3 rounded-lg hover:bg-gray-100 transition-colors">
                <a href="#" class="flex items-center gap-3">
                    <span class="w-8 h-8 flex items-center justify-center flex-shrink-0">
                        🏦
                    </span>
                    <div class="flex-1 min-w-0 sidebar-text">
                        <p class="text-sm font-medium text-gray-900 truncate">Delikt Card Account</p>
                    </div>
                </a>
            </li>
            <li class="w-full text-left p-3 rounded-lg hover:bg-gray-100 transition-colors">
                <a href="#" class="flex items-center gap-3">
                    <span class="w-8 h-8 flex items-center justify-center flex-shrink-0">
                        💳
                    </span>
                    <div class="flex-1 min-w-0 sidebar-text">
                        <p class="text-sm font-medium text-gray-900 truncate">Business Code</p>
                    </div>
                </a>
            </li>
            <li class="w-full text-left p-3 rounded-lg hover:bg-gray-100 transition-colors">
                <a href="#" class="flex items-center gap-3">
                    <span class="w-8 h-8 flex items-center justify-center flex-shrink-0">
                        📅
                    </span>
                    <div class="flex-1 min-w-0 sidebar-text">
                        <p class="text-sm font-medium text-gray-900 truncate">Trondos Activity</p>
                    </div>
                </a>
            </li>
            <li class="w-full text-left p-3 rounded-lg hover:bg-gray-100 transition-colors">
                <a href="#" class="flex items-center gap-3">
                    <span class="w-8 h-8 flex items-center justify-center flex-shrink-0">
                        🏦
                    </span>
                    <div class="flex-1 min-w-0 sidebar-text">
                        <p class="text-sm font-medium text-gray-900 truncate">Delikt Card Account</p>
                    </div>
                </a>
            </li>
            <li class="w-full text-left p-3 rounded-lg hover:bg-gray-100 transition-colors">
                <a href="#" class="flex items-center gap-3">
                    <span class="w-8 h-8 flex items-center justify-center flex-shrink-0">
                        💳
                    </span>
                    <div class="flex-1 min-w-0 sidebar-text">
                        <p class="text-sm font-medium text-gray-900 truncate">Business Code</p>
                    </div>
                </a>
            </li>
            <li class="w-full text-left p-3 rounded-lg hover:bg-gray-100 transition-colors">
                <a href="#" class="flex items-center gap-3">
                    <span class="w-8 h-8 flex items-center justify-center flex-shrink-0">
                        📅
                    </span>
                    <div class="flex-1 min-w-0 sidebar-text">
                        <p class="text-sm font-medium text-gray-900 truncate">Trondos Activity</p>
                    </div>
                </a>
            </li>
            <li class="w-full text-left p-3 rounded-lg hover:bg-gray-100 transition-colors">
                <a href="#" class="flex items-center gap-3">
                    <span class="w-8 h-8 flex items-center justify-center flex-shrink-0">
                        🏦
                    </span>
                    <div class="flex-1 min-w-0 sidebar-text">
                        <p class="text-sm font-medium text-gray-900 truncate">Delikt Card Account</p>
                    </div>
                </a>
            </li>
            <li class="w-full text-left p-3 rounded-lg hover:bg-gray-100 transition-colors">
                <a href="#" class="flex items-center gap-3">
                    <span class="w-8 h-8 flex items-center justify-center flex-shrink-0">
                        💳
                    </span>
                    <div class="flex-1 min-w-0 sidebar-text">
                        <p class="text-sm font-medium text-gray-900 truncate">Business Code Pembayarannnn</p>
                    </div>
                </a>
            </li>
        </ul>
    </div>
</aside>

<!-- <script>
document.addEventListener('DOMContentLoaded', function() {
    const logoAdmin = document.getElementById('logoAdmin');
    const navigation = document.getElementById('navigation');

    navigation.addEventListener('scroll', function() {
        if (navigation.scrollTop > 0) {
            logoAdmin.classList.add('shadow-md');
        } else {
            logoAdmin.classList.remove('shadow-md');
        }
    });
});
</script> -->