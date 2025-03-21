<div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8 mb-8">
    <h3 class="text-xl font-semibold mb-6 dark:text-gray-100">Pilihan Paket Pro</h3>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($packages as $package)
        <div class="border dark:border-gray-700 rounded-xl p-6 text-center hover:border-[#24b0ba] dark:hover:border-[#73c7e3] transition-colors{{ $package['discount'] > 0 ? ' relative' : '' }}">
            @if($package['discount'] > 0)
            <div class="absolute -top-3 right-3">
                <span class="px-2 py-1 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 text-xs rounded-full">Hemat {{ $package['discount'] }}%</span>
            </div>
            @endif
            <h4 class="font-semibold mb-2 dark:text-gray-200">{{ $package['name'] }}</h4>
            <p class="text-2xl font-bold text-[#24b0ba] dark:text-[#73c7e3] mb-1">Rp {{ number_format($package['price'], 0, ',', '.') }}</p>
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">Rp {{ number_format($package['monthly'], 0, ',', '.') }}/bulan</p>
            @if($package['savings'] > 0)
            <p class="text-xs text-green-600 dark:text-green-400">Hemat Rp {{ number_format($package['savings'], 0, ',', '.') }}</p>
            @else
            <p class="text-xs text-gray-400 dark:text-gray-500">Tanpa diskon</p>
            @endif
        </div>
        @endforeach
    </div>
</div>