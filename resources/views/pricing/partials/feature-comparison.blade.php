<div class="bg-white rounded-xl shadow-lg p-8 mb-8">
    <h3 class="text-xl font-semibold mb-6">Perbandingan Fitur</h3>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="border-b">
                    <th class="text-left py-4">Fitur</th>
                    <th class="text-center py-4">Free</th>
                    <th class="text-center py-4">Pro</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @foreach($features as $feature)
                <tr>
                    <td class="py-4">{{ $feature['name'] }}</td>
                    <td class="text-center py-4">
                        @if($feature['free'] === '✓')
                            <span class="text-green-600">✓</span>
                        @elseif($feature['free'] === '✕')
                            <span class="text-red-600">✕</span>
                        @else
                            {{ $feature['free'] }}
                        @endif
                    </td>
                    <td class="text-center py-4">
                        @if($feature['pro'] === '✓')
                            <span class="text-green-600">✓</span>
                        @elseif($feature['pro'] === '✕')
                            <span class="text-red-600">✕</span>
                        @else
                            <span class="text-[#24b0ba] font-medium">{{ $feature['pro'] }}</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
