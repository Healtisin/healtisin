@php
$currentRoute = Route::currentRouteName();
$isFileLog = $currentRoute === 'admin.log-file.index' || $currentRoute === 'admin.log-file.show';
$isDatabaseLog = $currentRoute === 'admin.log-database.index' || $currentRoute === 'admin.log-database.show';
$routeName = $isFileLog ? 'admin.log-file.index' : 'admin.log-database.index';
@endphp

<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
    <a href="{{ route($routeName, array_merge(request()->except(['sort', 'direction']), [
        'sort' => 'created_at',
        'direction' => request('sort') === 'created_at' && request('direction') === 'asc' ? 'desc' : 'asc'
    ])) }}" class="flex items-center">
        Waktu
        @if(request('sort') === 'created_at')
            @if(request('direction') === 'asc')
                <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                </svg>
            @else
                <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            @endif
        @endif
    </a>
</th>
<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
    <a href="{{ route($routeName, array_merge(request()->except(['sort', 'direction']), [
        'sort' => 'type',
        'direction' => request('sort') === 'type' && request('direction') === 'asc' ? 'desc' : 'asc'
    ])) }}" class="flex items-center">
        Tipe
        @if(request('sort') === 'type')
            @if(request('direction') === 'asc')
                <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                </svg>
            @else
                <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            @endif
        @endif
    </a>
</th>
@if($isDatabaseLog)
<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
    <a href="{{ route($routeName, array_merge(request()->except(['sort', 'direction']), [
        'sort' => 'segment',
        'direction' => request('sort') === 'segment' && request('direction') === 'asc' ? 'desc' : 'asc'
    ])) }}" class="flex items-center">
        Segmen
        @if(request('sort') === 'segment')
            @if(request('direction') === 'asc')
                <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                </svg>
            @else
                <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            @endif
        @endif
    </a>
</th>
@endif
<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
    <a href="{{ route($routeName, array_merge(request()->except(['sort', 'direction']), [
        'sort' => 'message',
        'direction' => request('sort') === 'message' && request('direction') === 'asc' ? 'desc' : 'asc'
    ])) }}" class="flex items-center">
        Pesan
        @if(request('sort') === 'message')
            @if(request('direction') === 'asc')
                <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                </svg>
            @else
                <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            @endif
        @endif
    </a>
</th>
@if($isDatabaseLog)
<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
    <a href="{{ route($routeName, array_merge(request()->except(['sort', 'direction']), [
        'sort' => 'user_id',
        'direction' => request('sort') === 'user_id' && request('direction') === 'asc' ? 'desc' : 'asc'
    ])) }}" class="flex items-center">
        User
        @if(request('sort') === 'user_id')
            @if(request('direction') === 'asc')
                <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                </svg>
            @else
                <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            @endif
        @endif
    </a>
</th>
@endif
<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
    Aksi
</th> 