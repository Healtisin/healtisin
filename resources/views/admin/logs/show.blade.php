@extends('admin.app')

@section('title', 'Detail Log')

@section('content')
<div class="p-4 sm:p-6 lg:p-8">
    <div class="mb-6">
        <div class="flex items-center">
            <a href="{{ route('admin.logs.index') }}" class="mr-2 text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
            </a>
            <h2 class="text-2xl font-bold leading-7 text-gray-900 dark:text-white sm:truncate sm:text-3xl sm:tracking-tight">
                Detail Log
            </h2>
        </div>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
            Informasi lengkap tentang log sistem
        </p>
    </div>

    <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
        <div class="p-4 sm:p-6 border-b border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white flex items-center">
                    <span class="mr-2">Log ID: {{ $log->id }}</span>
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                        @if($log->type == 'error') bg-red-100 text-red-800 
                        @elseif($log->type == 'warning') bg-yellow-100 text-yellow-800 
                        @elseif($log->type == 'info') bg-blue-100 text-blue-800 
                        @elseif($log->type == 'audit_success') bg-green-100 text-green-800 
                        @elseif($log->type == 'audit_failure') bg-red-100 text-red-800 
                        @else bg-gray-100 text-gray-800 @endif">
                        {{ ucfirst(str_replace('_', ' ', $log->type)) }}
                    </span>
                    <span class="ml-2 px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                        @if($log->segment == 'transaction') bg-purple-100 text-purple-800 
                        @elseif($log->segment == 'user') bg-blue-100 text-blue-800 
                        @elseif($log->segment == 'api') bg-yellow-100 text-yellow-800 
                        @elseif($log->segment == 'view') bg-green-100 text-green-800 
                        @else bg-gray-100 text-gray-800 @endif">
                        {{ ucfirst($log->segment) }}
                    </span>
                </h3>
                <form id="deleteLogForm" action="{{ route('admin.logs.destroy', $log->id) }}" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="confirmDeleteLog()" 
                        class="inline-flex items-center px-3 py-1.5 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Hapus Log
                    </button>
                </form>
            </div>
        </div>

        <div class="p-4 sm:p-6">
            <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Waktu</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $log->created_at->format('d M Y H:i:s') }}</dd>
                </div>

                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">User</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $log->user ? $log->user->name : 'System' }}</dd>
                </div>

                <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Pesan</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $log->message }}</dd>
                </div>

                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">IP Address</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $log->ip_address ?: 'Tidak tersedia' }}</dd>
                </div>

                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">User Agent</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white truncate">{{ $log->user_agent ?: 'Tidak tersedia' }}</dd>
                </div>

                @if($log->data)
                <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Data Detail</dt>
                    <dd class="mt-1">
                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-md overflow-auto max-h-96">
                            <pre class="text-xs text-gray-900 dark:text-white">{{ json_encode($log->data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                        </div>
                    </dd>
                </div>
                @endif
            </dl>
        </div>
    </div>
</div>

<script>
function confirmDeleteLog() {
    Swal.fire({
        title: 'Hapus Log?',
        html: "Anda akan menghapus log dengan ID: <strong>{{ $log->id }}</strong><br>Tindakan ini tidak dapat dibatalkan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#EF4444',
        cancelButtonColor: '#6B7280',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('deleteLogForm').submit();
        }
    });
}
</script>
@endsection 