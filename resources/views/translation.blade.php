@extends('partials.app')

@section('title', 'Layanan Terjemahan')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold mb-6 text-center">Layanan Terjemahan</h1>
        
        <div class="flex flex-col lg:flex-row gap-6">
            <!-- Indonesia ke Inggris -->
            <div class="flex-1 border rounded-lg p-4">
                <h2 class="text-xl font-semibold mb-4">Indonesia ke Inggris</h2>
                <div class="mb-4">
                    <label for="id-text" class="block text-sm font-medium text-gray-700 mb-1">Teks Indonesia:</label>
                    <textarea id="id-text" rows="6" class="w-full p-2 border rounded-md"></textarea>
                </div>
                <button id="translate-to-en" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 w-full mb-4">
                    Terjemahkan
                </button>
                <div>
                    <label for="en-result" class="block text-sm font-medium text-gray-700 mb-1">Hasil Terjemahan:</label>
                    <textarea id="en-result" rows="6" class="w-full p-2 border rounded-md bg-gray-50" readonly></textarea>
                </div>
            </div>
            
            <!-- Inggris ke Indonesia -->
            <div class="flex-1 border rounded-lg p-4">
                <h2 class="text-xl font-semibold mb-4">Inggris ke Indonesia</h2>
                <div class="mb-4">
                    <label for="en-text" class="block text-sm font-medium text-gray-700 mb-1">Teks Inggris:</label>
                    <textarea id="en-text" rows="6" class="w-full p-2 border rounded-md"></textarea>
                </div>
                <button id="translate-to-id" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 w-full mb-4">
                    Terjemahkan
                </button>
                <div>
                    <label for="id-result" class="block text-sm font-medium text-gray-700 mb-1">Hasil Terjemahan:</label>
                    <textarea id="id-result" rows="6" class="w-full p-2 border rounded-md bg-gray-50" readonly></textarea>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Penanganan terjemahan Indonesia ke Inggris
        document.getElementById('translate-to-en').addEventListener('click', function() {
            const text = document.getElementById('id-text').value;
            if (!text.trim()) {
                alert('Silakan masukkan teks untuk diterjemahkan');
                return;
            }
            
            fetch('{{ route("translate.id-to-en") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ text: text })
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    alert('Terjadi kesalahan: ' + data.message);
                } else {
                    document.getElementById('en-result').value = data.translatedText || data.targetText || 'Tidak ada hasil terjemahan';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menerjemahkan teks');
            });
        });
        
        // Penanganan terjemahan Inggris ke Indonesia
        document.getElementById('translate-to-id').addEventListener('click', function() {
            const text = document.getElementById('en-text').value;
            if (!text.trim()) {
                alert('Silakan masukkan teks untuk diterjemahkan');
                return;
            }
            
            fetch('{{ route("translate.en-to-id") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ text: text })
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    alert('Terjadi kesalahan: ' + data.message);
                } else {
                    document.getElementById('id-result').value = data.translatedText || data.targetText || 'Tidak ada hasil terjemahan';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menerjemahkan teks');
            });
        });
    });
</script>
@endpush 