@extends('admin.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Greetings Keywords</h1>
        <p class="text-gray-600 dark:text-gray-300 mt-2">Kelola kata-kata sapaan dan ungkapan sopan yang digunakan oleh AI.</p>
    </div>

    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
        <div class="mb-6 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Greetings</h2>
            <div class="flex items-center gap-2">
                <button id="tampil-semua-btn" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 px-3 py-1 rounded border border-blue-600 hover:border-blue-800 text-sm font-medium">
                    Tampil Semua
                </button>
                <button id="sembunyikan-semua-btn" class="text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-300 px-3 py-1 rounded border border-gray-400 hover:border-gray-600 text-sm font-medium">
                    Sembunyikan Semua
                </button>
                <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-sm" 
                    onclick="openAddKeywordModal('greetings')">
                    Tambah Keyword
                </button>
            </div>
        </div>

        <div class="space-y-4">
            <!-- Basic Greetings -->
            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg overflow-hidden section-container">
                <div class="p-4 flex justify-between items-center section-header">
                    <div>
                        <h3 class="font-semibold text-gray-800 dark:text-white">Basic Greetings</h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                            <span class="keyword-count">{{ count($greetingsData['basic']) }}</span> keywords
                        </p>
                    </div>
                    <button class="tampil-btn bg-blue-100 hover:bg-blue-200 text-blue-700 px-3 py-1 rounded text-sm">
                        Tampil
                    </button>
                </div>
                <div class="section-content hidden">
                    <div class="p-4 pt-0 border-t border-gray-200 dark:border-gray-600">
                        <div class="flex flex-wrap gap-2 mt-2">
                            @foreach($greetingsData['basic'] as $greeting)
                                <div class="bg-white dark:bg-gray-600 px-3 py-1 rounded-full text-sm flex items-center">
                                    <span>{{ $greeting }}</span>
                                    <button class="ml-2 text-red-500 hover:text-red-700" 
                                        onclick="deleteKeyword('{{ $greeting }}', 'greetings')">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Formal Greetings -->
            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg overflow-hidden section-container">
                <div class="p-4 flex justify-between items-center section-header">
                    <div>
                        <h3 class="font-semibold text-gray-800 dark:text-white">Formal Greetings</h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                            <span class="keyword-count">{{ count($greetingsData['formal']) }}</span> keywords
                        </p>
                    </div>
                    <button class="tampil-btn bg-blue-100 hover:bg-blue-200 text-blue-700 px-3 py-1 rounded text-sm">
                        Tampil
                    </button>
                </div>
                <div class="section-content hidden">
                    <div class="p-4 pt-0 border-t border-gray-200 dark:border-gray-600">
                        <div class="flex flex-wrap gap-2 mt-2">
                            @foreach($greetingsData['formal'] as $greeting)
                                <div class="bg-white dark:bg-gray-600 px-3 py-1 rounded-full text-sm flex items-center">
                                    <span>{{ $greeting }}</span>
                                    <button class="ml-2 text-red-500 hover:text-red-700" 
                                        onclick="deleteKeyword('{{ $greeting }}', 'greetings')">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Religious Greetings -->
            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg overflow-hidden section-container">
                <div class="p-4 flex justify-between items-center section-header">
                    <div>
                        <h3 class="font-semibold text-gray-800 dark:text-white">Religious Greetings</h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                            <span class="keyword-count">{{ count($greetingsData['religious']) }}</span> keywords
                        </p>
                    </div>
                    <button class="tampil-btn bg-blue-100 hover:bg-blue-200 text-blue-700 px-3 py-1 rounded text-sm">
                        Tampil
                    </button>
                </div>
                <div class="section-content hidden">
                    <div class="p-4 pt-0 border-t border-gray-200 dark:border-gray-600">
                        <div class="flex flex-wrap gap-2 mt-2">
                            @foreach($greetingsData['religious'] as $greeting)
                                <div class="bg-white dark:bg-gray-600 px-3 py-1 rounded-full text-sm flex items-center">
                                    <span>{{ $greeting }}</span>
                                    <button class="ml-2 text-red-500 hover:text-red-700" 
                                        onclick="deleteKeyword('{{ $greeting }}', 'greetings')">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Polite Expressions -->
            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg overflow-hidden section-container">
                <div class="p-4 flex justify-between items-center section-header">
                    <div>
                        <h3 class="font-semibold text-gray-800 dark:text-white">Polite Expressions</h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                            <span class="keyword-count">{{ count($greetingsData['polite']) }}</span> keywords
                        </p>
                    </div>
                    <button class="tampil-btn bg-blue-100 hover:bg-blue-200 text-blue-700 px-3 py-1 rounded text-sm">
                        Tampil
                    </button>
                </div>
                <div class="section-content hidden">
                    <div class="p-4 pt-0 border-t border-gray-200 dark:border-gray-600">
                        <div class="flex flex-wrap gap-2 mt-2">
                            @foreach($greetingsData['polite'] as $greeting)
                                <div class="bg-white dark:bg-gray-600 px-3 py-1 rounded-full text-sm flex items-center">
                                    <span>{{ $greeting }}</span>
                                    <button class="ml-2 text-red-500 hover:text-red-700" 
                                        onclick="deleteKeyword('{{ $greeting }}', 'greetings')">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Healthcare Greetings -->
            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg overflow-hidden section-container">
                <div class="p-4 flex justify-between items-center section-header">
                    <div>
                        <h3 class="font-semibold text-gray-800 dark:text-white">Healthcare Greetings</h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                            <span class="keyword-count">{{ count($greetingsData['healthcare']) }}</span> keywords
                        </p>
                    </div>
                    <button class="tampil-btn bg-blue-100 hover:bg-blue-200 text-blue-700 px-3 py-1 rounded text-sm">
                        Tampil
                    </button>
                </div>
                <div class="section-content hidden">
                    <div class="p-4 pt-0 border-t border-gray-200 dark:border-gray-600">
                        <div class="flex flex-wrap gap-2 mt-2">
                            @foreach($greetingsData['healthcare'] as $greeting)
                                <div class="bg-white dark:bg-gray-600 px-3 py-1 rounded-full text-sm flex items-center">
                                    <span>{{ $greeting }}</span>
                                    <button class="ml-2 text-red-500 hover:text-red-700" 
                                        onclick="deleteKeyword('{{ $greeting }}', 'greetings')">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <form action="{{ route('admin.keywords-patterns.save') }}" method="POST" class="mt-6">
            @csrf
            <div class="flex items-center">
                <input type="hidden" name="type" value="greetings">
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
            <h3 class="text-xl font-semibold text-gray-800 dark:text-white">Tambah Keyword Baru</h3>
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
    document.addEventListener('DOMContentLoaded', function() {
        // Debug - cek apakah script ini berjalan
        console.log('Script loaded');
        
        // Pasang event listener langsung ke tombol dengan onclick
        const setupButtons = function() {
            // Tombol tampil tiap section
            const tampilButtons = document.querySelectorAll('.tampil-btn');
            console.log('Jumlah tampil button:', tampilButtons.length);
            
            tampilButtons.forEach(function(button) {
                button.onclick = function() {
                    console.log('Tampil button clicked');
                    const section = this.closest('.section-container');
                    const content = section.querySelector('.section-content');
                    
                    if (content.classList.contains('hidden')) {
                        // Tampilkan content
                        content.classList.remove('hidden');
                        this.textContent = 'Sembunyikan';
                        this.classList.remove('bg-blue-100', 'text-blue-700');
                        this.classList.add('bg-gray-100', 'text-gray-700');
                    } else {
                        // Sembunyikan content
                        content.classList.add('hidden');
                        this.textContent = 'Tampil';
                        this.classList.remove('bg-gray-100', 'text-gray-700');
                        this.classList.add('bg-blue-100', 'text-blue-700');
                    }
                };
            });
            
            // Tombol tampil semua
            const tampilSemuaBtn = document.getElementById('tampil-semua-btn');
            if (tampilSemuaBtn) {
                tampilSemuaBtn.onclick = function() {
                    console.log('Tampil semua button clicked');
                    document.querySelectorAll('.section-container').forEach(function(section) {
                        const content = section.querySelector('.section-content');
                        const button = section.querySelector('.tampil-btn');
                        
                        content.classList.remove('hidden');
                        button.textContent = 'Sembunyikan';
                        button.classList.remove('bg-blue-100', 'text-blue-700');
                        button.classList.add('bg-gray-100', 'text-gray-700');
                    });
                };
            }
            
            // Tombol sembunyikan semua
            const sembunyikanSemuaBtn = document.getElementById('sembunyikan-semua-btn');
            if (sembunyikanSemuaBtn) {
                sembunyikanSemuaBtn.onclick = function() {
                    console.log('Sembunyikan semua button clicked');
                    document.querySelectorAll('.section-container').forEach(function(section) {
                        const content = section.querySelector('.section-content');
                        const button = section.querySelector('.tampil-btn');
                        
                        content.classList.add('hidden');
                        button.textContent = 'Tampil';
                        button.classList.remove('bg-gray-100', 'text-gray-700');
                        button.classList.add('bg-blue-100', 'text-blue-700');
                    });
                };
            }
        };
        
        // Jalankan setup buttons
        setupButtons();
        
        // Backup - jika ada delay dalam loading DOM, coba lagi setelah delay singkat
        setTimeout(setupButtons, 500);
    });

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
            'basic', 'formal', 'religious', 'polite', 'healthcare'
        ]);
        
        const modalTitle = document.querySelector('#add-keyword-modal h3');
        if (modalTitle) {
            modalTitle.textContent = 'Tambah Greeting Keyword';
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

<style>
    .section-container {
        transition: all 0.3s ease;
    }
    
    .section-content {
        transition: max-height 0.3s ease-in-out, opacity 0.3s ease-in-out;
        overflow: hidden;
    }
    
    .tampil-btn {
        transition: all 0.2s ease;
        cursor: pointer;
    }
    
    .hidden {
        display: none !important;
    }
    
    /* Memastikan button terlihat clickable */
    button {
        cursor: pointer;
    }
</style>
@endsection 