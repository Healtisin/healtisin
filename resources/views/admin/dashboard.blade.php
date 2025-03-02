@extends('admin.app')

@section('content')

@include('components.breadcrumbs')

<div class="p-8">

    <h1 class="text-2xl font-bold mb-8">Dashboard</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- <div class="bg-white p-6 rounded-lg shadow">
            <p class="text-gray-500">Total Users</p>
            <p class="text-2xl font-bold">{{ $totalUsers }}
                <span class="{{ $userIncreasePercentage >= 0 ? 'text-green-500' : 'text-red-500' }} text-sm">
                    {{ $userIncreasePercentage >= 0 ? '+' : '' }}{{ $userIncreasePercentage }}%
                </span>
            </p>
            <p class="text-gray-500 text-sm">Compared to ({{ $lastYearUsers }} last year)</p>
        </div> -->
        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex items-center justify-between">
                <p class="text-gray-500 text-sm">Total Users</p>
                <!-- Ikon SVG -->
                <span class="text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" class="w-6 h-6">
                        <path
                            d="M144 0a80 80 0 1 1 0 160A80 80 0 1 1 144 0zM512 0a80 80 0 1 1 0 160A80 80 0 1 1 512 0zM0 298.7C0 239.8 47.8 192 106.7 192l42.7 0c15.9 0 31 3.5 44.6 9.7c-1.3 7.2-1.9 14.7-1.9 22.3c0 38.2 16.8 72.5 43.3 96c-.2 0-.4 0-.7 0L21.3 320C9.6 320 0 310.4 0 298.7zM405.3 320c-.2 0-.4 0-.7 0c26.6-23.5 43.3-57.8 43.3-96c0-7.6-.7-15-1.9-22.3c13.6-6.3 28.7-9.7 44.6-9.7l42.7 0C592.2 192 640 239.8 640 298.7c0 11.8-9.6 21.3-21.3 21.3l-213.3 0zM224 224a96 96 0 1 1 192 0 96 96 0 1 1 -192 0zM128 485.3C128 411.7 187.7 352 261.3 352l117.3 0C452.3 352 512 411.7 512 485.3c0 14.7-11.9 26.7-26.7 26.7l-330.7 0c-14.7 0-26.7-11.9-26.7-26.7z" />
                    </svg>
                </span>
            </div>
            <p class="text-2xl font-bold mt-2">{{ $totalUsers }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <p class="text-gray-500">Today</p>
            <p class="text-2xl font-bold">${{ number_format($todaySales) }} <span
                    class="text-green-500 text-sm">+{{ $salesIncreasePercentage }}%</span></p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <p class="text-gray-500">Avg. Order Amount</p>
            <p class="text-2xl font-bold">15,235 <span class="text-red-500 text-sm">-2.8%</span></p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <p class="text-gray-500">Unique Customers</p>
            <p class="text-2xl font-bold">$9,584 <span class="text-red-500 text-sm">-3.8%</span></p>
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


</div>
@endsection

<!-- <script>
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
</script> -->