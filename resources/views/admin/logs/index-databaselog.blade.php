@extends('admin.app')

@section('title', 'Database Logs')

@section('content')
@include('components.breadcrumbs', ['route_name' => $route_name ?? 'admin.logs.index'])

<div class="p-4 sm:p-6 lg:p-8">
    @if(session('success'))
    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @endif

    <div class="sm:flex sm:items-center sm:justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold leading-7 text-gray-900 dark:text-white sm:truncate sm:text-3xl sm:tracking-tight">
                Database Log
            </h2>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Lihat log aktivitas yang tersimpan di database
            </p>
        </div>
        <div class="mt-4 sm:mt-0">
            <form id="clearLogsForm" action="{{ route('admin.logs.clear') }}" method="POST" class="inline-block">
                @csrf
                @method('DELETE')
                <input type="hidden" name="date" value="{{ $selectedDate->format('Y-m-d') }}">
                <button type="button" onclick="confirmClearLogs()" 
                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    Hapus Semua Log Hari Ini
                </button>
            </form>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
        <div class="p-4 sm:p-6 border-b border-gray-200 dark:border-gray-700">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">
                        Log Tanggal: {{ $selectedDate->format('d M Y') }}
                    </h3>
                    <div class="mt-2 flex flex-wrap gap-2">
                        @foreach($logCounts as $type => $count)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium 
                                @if($type == 'error') bg-red-100 text-red-800 
                                @elseif($type == 'update') bg-blue-100 text-blue-800 
                                @elseif($type == 'addition') bg-green-100 text-green-800 
                                @else bg-gray-100 text-gray-800 @endif">
                                {{ ucfirst($type) }}: {{ $count }}
                            </span>
                        @endforeach
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <form action="{{ route('admin.logs.index') }}" method="GET" class="flex items-center space-x-2">
                        <input type="hidden" name="sort" value="{{ request('sort', 'created_at') }}">
                        <input type="hidden" name="direction" value="{{ request('direction', 'desc') }}">
                        <input type="hidden" name="log_type" value="database">
                        <div class="flex items-center gap-4">
                            <input type="date" name="date" value="{{ $selectedDate->format('Y-m-d') }}" 
                                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md">
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Lihat
                            </button>
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
                                {{ $logs->total() - (($logs->currentPage() - 1) * $logs->perPage()) - $index }}
                            </td>
                            @include('admin.logs.partials.table-row', ['log' => $log])
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.logs.show', ['id' => $log->id, 'type' => 'database']) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">
                                        Detail
                                    </a>
                                    <form id="deleteLogForm-{{ $log->id }}" action="{{ route('admin.logs.destroy', $log->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="confirmDeleteLog({{ $log->id }})" 
                                            class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">
                                            Hapus
                                        </button>
                                    </form>
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

        @if($logs->hasPages())
        <div class="px-4 py-3 bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 sm:px-6">
            <div class="flex items-center justify-between">
                <div class="flex-1 flex justify-between sm:hidden">
                    @if($logs->onFirstPage())
                        <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-gray-100 cursor-not-allowed">
                            Sebelumnya
                        </span>
                    @else
                        <a href="{{ $logs->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                            Sebelumnya
                        </a>
                    @endif

                    @if($logs->hasMorePages())
                        <a href="{{ $logs->nextPageUrl() }}" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                            Selanjutnya
                        </a>
                    @else
                        <span class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-gray-100 cursor-not-allowed">
                            Selanjutnya
                        </span>
                    @endif
                </div>
                <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm text-gray-700 dark:text-gray-300">
                            Menampilkan
                            <span class="font-medium">{{ $logs->firstItem() ?? 0 }}</span>
                            sampai
                            <span class="font-medium">{{ $logs->lastItem() ?? 0 }}</span>
                            dari
                            <span class="font-medium">{{ $logs->total() }}</span>
                            hasil
                        </p>
                    </div>
                    <div>
                        {{ $logs->onEachSide(1)->links() }}
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>

    @include('admin.logs.partials.date-list')
</div>

@include('admin.logs.partials.scripts')
@endsection 