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
                <a href="{{ route('admin.logs.index', ['date' => $date, 'log_type' => request('log_type', 'database')]) }}" 
                    class="inline-flex items-center px-3 py-1 rounded-md text-sm font-medium 
                    {{ $selectedDate->format('Y-m-d') == $date ? 'bg-indigo-600 text-white' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-600' }}">
                    {{ \Carbon\Carbon::parse($date)->format('d M Y') }}
                </a>
            @endforeach
        </div>
    </div>
</div>
@endif 