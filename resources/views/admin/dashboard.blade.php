@extends('admin.app')

@section('content')
<!-- Header dengan breadcrumbs dan ikon notifikasi serta profil -->
<header class="flex justify-between items-center px-8 py-5  shadow-sm">
    <!-- Breadcrumbs -->
    <nav class="flex-1 text-gray-600" aria-label="Breadcrumb">
        <ol class="flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="#" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-900">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 2a1 1 0 00-.707.293l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h10a1 1 0 001-1v-6.586l1.293 1.293a1 1 0 001.414-1.414l-7-7A1 1 0 0010 2z" />
                    </svg>
                    Home
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
            </li>
            <li>
                <div class="flex items-center">
                    <a href="#" class="text-sm font-medium text-gray-700 hover:text-gray-900">Dashboard</a>
                </div>
            </li>
            <!-- <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-gray-400 mx-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="text-sm font-medium text-gray-500">Dashboard</span>
                </div>
            </li> -->
        </ol>
    </nav>

    <div class="flex items-center space-x-6">
        <div class="relative">
            <button class="text-gray-500 hover:text-gray-700 focus:outline-none"
                onclick="document.getElementById('notificationDropdown').classList.toggle('hidden')">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                    </path>
                </svg>
            </button>

            <div id="notificationDropdown"
                class="hidden absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-lg overflow-hidden z-50">
                <div class="px-4 py-3 border-b border-gray-200">
                    <div class="flex justify-between items-center">
                        <h3 class="text-sm font-semibold text-gray-900">Notifications</h3>
                        <a href="#" class="text-sm text-blue-600 hover:text-blue-700">Mark all as read</a>
                    </div>
                </div>

                <div class="max-h-96 overflow-y-auto">
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

                    <a href="#" class="block px-4 py-3 hover:bg-gray-100 border-b border-gray-200">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-gray-900">Order #1233 Completed</p>
                                <p class="text-sm text-gray-500">Order has been delivered successfully</p>
                                <p class="text-xs text-gray-400 mt-1">1 hour ago</p>
                            </div>
                        </div>
                    </a>

                    <a href="#" class="block px-4 py-3 hover:bg-gray-100">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-gray-900">System Update</p>
                                <p class="text-sm text-gray-500">System maintenance will occur in 2 hours</p>
                                <p class="text-xs text-gray-400 mt-1">3 hours ago</p>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="px-4 py-3 border-t border-gray-200 bg-gray-50">
                    <a href="#" class="block text-sm text-center font-medium text-blue-600 hover:text-blue-700">
                        View all notifications
                    </a>
                </div>
            </div>
        </div>
        <div class="relative">
            <button class="text-gray-500 hover:text-gray-700 focus:outline-none"
                onclick="document.getElementById('profileDropdown').classList.toggle('hidden')">
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
<div class="p-8">

    <h1 class="text-2xl font-bold mb-8">Dashboard</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white p-6 rounded-lg shadow">
            <p class="text-gray-500">Today</p>
            <p class="text-2xl font-bold">$35,485 <span class="text-green-500 text-sm">+2.8%</span></p>
            <p class="text-gray-500 text-sm">Compared to ($32,490 last year)</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <p class="text-gray-500">Orders</p>
            <p class="text-2xl font-bold">$8,562 <span class="text-green-500 text-sm">+2.8%</span></p>
            <p class="text-gray-500 text-sm">Compared to ($6,232 last year)</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <p class="text-gray-500">Avg. Order Amount</p>
            <p class="text-2xl font-bold">15,235 <span class="text-red-500 text-sm">-2.8%</span></p>
            <p class="text-gray-500 text-sm">Compared to ($12,840 last year)</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <p class="text-gray-500">Unique Customers</p>
            <p class="text-2xl font-bold">$9,584 <span class="text-red-500 text-sm">-3.8%</span></p>
            <p class="text-gray-500 text-sm">Compared to ($8,569 last year)</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-bold mb-4">Sales Analytics</h2>
            <div class="flex justify-between items-center mb-4">
                <p class="text-gray-500">This Week</p>
                <p class="text-gray-500">Most Popular Items</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="text-2xl font-bold">350k</p>
                    <p class="text-gray-500">Special Chicken</p>
                    <p class="text-gray-500">3251 Orders + $1,235 earned</p>
                </div>
                <div>
                    <p class="text-2xl font-bold">300</p>
                    <p class="text-gray-500">Chew Meln</p>
                    <p class="text-gray-500">3251 Orders + $1,189 earned</p>
                </div>
            </div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-bold mb-4">Expense & Income</h2>
            <div class="flex justify-between items-center mb-4">
                <p class="text-gray-500">Expense</p>
                <p class="text-gray-500">Income</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="text-2xl font-bold">$4,235</p>
                    <p class="text-gray-500">BBO Park</p>
                    <p class="text-gray-500">3251 Orders + $2,154 earned</p>
                </div>
                <div>
                    <p class="text-2xl font-bold">$52,319</p>
                    <p class="text-gray-500">Masala Pasta</p>
                    <p class="text-gray-500">3251 Orders + $1,233 earned</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="text-xl font-bold mb-4">Delivery Boy</h2>
        <div class="flex justify-between items-center">
            <p class="text-gray-500">0</p>
            <div class="flex space-x-4">
                <p class="text-gray-500">Tue</p>
                <p class="text-gray-500">Wed</p>
                <p class="text-gray-500">Thu</p>
                <p class="text-gray-500">Fri</p>
                <p class="text-gray-500">Sat</p>
                <p class="text-gray-500">Sun</p>
                <p class="text-gray-500">Mon</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8 pt-6">
        <div class="bg-white p-6 rounded-lg shadow">
            <p class="text-gray-500">Today</p>
            <p class="text-2xl font-bold">$35,485 <span class="text-green-500 text-sm">+2.8%</span></p>
            <p class="text-gray-500 text-sm">Compared to ($32,490 last year)</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <p class="text-gray-500">Orders</p>
            <p class="text-2xl font-bold">$8,562 <span class="text-green-500 text-sm">+2.8%</span></p>
            <p class="text-gray-500 text-sm">Compared to ($6,232 last year)</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <p class="text-gray-500">Avg. Order Amount</p>
            <p class="text-2xl font-bold">15,235 <span class="text-red-500 text-sm">-2.8%</span></p>
            <p class="text-gray-500 text-sm">Compared to ($12,840 last year)</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <p class="text-gray-500">Unique Customers</p>
            <p class="text-2xl font-bold">$9,584 <span class="text-red-500 text-sm">-3.8%</span></p>
            <p class="text-gray-500 text-sm">Compared to ($8,569 last year)</p>
        </div>
    </div>
</div>
@endsection

<script>
    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        const dropdown = document.getElementById('profileDropdown');
        const profileButton = event.target.closest('button');
        const dropdownnotif = document.getElementById('notificationDropdown');
        const notificationButton = event.target.closest('button');

        if (!notificationButton && !dropdown.contains(event.target)) {
            dropdownnotif.classList.add('hidden');
        }
        if (!profileButton && !dropdown.contains(event.target)) {
            dropdown.classList.add('hidden');
        }
    });
</script>