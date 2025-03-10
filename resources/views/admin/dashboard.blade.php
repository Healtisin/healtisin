@extends('admin.app')

@section('content')

@include('components.breadcrumbs')

<div class="p-8" id="scrollDashboard">
    <h1 class="text-2xl font-bold mb-8 text-gray-900 dark:text-gray-100">Dashboard</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <a href="{{ route('admin.users') }}">
            <div
                class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors cursor-pointer">
                <div class="flex items-center justify-between">
                    <p class="text-gray-500 dark:text-gray-400 text-sm">Total Pengguna</p>
                    <span class="text-gray-500 dark:text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" class="w-6 h-6">
                            <path fill="currentColor"
                                d="M144 0a80 80 0 1 1 0 160A80 80 0 1 1 144 0zM512 0a80 80 0 1 1 0 160A80 80 0 1 1 512 0zM0 298.7C0 239.8 47.8 192 106.7 192l42.7 0c15.9 0 31 3.5 44.6 9.7c-1.3 7.2-1.9 14.7-1.9 22.3c0 38.2 16.8 72.5 43.3 96c-.2 0-.4 0-.7 0L21.3 320C9.6 320 0 310.4 0 298.7zM405.3 320c-.2 0-.4 0-.7 0c26.6-23.5 43.3-57.8 43.3-96c0-7.6-.7-15-1.9-22.3c13.6-6.3 28.7-9.7 44.6-9.7l42.7 0C592.2 192 640 239.8 640 298.7c0 11.8-9.6 21.3-21.3 21.3l-213.3 0zM224 224a96 96 0 1 1 192 0 96 96 0 1 1 -192 0zM128 485.3C128 411.7 187.7 352 261.3 352l117.3 0C452.3 352 512 411.7 512 485.3c0 14.7-11.9 26.7-26.7 26.7l-330.7 0c-14.7 0-26.7-11.9-26.7-26.7z" />
                        </svg>
                    </span>
                </div>
                <p class="text-2xl font-bold mt-2 text-gray-900 dark:text-gray-100">{{ $totalUsers }}</p>
            </div>
        </a>

        <a href="{{ route('admin.transactions') }}">
            <div
                class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors cursor-pointer">
                <div class="flex items-center justify-between">
                    <p class="text-gray-500 dark:text-gray-400 text-sm">Total Transaksi</p>
                    <span class="text-gray-500 dark:text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" class="w-6 h-6">
                            <path fill="currentColor"
                                d="M535 41c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l64 64c4.5 4.5 7 10.6 7 17s-2.5 12.5-7 17l-64 64c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l23-23L384 112c-13.3 0-24-10.7-24-24s10.7-24 24-24l174.1 0L535 41zM105 377l-23 23L256 400c13.3 0 24 10.7 24 24s-10.7 24-24 24L81.9 448l23 23c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0L7 441c-4.5-4.5-7-10.6-7-17s2.5-12.5 7-17l64-64c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9zM96 64l241.9 0c-3.7 7.2-5.9 15.3-5.9 24c0 28.7 23.3 52 52 52l117.4 0c-4 17 .6 35.5 13.8 48.8c20.3 20.3 53.2 20.3 73.5 0L608 169.5 608 384c0 35.3-28.7 64-64 64l-241.9 0c3.7-7.2 5.9-15.3 5.9-24c0-28.7-23.3-52-52-52l-117.4 0c4-17-.6-35.5-13.8-48.8c-20.3-20.3-53.2-20.3-73.5 0L32 342.5 32 128c0-35.3 28.7-64 64-64zm64 64l-64 0 0 64c35.3 0 64-28.7 64-64zM544 320c-35.3 0-64 28.7-64 64l64 0 0-64zM320 352a96 96 0 1 0 0-192 96 96 0 1 0 0 192z" />
                        </svg>
                    </span>
                </div>
                <p class="text-2xl font-bold mt-2 text-gray-900 dark:text-gray-100">{{ $totalTransaction }}</p>
            </div>
        </a>

        <a href="{{ route('admin.users') }}">
            <div
                class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors cursor-pointer">
                <div class="flex items-center justify-between">
                    <p class="text-gray-500 dark:text-gray-400 text-sm">Payment</p>
                    <span class="text-gray-500 dark:text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-6 h-6">
                            <path fill="currentColor"
                                d="M470.7 9.4c3 3.1 5.3 6.6 6.9 10.3s2.4 7.8 2.4 12.2c0 0 0 .1 0 .1c0 0 0 0 0 0l0 96c0 17.7-14.3 32-32 32s-32-14.3-32-32l0-18.7L310.6 214.6c-11.8 11.8-30.8 12.6-43.5 1.7L176 138.1 84.8 216.3c-13.4 11.5-33.6 9.9-45.1-3.5s-9.9-33.6 3.5-45.1l112-96c12-10.3 29.7-10.3 41.7 0l89.5 76.7L370.7 64 352 64c-17.7 0-32-14.3-32-32s14.3-32 32-32l96 0s0 0 0 0c8.8 0 16.8 3.6 22.6 9.3l.1 .1zM0 304c0-26.5 21.5-48 48-48l416 0c26.5 0 48 21.5 48 48l0 160c0 26.5-21.5 48-48 48L48 512c-26.5 0-48-21.5-48-48L0 304zM48 416l0 48 48 0c0-26.5-21.5-48-48-48zM96 304l-48 0 0 48c26.5 0 48-21.5 48-48zM464 416c-26.5 0-48 21.5-48 48l48 0 0-48zM416 304c0 26.5 21.5 48 48 48l0-48-48 0zm-96 80a64 64 0 1 0 -128 0 64 64 0 1 0 128 0z" />
                        </svg>
                    </span>
                </div>
                <p class="text-2xl font-bold mt-2 text-gray-900 dark:text-gray-100">{{ $totalUsers }}</p>
            </div>
        </a>

        <a href="{{ route('admin.transactions') }}">
            <div
                class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors cursor-pointer">
                <div class="flex items-center justify-between">
                    <p class="text-gray-500 dark:text-gray-400 text-sm">Messages</p>
                    <span class="text-gray-500 dark:text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="w-6 h-6">
                            <path fill="currentColor"
                                d="M64 64C28.7 64 0 92.7 0 128L0 384c0 35.3 28.7 64 64 64l448 0c35.3 0 64-28.7 64-64l0-256c0-35.3-28.7-64-64-64L64 64zM272 192l224 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-224 0c-8.8 0-16-7.2-16-16s7.2-16 16-16zM256 304c0-8.8 7.2-16 16-16l224 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-224 0c-8.8 0-16-7.2-16-16zM164 152l0 13.9c7.5 1.2 14.6 2.9 21.1 4.7c10.7 2.8 17 13.8 14.2 24.5s-13.8 17-24.5 14.2c-11-2.9-21.6-5-31.2-5.2c-7.9-.1-16 1.8-21.5 5c-4.8 2.8-6.2 5.6-6.2 9.3c0 1.8 .1 3.5 5.3 6.7c6.3 3.8 15.5 6.7 28.3 10.5l.7 .2c11.2 3.4 25.6 7.7 37.1 15c12.9 8.1 24.3 21.3 24.6 41.6c.3 20.9-10.5 36.1-24.8 45c-7.2 4.5-15.2 7.3-23.2 9l0 13.8c0 11-9 20-20 20s-20-9-20-20l0-14.6c-10.3-2.2-20-5.5-28.2-8.4c0 0 0 0 0 0s0 0 0 0c-2.1-.7-4.1-1.4-6.1-2.1c-10.5-3.5-16.1-14.8-12.6-25.3s14.8-16.1 25.3-12.6c2.5 .8 4.9 1.7 7.2 2.4c13.6 4.6 24 8.1 35.1 8.5c8.6 .3 16.5-1.6 21.4-4.7c4.1-2.5 6-5.5 5.9-10.5c0-2.9-.8-5-5.9-8.2c-6.3-4-15.4-6.9-28-10.7l-1.7-.5c-10.9-3.3-24.6-7.4-35.6-14c-12.7-7.7-24.6-20.5-24.7-40.7c-.1-21.1 11.8-35.7 25.8-43.9c6.9-4.1 14.5-6.8 22.2-8.5l0-14c0-11 9-20 20-20s20 9 20 20z" />
                        </svg>
                    </span>
                </div>
                <p class="text-2xl font-bold mt-2 text-gray-900 dark:text-gray-100">{{ $totalTransaction }}</p>
            </div>
        </a>
    </div>

    <div class="gap-6 mb-8">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
            <h2 class="text-xl font-bold mb-4 text-gray-900 dark:text-gray-100">User Activity</h2>
            <div class="flex justify-between items-center mb-4">
                <p class="text-gray-500 dark:text-gray-400">Active vs Inactive Users</p>
            </div>
            <div class="flex justify-center items-center">
                <canvas id="userActivityChart"></canvas>
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
                labels: {
                    color: document.documentElement.classList.contains('dark') ? '#e5e7eb' : '#374151'
                }
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

// Update chart colors when theme changes
const observer = new MutationObserver((mutations) => {
    mutations.forEach((mutation) => {
        if (mutation.attributeName === 'class') {
            const isDark = document.documentElement.classList.contains('dark');
            userActivityChart.options.plugins.legend.labels.color = isDark ? '#e5e7eb' : '#374151';
            userActivityChart.update();
        }
    });
});

observer.observe(document.documentElement, {
    attributes: true,
    attributeFilter: ['class']
});

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
    max-height: calc(100vh - 60px);
    /* Sesuaikan dengan header Anda */
    overflow-y: auto;
    padding-right: 16px;
    /* Memberikan jarak dengan scrollbar */
}

/* Styling khusus untuk scrollbar pada dashboard */
.ps__rail-y {
    background-color: transparent !important;
}

.ps__thumb-y {
    background-color: rgba(156, 163, 175, 0.7) !important;
    width: 6px !important;
}

/* Dark mode styles for scrollbar */
.dark .ps__thumb-y {
    background-color: rgba(156, 163, 175, 0.4) !important;
}
</style>

@endsection