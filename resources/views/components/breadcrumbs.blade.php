@php
$currentRoute = Route::currentRouteName();

// Gunakan $route_name jika tersedia
if (isset($route_name)) {
    $currentRoute = $route_name;
}

$breadcrumbs = [
'admin.dashboard' => ['Home', 'Dashboard'],
'admin.users' => ['Home', 'Pengguna'],
'admin.users.create' => ['Home', 'Pengguna', 'Tambah Pengguna'],
'admin.users.edit' => ['Home', 'Pengguna', 'Edit Pengguna'],
'admin.transactions' => ['Home', 'Transaksi'],
'admin.payments' => ['Home', 'Pembayaran'],
'admin.pricing' => ['Home', 'Pricing'],
'admin.messages' => ['Home', 'Messages'],
'admin.news.index' => ['Home', 'Berita'],
'admin.news.create' => ['Home', 'Berita', 'Tambah Berita'],
'admin.news.edit' => ['Home', 'Berita', 'Edit Berita'],
'admin.news.show' => ['Home', 'Berita', 'Detail Berita'],
'admin.log-database.index' => ['Home', 'Log Sistem', 'Database Log'],
'admin.log-database.show' => ['Home', 'Log Sistem', 'Database Log', 'Detail'],
'admin.log-file.index' => ['Home', 'Log Sistem', 'File Log'],
'admin.log-file.show' => ['Home', 'Log Sistem', 'File Log', 'Detail'],
'admin.prompt-engineering' => ['Home', 'AI Training', 'Prompt Engineering'],
'admin.fine-tuning' => ['Home', 'AI Training', 'Fine-tuning'],
'admin.keywords-patterns' => ['Home', 'AI Training', 'Keywords dan Patterns'],
'admin.meta-data.index' => ['Home', 'Website Information', 'Meta Data'],
'admin.logo.index' => ['Home', 'Website Information', 'Logo'],
'admin.footer.index' => ['Home', 'Website Information', 'Footer'],
'admin.information.index' => ['Home', 'Website Information', 'Informasi'],
];

// Get breadcrumbs untuk route saat ini
$currentBreadcrumbs = $breadcrumbs[$currentRoute] ?? ['Home'];

$breadcrumbRoutes = [
'Home' => 'admin.dashboard',
'Pengguna' => 'admin.users',
'Berita' => 'admin.news.index',
'Database Log' => 'admin.log-database.index',
'File Log' => 'admin.log-file.index',
'AI Training' => 'admin.prompt-engineering',
'Website Information' => 'javascript:void(0)',
'Informasi' => 'admin.information.index',
];

@endphp

