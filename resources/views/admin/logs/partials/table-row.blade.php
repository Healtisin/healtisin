@php
use App\Helpers\TextHelper;
$currentRoute = Route::currentRouteName();
$isFileLog = $currentRoute === 'admin.log-file.index' || $currentRoute === 'admin.log-file.show';
$isDatabaseLog = $currentRoute === 'admin.log-database.index' || $currentRoute === 'admin.log-database.show';
@endphp

<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
    {{ $log->created_at instanceof \Carbon\Carbon ? $log->created_at->format('d M Y H:i:s') : Carbon\Carbon::parse($log->created_at)->format('d M Y H:i:s') }}
</td>
<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
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
@if($isDatabaseLog)
<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
        @if($log->segment == 'transaction') bg-purple-100 text-purple-800 
        @elseif($log->segment == 'user') bg-blue-100 text-blue-800 
        @elseif($log->segment == 'api') bg-yellow-100 text-yellow-800 
        @elseif($log->segment == 'view') bg-green-100 text-green-800 
        @else bg-gray-100 text-gray-800 @endif">
        {{ ucfirst($log->segment) }}
    </span>
</td>
@endif
<td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-300">
    <div class="max-w-xs truncate" title="{{ $log->message }}">
        {{ TextHelper::truncate($log->message, 100) }}
    </div>
</td>
@if($isDatabaseLog)
<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
    {{ $log->user ? $log->user->name : 'System' }}
</td>
@endif 