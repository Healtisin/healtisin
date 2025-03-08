<div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8 mb-8">
    <h3 class="text-xl font-semibold mb-6 dark:text-gray-100">Perbandingan Fitur</h3>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="border-b dark:border-gray-700">
                    <th class="text-left py-4 dark:text-gray-200">Fitur</th>
                    <th class="text-center py-4 dark:text-gray-200">Free</th>
                    <th class="text-center py-4 dark:text-gray-200">Pro</th>
                </tr>
            </thead>
            <tbody class="divide-y dark:divide-gray-700">
                @foreach($features as $feature)
                <tr>
                    <td class="py-4 dark:text-gray-300">{{ $feature['name'] }}</td>
                    <td class="text-center py-4">
                        @if($feature['free'] === '✓')
                            <span class="text-green-600 dark:text-green-400">✓</span>
                        @elseif($feature['free'] === '✕')
                            <span class="text-red-600 dark:text-red-400">✕</span>
                        @else
                            <span class="dark:text-gray-300">{{ $feature['free'] }}</span>
                        @endif
                    </td>
                    <td class="text-center py-4">
                        @if($feature['pro'] === '✓')
                            <span class="text-green-600 dark:text-green-400">✓</span>
                        @elseif($feature['pro'] === '✕')
                            <span class="text-red-600 dark:text-red-400">✕</span>
                        @else
                            <span class="text-[#24b0ba] dark:text-[#73c7e3] font-medium">{{ $feature['pro'] }}</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
