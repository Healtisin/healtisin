@extends('admin.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Health Keywords</h1>
        <p class="text-gray-600 dark:text-gray-300 mt-2">Kelola kata kunci terkait kesehatan yang digunakan oleh AI.</p>
    </div>

    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
        <div class="mb-6 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Health Keywords</h2>
            <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-sm" 
                onclick="openAddKeywordModal('health_keywords')">
                Tambah Keyword
            </button>
        </div>

        <div class="space-y-6">
            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                <h3 class="font-semibold text-gray-800 dark:text-white mb-3">Basic Health Terms</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach($healthKeywordsData['basic'] as $keyword)
                        <div class="bg-white dark:bg-gray-600 px-3 py-1 rounded-full text-sm flex items-center">
                            <span>{{ $keyword }}</span>
                            <button class="ml-2 text-red-500 hover:text-red-700" 
                                onclick="deleteKeyword('{{ $keyword }}', 'health_keywords')">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                <h3 class="font-semibold text-gray-800 dark:text-white mb-3">Diseases</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach($healthKeywordsData['diseases'] as $keyword)
                        <div class="bg-white dark:bg-gray-600 px-3 py-1 rounded-full text-sm flex items-center">
                            <span>{{ $keyword }}</span>
                            <button class="ml-2 text-red-500 hover:text-red-700" 
                                onclick="deleteKeyword('{{ $keyword }}', 'health_keywords')">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                <h3 class="font-semibold text-gray-800 dark:text-white mb-3">Symptoms</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach($healthKeywordsData['symptoms'] as $keyword)
                        <div class="bg-white dark:bg-gray-600 px-3 py-1 rounded-full text-sm flex items-center">
                            <span>{{ $keyword }}</span>
                            <button class="ml-2 text-red-500 hover:text-red-700" 
                                onclick="deleteKeyword('{{ $keyword }}', 'health_keywords')">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Tambahkan kategori lainnya -->
            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                <h3 class="font-semibold text-gray-800 dark:text-white mb-3">Mental Conditions</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach($healthKeywordsData['mental'] as $keyword)
                        <div class="bg-white dark:bg-gray-600 px-3 py-1 rounded-full text-sm flex items-center">
                            <span>{{ $keyword }}</span>
                            <button class="ml-2 text-red-500 hover:text-red-700" 
                                onclick="deleteKeyword('{{ $keyword }}', 'health_keywords')">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <form action="{{ route('admin.keywords-patterns.save') }}" method="POST" class="mt-6">
            @csrf
            <div class="flex items-center">
                <input type="hidden" name="type" value="health_keywords">
                <input type="text" name="keyword" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mr-2" placeholder="Tambahkan keyword baru">
                <button type="submit" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">Tambah</button>
            </div>
        </form>
    </div>
</div>

<!-- Form tersembunyi untuk menghapus keyword -->
<form id="delete-keyword-form" action="{{ route('admin.keywords-patterns.delete') }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
    <input type="hidden" id="delete-keyword-value" name="keyword" value="">
    <input type="hidden" id="delete-keyword-type" name="type" value="">
</form>

<!-- Modal untuk menambah keyword -->
<div id="add-keyword-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center z-50">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 w-full max-w-md">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-semibold text-gray-800 dark:text-white">Tambah Health Keyword</h3>
            <button onclick="closeKeywordModal()" class="text-gray-600 hover:text-gray-800 dark:text-gray-300 dark:hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <form id="add-keyword-form" action="{{ route('admin.keywords-patterns.save') }}" method="POST">
            @csrf
            <input type="hidden" id="keyword-type" name="type" value="">
            <div class="mb-4">
                <label for="modal-keyword" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Keyword</label>
                <input type="text" id="modal-keyword" name="keyword" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Masukkan keyword baru" required>
            </div>
            <div class="mb-4">
                <label for="keyword-category" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Kategori</label>
                <select id="keyword-category" name="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                    <option value="" selected disabled>Pilih kategori</option>
                </select>
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="closeKeywordModal()" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded mr-2">
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
    function deleteKeyword(keyword, type) {
        if (confirm(`Apakah Anda yakin ingin menghapus keyword "${keyword}"?`)) {
            document.getElementById('delete-keyword-value').value = keyword;
            document.getElementById('delete-keyword-type').value = type;
            document.getElementById('delete-keyword-form').submit();
        }
    }

    function openAddKeywordModal(type) {
        document.getElementById('keyword-type').value = type;
        document.getElementById('add-keyword-modal').classList.remove('hidden');
        
        populateCategories([
            'basic', 'diseases', 'symptoms', 'digestive', 'skin', 
            'eye', 'ear', 'mental', 'reproductive', 'bone', 
            'dental', 'heart', 'respiratory', 'nervous', 'endocrine', 
            'autoimmune', 'blood', 'preventive', 'emergency', 'procedures'
        ]);
        
        const modalTitle = document.querySelector('#add-keyword-modal h3');
        if (modalTitle) {
            modalTitle.textContent = 'Tambah Health Keyword';
        }
    }
    
    function closeKeywordModal() {
        document.getElementById('add-keyword-modal').classList.add('hidden');
    }
    
    function populateCategories(categories) {
        const select = document.getElementById('keyword-category');
        select.innerHTML = '';
        
        categories.forEach(category => {
            const option = document.createElement('option');
            option.value = category;
            option.textContent = category.charAt(0).toUpperCase() + category.slice(1).replace('_', ' ');
            select.appendChild(option);
        });
    }
</script>
@endsection 