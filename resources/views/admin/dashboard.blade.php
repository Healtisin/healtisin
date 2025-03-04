@extends('admin.app')

@section('content')

@include('components.breadcrumbs')

<div class="p-8" id="scrollDashboard">
    <h1 class="text-2xl font-bold mb-8">Dashboard</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <a href="{{ route('admin.users') }}">
            <div class="bg-white p-6 rounded-lg shadow hover:bg-gray-50 transition-colors cursor-pointer">
                <div class="flex items-center justify-between">
                    <p class="text-gray-500 text-sm">Total Pengguna</p>
                    <span class="text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" class="w-6 h-6">
                            <path
                                d="M144 0a80 80 0 1 1 0 160A80 80 0 1 1 144 0zM512 0a80 80 0 1 1 0 160A80 80 0 1 1 512 0zM0 298.7C0 239.8 47.8 192 106.7 192l42.7 0c15.9 0 31 3.5 44.6 9.7c-1.3 7.2-1.9 14.7-1.9 22.3c0 38.2 16.8 72.5 43.3 96c-.2 0-.4 0-.7 0L21.3 320C9.6 320 0 310.4 0 298.7zM405.3 320c-.2 0-.4 0-.7 0c26.6-23.5 43.3-57.8 43.3-96c0-7.6-.7-15-1.9-22.3c13.6-6.3 28.7-9.7 44.6-9.7l42.7 0C592.2 192 640 239.8 640 298.7c0 11.8-9.6 21.3-21.3 21.3l-213.3 0zM224 224a96 96 0 1 1 192 0 96 96 0 1 1 -192 0zM128 485.3C128 411.7 187.7 352 261.3 352l117.3 0C452.3 352 512 411.7 512 485.3c0 14.7-11.9 26.7-26.7 26.7l-330.7 0c-14.7 0-26.7-11.9-26.7-26.7z" />
                        </svg>
                    </span>
                </div>
                <p class="text-2xl font-bold mt-2">{{ $totalUsers }}</p>
            </div>
        </a>

        <a href="{{ route('admin.transactions') }}">
            <div class="bg-white p-6 rounded-lg shadow hover:bg-gray-50 transition-colors cursor-pointer">
                <div class="flex items-center justify-between">
                    <p class="text-gray-500 text-sm">Total Transaksi</p>
                    <span class="text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" class="w-6 h-6">
                            <path
                                d="M535 41c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l64 64c4.5 4.5 7 10.6 7 17s-2.5 12.5-7 17l-64 64c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l23-23L384 112c-13.3 0-24-10.7-24-24s10.7-24 24-24l174.1 0L535 41zM105 377l-23 23L256 400c13.3 0 24 10.7 24 24s-10.7 24-24 24L81.9 448l23 23c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0L7 441c-4.5-4.5-7-10.6-7-17s2.5-12.5 7-17l64-64c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9zM96 64l241.9 0c-3.7 7.2-5.9 15.3-5.9 24c0 28.7 23.3 52 52 52l117.4 0c-4 17 .6 35.5 13.8 48.8c20.3 20.3 53.2 20.3 73.5 0L608 169.5 608 384c0 35.3-28.7 64-64 64l-241.9 0c3.7-7.2 5.9-15.3 5.9-24c0-28.7-23.3-52-52-52l-117.4 0c4-17-.6-35.5-13.8-48.8c-20.3-20.3-53.2-20.3-73.5 0L32 342.5 32 128c0-35.3 28.7-64 64-64zm64 64l-64 0 0 64c35.3 0 64-28.7 64-64zM544 320c-35.3 0-64 28.7-64 64l64 0 0-64zM320 352a96 96 0 1 0 0-192 96 96 0 1 0 0 192z" />
                        </svg>
                    </span>
                </div>
                <p class="text-2xl font-bold mt-2">{{ $totalTransaction }}</p>
            </div>
        </a>

        <a href="#">
            <div class="bg-white p-6 rounded-lg shadow hover:bg-gray-50 transition-colors cursor-pointer">
                <p class="text-gray-500">Today</p>
                <p class="text-2xl font-bold">${{ number_format($todaySales) }} <span
                        class="text-green-500 text-sm">+{{ $salesIncreasePercentage }}%</span></p>
            </div>
        </a>

        <a href="#">
            <div class="bg-white p-6 rounded-lg shadow hover:bg-gray-50 transition-colors cursor-pointer">
                <p class="text-gray-500">Avg. Order Amount</p>
                <p class="text-2xl font-bold">15,235 <span class="text-red-500 text-sm">-2.8%</span></p>
            </div>
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">

        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-bold mb-4">User Activity</h2>
            <div class="flex justify-between items-center mb-4">
                <p class="text-gray-500">Active vs Inactive Users</p>
            </div>
            <div class="flex justify-center items-center">
                <canvas id="userActivityChart"></canvas>
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

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const userActivityData = {
        labels: ['Active', 'Inactive'],
        datasets: [{
            data: [70, 30],
            backgroundColor: ['#24b0ba', '#e0e0e0'],
            hoverOffset: 4,
            borderWidth: 8,
        }]
    };

    const config = {
        type: 'doughnut',
        data: userActivityData,
        options: {
            responsive: true,
            cutout: '70%',
            plugins: {
                legend: {
                    position: 'bottom',
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let label = context.label || '';
                            if (label) {
                                label += ': ';
                            }
                            label += context.raw + '%';
                            return label;
                        }
                    }
                }
            }
        }
    };

    const userActivityChart = new Chart(
        document.getElementById('userActivityChart'),
        config
    );

    document.addEventListener('DOMContentLoaded', function() {
        // Inisialisasi ulang perfect scrollbar untuk dashboard
        const scrollDashboard = document.getElementById('scrollDashboard');
        if (scrollDashboard && typeof PerfectScrollbar !== 'undefined') {
            // Pastikan posisi relatif
            scrollDashboard.style.position = 'relative';
            
            // Inisialisasi dengan konfigurasi yang sesuai
            new PerfectScrollbar(scrollDashboard, {
                wheelSpeed: 1,
                wheelPropagation: true,
                minScrollbarLength: 20,
                suppressScrollX: true,
                scrollbarYMarginRight: 4
            });
            
            console.log('Perfect Scrollbar berhasil diinisialisasi untuk dashboard');
        } else {
            console.error('Element scrollDashboard tidak ditemukan atau PerfectScrollbar tidak terdefinisi');
        }
    });
</script>

<style>
    #userActivityChart {
        width: 350px !important;
        height: 350px !important;
    }
    
    /* Styling tambahan untuk container perfect scrollbar */
    #scrollDashboard {
        position: relative;
        max-height: calc(100vh - 60px); /* Sesuaikan dengan header Anda */
        overflow-y: auto;
        padding-right: 16px; /* Memberikan jarak dengan scrollbar */
    }
    
    /* Styling khusus untuk scrollbar pada dashboard */
    .ps__rail-y {
        background-color: transparent !important;
    }
    
    .ps__thumb-y {
        background-color: rgba(156, 163, 175, 0.7) !important;
        width: 6px !important;
    }
</style>

@endsection