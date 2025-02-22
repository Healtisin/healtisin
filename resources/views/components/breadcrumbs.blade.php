@php
$currentRoute = Route::currentRouteName();
$breadcrumbs = [
'admin.dashboard' => ['Home', 'Dashboard'],
'admin.users' => ['Home', 'Pengguna'],
'admin.users.create' => ['Home', 'Pengguna', 'Tambah Pengguna'],
'admin.users.edit' => ['Home', 'Pengguna', 'Edit Pengguna'],
'admin.transactions' => ['Home', 'Transaksi'],
'admin.payments' => ['Home', 'Pembayaran'],
'admin.pricing' => ['Home', 'Pricing'],
'admin.messages' => ['Home', 'Messages'],
'admin.news' => ['Home', 'Berita'],
];

$currentBreadcrumbs = $breadcrumbs[$currentRoute] ?? ['Home'];

$breadcrumbRoutes = [
'Home' => 'admin.dashboard',
'Pengguna' => 'admin.users',
];

@endphp

<header class="flex justify-between items-center px-8 py-5 shadow-sm">
    <!-- Breadcrumbs -->
    <nav class="flex-1 text-gray-600" aria-label="Breadcrumb">
        <ol class="flex items-center space-x-1 md:space-x-3">
            @foreach($currentBreadcrumbs as $index => $breadcrumb)
            <li class="inline-flex items-center">
                @if($index === 0)
                <a href="{{ route('admin.dashboard') }}"
                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-900">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 2a1 1 0 00-.707.293l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h10a1 1 0 001-1v-6.586l1.293 1.293a1 1 0 001.414-1.414l-7-7A1 1 0 0010 2z" />
                    </svg>
                    {{ $breadcrumb }}
                </a>
                @else
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                    @if(isset($breadcrumbRoutes[$breadcrumb]))
                    <a href="{{ route($breadcrumbRoutes[$breadcrumb]) }}"
                        class="ml-1 text-sm font-medium text-gray-700 hover:text-gray-900">
                        {{ $breadcrumb }}
                    </a>
                    @else
                    <span class="ml-1 text-sm font-medium text-gray-700">{{ $breadcrumb }}</span>
                    @endif
                    <!-- <a href="#" class="ml-1 text-sm font-medium text-gray-700 hover:text-gray-900">{{ $breadcrumb }}</a> -->
                </div>
                @endif
            </li>
            @endforeach
        </ol>
    </nav>

    <!-- Notification and Profile Dropdown -->
    <div class="flex items-center space-x-6">
        <!-- Notification Dropdown -->
        <div class="relative">
            <button class="text-gray-500 hover:text-gray-700 focus:outline-none"
                onclick="toggleDropdown('notificationDropdown', 'profileDropdown')">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
            </button>
            <div id="notificationDropdown"
                class="hidden absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-lg overflow-hidden z-50">
                <!-- Notification Content -->
                <div class="px-4 py-3 border-b border-gray-200">
                    <div class="flex justify-between items-center">
                        <h3 class="text-sm font-semibold text-gray-900">Notifications</h3>
                        <a href="#" class="text-sm text-blue-600 hover:text-blue-700">Mark all as read</a>
                    </div>
                </div>
                <!-- Notification Items -->
                <div class="max-h-96 overflow-y-auto">
                    <!-- Example Notification -->
                    <a href="#" class="block px-4 py-3 bg-blue-50 hover:bg-gray-100 border-b border-gray-200">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <span class="inline-block relative">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    <span class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-red-500"></span>
                                </span>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">New Order #1234</p>
                                <p class="text-sm text-gray-500">A new order has been placed</p>
                                <p class="text-xs text-gray-400 mt-1">2 minutes ago</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- Profile Dropdown -->
        <div class="relative">
            <button class="text-gray-500 hover:text-gray-700 focus:outline-none"
                onclick="toggleDropdown('profileDropdown', 'notificationDropdown')">
                <img class="w-8 h-8 rounded-full" src="" alt="Profile">
            </button>
            <div id="profileDropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
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
                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
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
</header>

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