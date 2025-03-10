@extends('admin.app')

@section('content')
@include('components.breadcrumbs')

<div class="container mx-auto px-4 sm:px-8">
    <div class="py-8">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-semibold leading-tight text-gray-900 dark:text-gray-100">Transaksi</h2>
            <div class="flex flex-col">
                <span class="mb-2 text-gray-600 dark:text-gray-400">Total Transaksi: {{ $payments->total() }}</span>
                <span class="text-gray-600 dark:text-gray-400">Total Pendapatan: Rp. {{ number_format($payments->sum('amount'), 2) }}</span>
            </div>
        </div>

        <!-- Filter dan Pencarian -->
        <div class="my-4 flex sm:flex-row flex-col">
            <div class="flex flex-grow justify-end">
                <form id="search-form" action="{{ route('admin.transactions') }}" method="GET" class="flex flex-col md:flex-row items-center gap-4 w-full">
                    <input type="hidden" name="sort" value="{{ request('sort', 'created_at') }}">
                    <input type="hidden" name="direction" value="{{ request('direction', 'desc') }}">
                    
                    <!-- Pencarian -->
                    <div class="relative w-full">
                        <input 
                            type="text" 
                            id="search-input"
                            name="search" 
                            value="{{ request('search') }}" 
                            placeholder="Cari nama pelanggan, email, atau nomor telepon..."
                            class="w-full rounded-lg py-2 px-4 pr-10 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:outline-none focus:ring-1 focus:ring-[#24b0ba]"
                        >
                        <!-- Search Icon -->
                        <div id="search-icon" class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none {{ request('search') ? 'hidden' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <!-- Loading Icon -->
                        <div id="search-loading" class="absolute inset-y-0 right-0 hidden flex items-center pr-3">
                            <svg class="animate-spin h-5 w-5 text-[#24b0ba]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </div>
                        <!-- Clear Icon -->
                        <button 
                            type="button" 
                            id="clear-search" 
                            class="absolute inset-y-0 right-0 flex items-center pr-3 {{ !request('search') ? 'hidden' : '' }}"
                            title="Hapus pencarian"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
            <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th class="px-5 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-800 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">No</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-800 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">
                                <a href="{{ route('admin.transactions', ['sort' => 'customer_name', 'direction' => request('sort') === 'customer_name' && request('direction') === 'asc' ? 'desc' : 'asc', 'search' => request('search')]) }}" class="flex items-center">
                                    Nama Pelanggan
                                    @if(request('sort') === 'customer_name')
                                        @if(request('direction') === 'asc')
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                                            </svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                            </svg>
                                        @endif
                                    @endif
                                </a>
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-800 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Telepon</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-800 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Email</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-800 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">
                                <a href="{{ route('admin.transactions', ['sort' => 'payment_method', 'direction' => request('sort') === 'payment_method' && request('direction') === 'asc' ? 'desc' : 'asc', 'search' => request('search')]) }}" class="flex items-center">
                                    Metode Pembayaran
                                    @if(request('sort') === 'payment_method')
                                        @if(request('direction') === 'asc')
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                                            </svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                            </svg>
                                        @endif
                                    @endif
                                </a>
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-800 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">
                                <a href="{{ route('admin.transactions', ['sort' => 'amount', 'direction' => request('sort') === 'amount' && request('direction') === 'asc' ? 'desc' : 'asc', 'search' => request('search')]) }}" class="flex items-center">
                                    Jumlah
                                    @if(request('sort') === 'amount')
                                        @if(request('direction') === 'asc')
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                                            </svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                            </svg>
                                        @endif
                                    @endif
                                </a>
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-800 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">
                                <a href="{{ route('admin.transactions', ['sort' => 'status', 'direction' => request('sort') === 'status' && request('direction') === 'asc' ? 'desc' : 'asc', 'search' => request('search')]) }}" class="flex items-center">
                                    Status
                                    @if(request('sort') === 'status')
                                        @if(request('direction') === 'asc')
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                                            </svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                            </svg>
                                        @endif
                                    @endif
                                </a>
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-800 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($payments as $index => $payment)
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm text-gray-900 dark:text-gray-100">
                                {{ ($payments->currentPage() - 1) * $payments->perPage() + $loop->iteration }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm text-gray-900 dark:text-gray-100">
                                {{ $payment->customer_name }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm text-gray-900 dark:text-gray-100">
                                {{ $payment->customer_phone }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm text-gray-900 dark:text-gray-100">
                                {{ $payment->customer_email }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm text-gray-900 dark:text-gray-100">
                                {{ $payment->payment_method }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm text-gray-900 dark:text-gray-100">
                                Rp. {{ number_format($payment->amount, 2) }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">
                                @if($payment->status == 'paid')
                                <span class="px-2 py-1 text-sm font-semibold text-green-800 dark:text-green-200 bg-green-200 dark:bg-green-800/30 rounded-full">Dibayar</span>
                                @elseif($payment->status == 'unpaid')
                                <span class="px-2 py-1 text-sm font-semibold text-yellow-800 dark:text-yellow-200 bg-yellow-200 dark:bg-yellow-800/30 rounded-full">Belum Dibayar</span>
                                @elseif($payment->status == 'expired')
                                <span class="px-2 py-1 text-sm font-semibold text-red-800 dark:text-red-200 bg-red-200 dark:bg-red-800/30 rounded-full">Kadaluarsa</span>
                                @elseif($payment->status == 'failed')
                                <span class="px-2 py-1 text-sm font-semibold text-red-800 dark:text-red-200 bg-red-200 dark:bg-red-800/30 rounded-full">Gagal</span>
                                @endif
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">
                                <div class="flex items-center justify-start space-x-3">
                                    <!-- Tombol Delete -->
                                    <form action="{{ route('admin.transactions.destroy', $payment->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 bg-red-100 dark:bg-red-900/30 rounded-lg text-red-600 dark:text-red-400 hover:bg-red-200 dark:hover:bg-red-800/40 transition duration-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="16" height="16" fill="currentColor">
                                                <path d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm text-center text-gray-900 dark:text-gray-100">
                                Tidak ada data transaksi yang ditemukan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                
                <!-- Pagination -->
                @include('admin.users.partials.pagination', ['items' => $payments])
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('search-input');
        const searchForm = document.getElementById('search-form');
        const searchIcon = document.getElementById('search-icon');
        const searchLoading = document.getElementById('search-loading');
        const clearSearch = document.getElementById('clear-search');
        let debounceTimer;

        // Fungsi untuk mengatur visibilitas ikon
        function updateIconVisibility(isLoading = false) {
            const hasValue = searchInput.value.trim().length > 0;
            
            searchIcon.classList.toggle('hidden', hasValue || isLoading);
            clearSearch.classList.toggle('hidden', !hasValue || isLoading);
            searchLoading.classList.toggle('hidden', !isLoading);
            searchLoading.classList.toggle('flex', isLoading);
        }

        // Fungsi debounce untuk menunda eksekusi fungsi
        function debounce(callback, delay = 500) {
            return function() {
                clearTimeout(debounceTimer);
                updateIconVisibility(true); // Tampilkan loading icon
                
                debounceTimer = setTimeout(() => {
                    callback.apply(this, arguments);
                    updateIconVisibility(false); // Sembunyikan loading icon
                }, delay);
            };
        }

        // Fungsi untuk melakukan submit form
        function submitSearch() {
            if (searchInput.value.trim().length > 0 || searchInput.value.trim().length === 0) {
                searchForm.submit();
            }
        }

        // Update icon visibility pada saat halaman dimuat
        updateIconVisibility();

        // Event listener untuk input
        searchInput.addEventListener('input', function() {
            debounce(submitSearch, 700)();
        });

        // Event listener untuk tombol clear
        clearSearch.addEventListener('click', function() {
            searchInput.value = '';
            submitSearch();
        });
        
        // Mencegah submit form dengan tombol enter (pencarian otomatis sudah berjalan)
        searchForm.addEventListener('submit', function(e) {
            if (e.submitter === null) {
                e.preventDefault();
            }
        });
    });
</script>
@endsection