<header class="flex justify-between items-center px-8 py-4 shadow-md sticky top-0 z-50 bg-white dark:bg-gray-800">
    <!-- Breadcrumbs -->
    <nav class="flex-1 text-gray-600 dark:text-gray-400" aria-label="Breadcrumb">
        <ol class="flex items-center space-x-1 md:space-x-3">
            @foreach($currentBreadcrumbs as $index => $breadcrumb)
            <li class="inline-flex items-center">
                @if($index === 0)
                <a href="{{ route('admin.dashboard') }}"
                    class="inline-flex items-center text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-gray-100">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 2a1 1 0 00-.707.293l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h10a1 1 0 001-1v-6.586l1.293 1.293a1 1 0 001.414-1.414l-7-7A1 1 0 0010 2z" />
                    </svg>
                    {{ $breadcrumb }}
                </a>
                @else
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-gray-400 dark:text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                    @if(isset($breadcrumbRoutes[$breadcrumb]))
                        @if(strpos($breadcrumbRoutes[$breadcrumb], 'javascript:') === 0)
                        <!-- Javascript URL dirender sebagai link tanpa route() -->
                        <a href="{{ $breadcrumbRoutes[$breadcrumb] }}"
                            class="ml-1 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-gray-100">
                            {{ $breadcrumb }}
                        </a>
                        @else
                        <!-- Nama route normal -->
                        <a href="{{ route($breadcrumbRoutes[$breadcrumb]) }}"
                            class="ml-1 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-gray-100">
                            {{ $breadcrumb }}
                        </a>
                        @endif
                    @else
                    <span class="ml-1 text-sm font-medium text-gray-700 dark:text-gray-300">{{ $breadcrumb }}</span>
                    @endif
                </div>
                @endif
            </li>
            @endforeach
        </ol>
    </nav>

    <!-- Right Side Actions -->
    <div class="flex items-center">
        <!-- Left Group: Language & Theme -->
        <div class="flex items-center space-x-2 mr-6 border-r border-gray-200 dark:border-gray-700 pr-6">
            <!-- Language Toggle -->
            <button onclick="showLanguageModal()" class="p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full flex items-center gap-2 text-gray-600 dark:text-gray-300">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129" />
                </svg>
                <span class="text-sm font-medium">{{ strtoupper(app()->getLocale()) }}</span>
            </button>

            <!-- Theme Toggle -->
            <button id="theme-toggle" class="p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full">
                <!-- Sun Icon -->
                <svg id="theme-toggle-light-icon" class="hidden w-5 h-5 text-gray-600 dark:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                <!-- Moon Icon -->
                <svg id="theme-toggle-dark-icon" class="w-5 h-5 text-gray-600 dark:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                </svg>
            </button>
        </div>

        <!-- Right Group: Notification & Profile -->
        <div class="flex items-center space-x-4">
            <!-- Notification Dropdown -->
            <div class="relative">
                <button class="p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none"
                    onclick="toggleDropdown('notificationDropdown', 'profileDropdown')">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                </button>
                <div id="notificationDropdown"
                    class="hidden absolute right-0 top-full mt-2 w-80 bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden z-50">
                    <!-- Notification Content -->
                    <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                        <div class="flex justify-between items-center">
                            <h3 class="text-sm font-semibold text-gray-900 dark:text-gray-100">Notifications</h3>
                            <a href="#" class="text-sm text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300">Mark all as read</a>
                        </div>
                    </div>
                    <!-- Notification Items -->
                    <div class="max-h-96 overflow-y-auto">
                        <!-- Example Notification -->
                        <a href="#" class="block px-4 py-3 bg-blue-50 dark:bg-blue-900/20 hover:bg-gray-100 dark:hover:bg-gray-700 border-b border-gray-200 dark:border-gray-700">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <span class="inline-block relative">
                                        <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        <span class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-red-500"></span>
                                    </span>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900 dark:text-gray-100">New Order #1234</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">A new order has been placed</p>
                                    <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">2 minutes ago</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Profile Dropdown -->
            <div class="relative">
                <button class="p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none"
                    onclick="toggleDropdown('profileDropdown', 'notificationDropdown')">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                </button>
                <div id="profileDropdown" class="hidden absolute right-0 top-full mt-2 w-48 bg-white dark:bg-gray-800 rounded-md shadow-lg py-1 z-50">
                    <a href="#" onclick="openSettingsModal()" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Settings
                        </div>
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="block">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                Logout
                            </div>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Panggil komponen settings modal -->
<x-settings />
<script>
    function toggleDropdown(dropdownId, otherDropdownId) {
        const dropdown = document.getElementById(dropdownId);
        const otherDropdown = document.getElementById(otherDropdownId);

        // Hide other dropdown if it's open
        if (!otherDropdown.classList.contains('hidden')) {
            otherDropdown.classList.add('hidden');
        }

        // Toggle current dropdown
        dropdown.classList.toggle('hidden');
    }
    // Fungsi untuk membuka modal settings
    function openSettingsModal() {
        document.getElementById('settingsModal').classList.remove('hidden');
    }

    // Fungsi untuk menutup modal settings
    function closeSettingsModal() {
        document.getElementById('settingsModal').classList.add('hidden');
    }

    // Tutup modal jika mengklik di luar modal
    document.addEventListener('click', function(event) {
        const modal = document.getElementById('settingsModal');
        if (event.target === modal) {
            closeSettingsModal();
        }
    });
    // Close dropdowns when clicking outside
    document.addEventListener('click', function(event) {
        const notificationDropdown = document.getElementById('notificationDropdown');
        const profileDropdown = document.getElementById('profileDropdown');
        const notificationButton = document.querySelector(
            '[onclick="toggleDropdown(\'notificationDropdown\', \'profileDropdown\')"]');
        const profileButton = document.querySelector(
            '[onclick="toggleDropdown(\'profileDropdown\', \'notificationDropdown\')"]');

        if (!notificationButton.contains(event.target) && !notificationDropdown.contains(event.target)) {
            notificationDropdown.classList.add('hidden');
        }

        if (!profileButton.contains(event.target) && !profileDropdown.contains(event.target)) {
            profileDropdown.classList.add('hidden');
        }
    });
</script>
