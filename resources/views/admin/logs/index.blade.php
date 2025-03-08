@extends('admin.app')

@section('title', 'System Logs')

@section('content')
<div class="p-4 sm:p-6 lg:p-8">
    @if(session('success'))
    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @endif

    <div class="sm:flex sm:items-center sm:justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold leading-7 text-gray-900 dark:text-white sm:truncate sm:text-3xl sm:tracking-tight">
                System Logs
            </h2>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Lihat semua aktivitas dan error yang terjadi di sistem
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
                        <input type="date" name="date" value="{{ $selectedDate->format('Y-m-d') }}" 
                            class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md">
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Lihat
                        </button>
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
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            <a href="{{ route('admin.logs.index', [
                                'date' => request('date', $selectedDate->format('Y-m-d')),
                                'sort' => 'created_at',
                                'direction' => request('sort') === 'created_at' && request('direction') === 'asc' ? 'desc' : 'asc'
                            ]) }}" class="group inline-flex items-center">
                                Waktu
                                @if(request('sort', 'created_at') === 'created_at')
                                    @if(request('direction', 'desc') === 'asc')
                                        <svg class="ml-2 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/></svg>
                                    @else
                                        <svg class="ml-2 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                    @endif
                                @else
                                    <svg class="ml-2 h-4 w-4 text-gray-400 opacity-0 group-hover:opacity-100" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/></svg>
                                @endif
                            </a>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            <a href="{{ route('admin.logs.index', [
                                'date' => request('date', $selectedDate->format('Y-m-d')),
                                'sort' => 'type',
                                'direction' => request('sort') === 'type' && request('direction') === 'asc' ? 'desc' : 'asc'
                            ]) }}" class="group inline-flex items-center">
                                Tipe
                                @if(request('sort') === 'type')
                                    @if(request('direction') === 'asc')
                                        <svg class="ml-2 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/></svg>
                                    @else
                                        <svg class="ml-2 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                    @endif
                                @else
                                    <svg class="ml-2 h-4 w-4 text-gray-400 opacity-0 group-hover:opacity-100" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/></svg>
                                @endif
                            </a>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            <a href="{{ route('admin.logs.index', [
                                'date' => request('date', $selectedDate->format('Y-m-d')),
                                'sort' => 'segment',
                                'direction' => request('sort') === 'segment' && request('direction') === 'asc' ? 'desc' : 'asc'
                            ]) }}" class="group inline-flex items-center">
                                Segmen
                                @if(request('sort') === 'segment')
                                    @if(request('direction') === 'asc')
                                        <svg class="ml-2 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/></svg>
                                    @else
                                        <svg class="ml-2 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                    @endif
                                @else
                                    <svg class="ml-2 h-4 w-4 text-gray-400 opacity-0 group-hover:opacity-100" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/></svg>
                                @endif
                            </a>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            <a href="{{ route('admin.logs.index', [
                                'date' => request('date', $selectedDate->format('Y-m-d')),
                                'sort' => 'message',
                                'direction' => request('sort') === 'message' && request('direction') === 'asc' ? 'desc' : 'asc'
                            ]) }}" class="group inline-flex items-center">
                                Pesan
                                @if(request('sort') === 'message')
                                    @if(request('direction') === 'asc')
                                        <svg class="ml-2 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/></svg>
                                    @else
                                        <svg class="ml-2 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                    @endif
                                @else
                                    <svg class="ml-2 h-4 w-4 text-gray-400 opacity-0 group-hover:opacity-100" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/></svg>
                                @endif
                            </a>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            <a href="{{ route('admin.logs.index', [
                                'date' => request('date', $selectedDate->format('Y-m-d')),
                                'sort' => 'user_id',
                                'direction' => request('sort') === 'user_id' && request('direction') === 'asc' ? 'desc' : 'asc'
                            ]) }}" class="group inline-flex items-center">
                                User
                                @if(request('sort') === 'user_id')
                                    @if(request('direction') === 'asc')
                                        <svg class="ml-2 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/></svg>
                                    @else
                                        <svg class="ml-2 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                    @endif
                                @else
                                    <svg class="ml-2 h-4 w-4 text-gray-400 opacity-0 group-hover:opacity-100" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/></svg>
                                @endif
                            </a>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($logs as $index => $log)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                {{ $logs->firstItem() + $index }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $log->created_at->format('H:i:s') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    @if($log->type == 'error') bg-red-100 text-red-800 
                                    @elseif($log->type == 'warning') bg-yellow-100 text-yellow-800 
                                    @elseif($log->type == 'info') bg-blue-100 text-blue-800 
                                    @elseif($log->type == 'audit_success') bg-green-100 text-green-800 
                                    @elseif($log->type == 'audit_failure') bg-red-100 text-red-800 
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ ucfirst(str_replace('_', ' ', $log->type)) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    @if($log->segment == 'transaction') bg-purple-100 text-purple-800 
                                    @elseif($log->segment == 'user') bg-blue-100 text-blue-800 
                                    @elseif($log->segment == 'api') bg-yellow-100 text-yellow-800 
                                    @elseif($log->segment == 'view') bg-green-100 text-green-800 
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ ucfirst($log->segment) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-300">
                                <div class="truncate max-w-xs">{{ $log->message }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                {{ $log->user ? $log->user->name : 'System' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.logs.show', $log->id) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">
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
            {{ $logs->appends(request()->query())->links() }}
        </div>
        @endif
    </div>

    @if(count($logDates) > 0)
    <div class="mt-6 bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
        <div class="p-4 sm:p-6 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">
                Tanggal dengan Log
            </h3>
        </div>
        <div class="p-4 sm:p-6">
            <div class="flex flex-wrap gap-2">
                @foreach($logDates as $date)
                    <a href="{{ route('admin.logs.index', ['date' => $date]) }}" 
                        class="inline-flex items-center px-3 py-1 rounded-md text-sm font-medium 
                        {{ $selectedDate->format('Y-m-d') == $date ? 'bg-indigo-600 text-white' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-600' }}">
                        {{ \Carbon\Carbon::parse($date)->format('d M Y') }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>
    @endif
</div>

<script>
function confirmClearLogs() {
    Swal.fire({
        title: 'Hapus Semua Log?',
        text: "Anda akan menghapus semua log pada tanggal {{ $selectedDate->format('d M Y') }}. Tindakan ini tidak dapat dibatalkan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#EF4444',
        cancelButtonColor: '#6B7280',
        confirmButtonText: 'Ya, Hapus Semua!',
        cancelButtonText: 'Batal',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('clearLogsForm').submit();
        }
    });
}

function confirmDeleteLog(logId) {
    Swal.fire({
        title: 'Hapus Log?',
        text: "Anda akan menghapus log ini. Tindakan ini tidak dapat dibatalkan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#EF4444',
        cancelButtonColor: '#6B7280',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('deleteLogForm-' + logId).submit();
        }
    });
}
</script>
@endsection 