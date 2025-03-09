@if($logs->hasPages())
<div class="px-4 py-3 bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
    <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
        <!-- Informasi hasil -->
        <div class="text-sm text-gray-700 dark:text-gray-300">
            Menampilkan {{ ($logs->currentPage() - 1) * $logs->perPage() + 1 }} 
            sampai {{ min($logs->currentPage() * $logs->perPage(), $logs->total()) }}
            dari {{ $logs->total() }} hasil
        </div>

        <!-- Navigasi -->
        <div class="flex items-center space-x-2">
            <!-- Previous Page -->
            @if($logs->onFirstPage())
                <span class="px-3 py-1 text-gray-400 bg-gray-100 rounded-md cursor-not-allowed dark:bg-gray-700 dark:text-gray-500">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                </span>
            @else
                <a href="{{ $logs->previousPageUrl() }}" class="px-3 py-1 text-gray-500 bg-white rounded-md hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                </a>
            @endif

            <!-- Page Numbers -->
            <div class="flex items-center space-x-1">
                @php
                    $start = max($logs->currentPage() - 2, 1);
                    $end = min($start + 4, $logs->lastPage());
                    $start = max(min($start, $end - 4), 1);
                @endphp

                @if($start > 1)
                    <a href="{{ $logs->url(1) }}" class="px-3 py-1 text-gray-500 bg-white rounded-md hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700">1</a>
                    @if($start > 2)
                        <span class="px-2 py-1 text-gray-500 dark:text-gray-400">...</span>
                    @endif
                @endif

                @for($i = $start; $i <= $end; $i++)
                    @if($i == $logs->currentPage())
                        <span class="px-3 py-1 text-white bg-blue-600 rounded-md dark:bg-blue-500">{{ $i }}</span>
                    @else
                        <a href="{{ $logs->url($i) }}" class="px-3 py-1 text-gray-500 bg-white rounded-md hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700">{{ $i }}</a>
                    @endif
                @endfor

                @if($end < $logs->lastPage())
                    @if($end < $logs->lastPage() - 1)
                        <span class="px-2 py-1 text-gray-500 dark:text-gray-400">...</span>
                    @endif
                    <a href="{{ $logs->url($logs->lastPage()) }}" class="px-3 py-1 text-gray-500 bg-white rounded-md hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700">{{ $logs->lastPage() }}</a>
                @endif
            </div>

            <!-- Next Page -->
            @if($logs->hasMorePages())
                <a href="{{ $logs->nextPageUrl() }}" class="px-3 py-1 text-gray-500 bg-white rounded-md hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                </a>
            @else
                <span class="px-3 py-1 text-gray-400 bg-gray-100 rounded-md cursor-not-allowed dark:bg-gray-700 dark:text-gray-500">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                </span>
            @endif
        </div>
    </div>
</div>
@endif 