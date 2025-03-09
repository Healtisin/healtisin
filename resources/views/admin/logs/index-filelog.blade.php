@extends('admin.app')

@section('title', 'File Logs')

@section('content')
@include('components.breadcrumbs', ['route_name' => $route_name ?? 'admin.log-file.index'])

<div class="p-4 sm:p-6 lg:p-8">
    @if(session('success'))
    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @endif

    <div class="sm:flex sm:items-center sm:justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold leading-7 text-gray-900 dark:text-white sm:truncate sm:text-3xl sm:tracking-tight">
                File Log
            </h2>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Lihat log dari file laravel.log
            </p>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
        <div class="p-4 sm:p-6 border-b border-gray-200 dark:border-gray-700">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">
                        Log Tanggal: {{ $selectedDate->format('d M Y') }}
                    </h3>
                </div>
                <div class="flex items-center gap-4">
                    <form action="{{ route('admin.log-file.index') }}" method="GET" class="flex flex-col md:flex-row items-center gap-4 w-full">
                        <input type="hidden" name="sort" value="{{ request('sort', 'created_at') }}">
                        <input type="hidden" name="direction" value="{{ request('direction', 'desc') }}">
                        <input type="hidden" name="log_type" value="file">
                        
                        <!-- Filter Tanggal -->
                        <div class="w-full md:w-auto">
                            <label for="date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tanggal</label>
                            <input type="date" id="date" name="date" value="{{ request('date', $selectedDate->format('Y-m-d')) }}" 
                                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md">
                        </div>
                        
                        <!-- Filter Tipe -->
                        <div class="w-full md:w-auto">
                            <label for="filter_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tipe Log</label>
                            <select id="filter_type" name="filter_type" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md">
                                <option value="">Semua Tipe</option>
                                <option value="error" {{ request('filter_type') == 'error' ? 'selected' : '' }}>Error</option>
                                <option value="warning" {{ request('filter_type') == 'warning' ? 'selected' : '' }}>Warning</option>
                                <option value="info" {{ request('filter_type') == 'info' ? 'selected' : '' }}>Info</option>
                            </select>
                        </div>
                        
                        <!-- Filter Segmen -->
                        <div class="w-full md:w-auto">
                            <label for="filter_segment" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Segmen</label>
                            <select id="filter_segment" name="filter_segment" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md">
                                <option value="">Semua Segmen</option>
                                <option value="transaction" {{ request('filter_segment') == 'transaction' ? 'selected' : '' }}>Transaction</option>
                                <option value="user" {{ request('filter_segment') == 'user' ? 'selected' : '' }}>User</option>
                                <option value="api" {{ request('filter_segment') == 'api' ? 'selected' : '' }}>API</option>
                                <option value="view" {{ request('filter_segment') == 'view' ? 'selected' : '' }}>View</option>
                            </select>
                        </div>
                        
                        <!-- Pencarian -->
                        <div class="w-full md:w-auto">
                            <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Cari Pesan</label>
                            <input type="text" id="search" name="search" value="{{ request('search') }}" placeholder="Cari pesan log..." 
                                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md">
                        </div>
                        
                        <!-- Tombol Filter -->
                        <div class="w-full md:w-auto md:self-end">
                            <button type="submit" class="w-full md:w-auto inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:bg-indigo-500 dark:hover:bg-indigo-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                                </svg>
                                Filter
                            </button>
                        </div>
                        
                        <!-- Tombol Reset -->
                        <div class="w-full md:w-auto md:self-end">
                            <a href="{{ route('admin.log-file.index') }}" class="w-full md:w-auto inline-flex items-center justify-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                                Reset
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            No
                        </th>
                        @include('admin.logs.partials.table-headers')
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($logs as $index => $log)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                {{ ($logs->currentPage() - 1) * $logs->perPage() + $index + 1 }}
                            </td>
                            @include('admin.logs.partials.table-row', ['log' => $log])
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.log-file.show', ['id' => $log->id]) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">
                                        Detail
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-300">
                                Tidak ada log pada tanggal ini
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @include('admin.logs.partials.pagination')
    </div>
</div>

@include('admin.logs.partials.scripts')
@endsection 