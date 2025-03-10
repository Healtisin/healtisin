@extends('admin.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Question Patterns</h1>
        <p class="text-gray-600 dark:text-gray-300 mt-2">Kelola pola pertanyaan yang dapat dikenali oleh AI.</p>
    </div>

    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
        <div class="mb-6 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Question Patterns</h2>
            <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-sm" 
                onclick="openAddPatternModal()">
                Tambah Pattern
            </button>
        </div>

        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg mb-6">
            <p class="text-sm text-gray-600 dark:text-gray-300 mb-4">
                Patterns menggunakan ekspresi reguler (regex) untuk mencocokkan format pertanyaan. 
                Pattern-pattern ini membantu sistem mengenali jenis pertanyaan yang ditanyakan.
            </p>
            <div class="space-y-3 overflow-y-auto max-h-96">
                @foreach($questionPatterns as $index => $pattern)
                    <div class="bg-white dark:bg-gray-600 p-3 rounded-lg">
                        <div class="flex justify-between items-center mb-2">
                            <span class="font-medium">Pattern #{{ $index + 1 }}</span>
                            <div class="flex items-center">
                                <button class="text-blue-600 hover:text-blue-800 mr-3" onclick="editPattern('{{ $pattern }}', {{ $index }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </button>
                                <button class="text-red-600 hover:text-red-800" onclick="deletePattern({{ $index }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 p-2 rounded font-mono text-sm overflow-x-auto">
                            {{ $pattern }}
                        </div>
                        <div class="mt-2 text-sm text-gray-600 dark:text-gray-300">
                            <strong>Contoh Pertanyaan yang Cocok:</strong> 
                            @if(str_contains($pattern, 'apa') || str_contains($pattern, 'jelaskan'))
                                "Apa itu asma?", "Jelaskan mengenai diabetes"
                            @elseif(str_contains($pattern, 'bagaimana') || str_contains($pattern, 'cara'))
                                "Bagaimana cara mengobati sakit kepala?", "Bagaimana mengatasi demam pada anak?"
                            @elseif(str_contains($pattern, 'berapa') || str_contains($pattern, 'kapan'))
                                "Berapa lama waktu pemulihan patah tulang?", "Kapan sebaiknya memeriksakan kehamilan?"
                            @else
                                "Sebutkan gejala demam berdarah", "Apakah sakit kepala berulang berbahaya?"
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <form action="{{ route('admin.keywords-patterns.save') }}" method="POST" class="mb-4">
            @csrf
            <div class="flex items-center">
                <input type="hidden" name="type" value="question_patterns">
                <input type="text" name="pattern" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mr-2" placeholder="Tambahkan pattern regex baru">
                <button type="submit" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">Tambah</button>
            </div>
        </form>
    </div>
</div>

<!-- Form tersembunyi untuk menghapus pattern -->
<form id="delete-pattern-form" action="{{ route('admin.keywords-patterns.delete') }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
    <input type="hidden" id="delete-pattern-index" name="pattern_index" value="">
    <input type="hidden" name="type" value="question_patterns">
</form>

<!-- Modal untuk menambah atau mengedit pattern -->
<div id="pattern-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center z-50">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 w-full max-w-md">
        <div class="flex justify-between items-center mb-4">
            <h3 id="pattern-modal-title" class="text-xl font-semibold text-gray-800 dark:text-white">Tambah Pattern Baru</h3>
            <button onclick="closePatternModal()" class="text-gray-600 hover:text-gray-800 dark:text-gray-300 dark:hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <form id="pattern-form" action="{{ route('admin.keywords-patterns.save') }}" method="POST">
            @csrf
            <input type="hidden" name="type" value="question_patterns">
            <input type="hidden" id="pattern-index" name="pattern_index" value="-1">
            <div class="mb-4">
                <label for="pattern-regex" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Regex Pattern</label>
                <input type="text" id="pattern-regex" name="pattern" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="e.g., /^apa itu (.*?)$/i" required>
            </div>
            <div class="mb-4">
                <label for="pattern-description" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Deskripsi (opsional)</label>
                <textarea id="pattern-description" name="description" rows="2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Jelaskan kegunaan pattern ini"></textarea>
            </div>
            <div class="mb-4">
                <label for="pattern-examples" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Contoh Pertanyaan</label>
                <input type="text" id="pattern-examples" name="examples" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="e.g., Apa itu diabetes?">
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="closePatternModal()" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded mr-2">
                    Batal
                </button>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function openAddPatternModal() {
        const modal = document.getElementById('pattern-modal');
        document.getElementById('pattern-modal-title').textContent = 'Tambah Pattern Baru';
        document.getElementById('pattern-index').value = '-1';
        document.getElementById('pattern-regex').value = '';
        document.getElementById('pattern-description').value = '';
        modal.classList.remove('hidden');
    }
    
    function editPattern(pattern, index) {
        const modal = document.getElementById('pattern-modal');
        document.getElementById('pattern-modal-title').textContent = 'Edit Pattern';
        document.getElementById('pattern-index').value = index;
        document.getElementById('pattern-regex').value = pattern;
        modal.classList.remove('hidden');
    }
    
    function closePatternModal() {
        document.getElementById('pattern-modal').classList.add('hidden');
    }
    
    function deletePattern(index) {
        if (confirm('Apakah Anda yakin ingin menghapus pattern ini?')) {
            document.getElementById('delete-pattern-index').value = index;
            document.getElementById('delete-pattern-form').submit();
        }
    }
</script>
@endsection 