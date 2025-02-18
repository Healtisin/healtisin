@extends('admin.app')

@section('content')

@include('components.breadcrumbs')

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