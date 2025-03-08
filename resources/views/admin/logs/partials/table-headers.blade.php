<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
    <a href="{{ route('admin.logs.index', [
        'date' => request('date', $selectedDate->format('Y-m-d')),
        'sort' => 'created_at',
        'direction' => request('sort') === 'created_at' && request('direction') === 'asc' ? 'desc' : 'asc',
        'log_type' => request('log_type', 'database')
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
        'direction' => request('sort') === 'type' && request('direction') === 'asc' ? 'desc' : 'asc',
        'log_type' => request('log_type', 'database')
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
        'direction' => request('sort') === 'segment' && request('direction') === 'asc' ? 'desc' : 'asc',
        'log_type' => request('log_type', 'database')
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
        'direction' => request('sort') === 'message' && request('direction') === 'asc' ? 'desc' : 'asc',
        'log_type' => request('log_type', 'database')
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
        'direction' => request('sort') === 'user_id' && request('direction') === 'asc' ? 'desc' : 'asc',
        'log_type' => request('log_type', 'database')
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