@extends('partials.app')

@section('title', 'Pengaturan Terjemahan')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold mb-6 text-center">Pengaturan Terjemahan</h1>
        
        <div class="mb-10">
            <h2 class="text-xl font-semibold mb-4">Kata-kata yang Dilindungi</h2>
            <p class="text-gray-600 mb-4">Kata-kata ini tidak akan diterjemahkan (contoh: nama produk, istilah khusus, dll.)</p>
            
            <div id="preserved-words-container" class="mb-4">
                @foreach($preservedWords as $word)
                <div class="flex items-center mb-2">
                    <input type="text" class="preserved-word w-full p-2 border rounded-md" value="{{ $word }}">
                    <button type="button" class="ml-2 bg-red-500 text-white p-2 rounded-md hover:bg-red-600 delete-word">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
                @endforeach
                <div class="flex items-center mb-2">
                    <input type="text" class="preserved-word w-full p-2 border rounded-md" placeholder="Tambahkan kata baru...">
                    <button type="button" class="ml-2 bg-red-500 text-white p-2 rounded-md hover:bg-red-600 delete-word">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
            
            <button id="add-preserved-word" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 mr-2">
                Tambah Kata Baru
            </button>
            
            <button id="save-preserved-words" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">
                Simpan Kata-kata yang Dilindungi
            </button>
        </div>
        
        <div class="mb-10">
            <h2 class="text-xl font-semibold mb-4">Koreksi Terjemahan: Indonesia ke Inggris</h2>
            <p class="text-gray-600 mb-4">Perbaiki terjemahan yang sering salah saat menerjemahkan dari Bahasa Indonesia ke Bahasa Inggris</p>
            
            <div id="id-to-en-container" class="mb-4">
                @foreach($idToEnCorrections as $from => $to)
                <div class="flex items-center mb-2">
                    <input type="text" class="from-word w-full p-2 border rounded-md mr-2" value="{{ $from }}" placeholder="Kata Indonesia">
                    <span class="mx-2">→</span>
                    <input type="text" class="to-word w-full p-2 border rounded-md" value="{{ $to }}" placeholder="Kata Inggris">
                    <button type="button" class="ml-2 bg-red-500 text-white p-2 rounded-md hover:bg-red-600 delete-correction">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
                @endforeach
                <div class="flex items-center mb-2">
                    <input type="text" class="from-word w-full p-2 border rounded-md mr-2" placeholder="Kata Indonesia">
                    <span class="mx-2">→</span>
                    <input type="text" class="to-word w-full p-2 border rounded-md" placeholder="Kata Inggris">
                    <button type="button" class="ml-2 bg-red-500 text-white p-2 rounded-md hover:bg-red-600 delete-correction">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
            
            <button id="add-id-to-en" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                Tambah Koreksi Baru
            </button>
        </div>
        
        <div class="mb-10">
            <h2 class="text-xl font-semibold mb-4">Koreksi Terjemahan: Inggris ke Indonesia</h2>
            <p class="text-gray-600 mb-4">Perbaiki terjemahan yang sering salah saat menerjemahkan dari Bahasa Inggris ke Bahasa Indonesia</p>
            
            <div id="en-to-id-container" class="mb-4">
                @foreach($enToIdCorrections as $from => $to)
                <div class="flex items-center mb-2">
                    <input type="text" class="from-word w-full p-2 border rounded-md mr-2" value="{{ $from }}" placeholder="Kata Inggris">
                    <span class="mx-2">→</span>
                    <input type="text" class="to-word w-full p-2 border rounded-md" value="{{ $to }}" placeholder="Kata Indonesia">
                    <button type="button" class="ml-2 bg-red-500 text-white p-2 rounded-md hover:bg-red-600 delete-correction">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
                @endforeach
                <div class="flex items-center mb-2">
                    <input type="text" class="from-word w-full p-2 border rounded-md mr-2" placeholder="Kata Inggris">
                    <span class="mx-2">→</span>
                    <input type="text" class="to-word w-full p-2 border rounded-md" placeholder="Kata Indonesia">
                    <button type="button" class="ml-2 bg-red-500 text-white p-2 rounded-md hover:bg-red-600 delete-correction">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
            
            <button id="add-en-to-id" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 mr-2">
                Tambah Koreksi Baru
            </button>
            
            <button id="save-corrections" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">
                Simpan Semua Koreksi
            </button>
        </div>
        
        <div class="flex justify-center">
            <a href="{{ route('translation') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">
                Kembali ke Halaman Terjemahan
            </a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Tambah kata yang dilindungi
        document.getElementById('add-preserved-word').addEventListener('click', function() {
            const container = document.getElementById('preserved-words-container');
            const newRow = document.createElement('div');
            newRow.className = 'flex items-center mb-2';
            newRow.innerHTML = `
                <input type="text" class="preserved-word w-full p-2 border rounded-md" placeholder="Tambahkan kata baru...">
                <button type="button" class="ml-2 bg-red-500 text-white p-2 rounded-md hover:bg-red-600 delete-word">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            `;
            container.appendChild(newRow);
            setupDeleteHandlers();
        });
        
        // Tambah koreksi Indonesia ke Inggris
        document.getElementById('add-id-to-en').addEventListener('click', function() {
            const container = document.getElementById('id-to-en-container');
            addCorrectionRow(container);
        });
        
        // Tambah koreksi Inggris ke Indonesia
        document.getElementById('add-en-to-id').addEventListener('click', function() {
            const container = document.getElementById('en-to-id-container');
            addCorrectionRow(container);
        });
        
        // Simpan kata-kata yang dilindungi
        document.getElementById('save-preserved-words').addEventListener('click', function() {
            const inputs = document.querySelectorAll('#preserved-words-container .preserved-word');
            const words = [];
            
            inputs.forEach(input => {
                if (input.value.trim() !== '') {
                    words.push(input.value.trim());
                }
            });
            
            fetch('{{ route("translation.preserved-words.save") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ words: words })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Kata-kata yang dilindungi berhasil disimpan');
                } else {
                    alert('Terjadi kesalahan: ' + (data.message || 'Tidak dapat menyimpan kata-kata'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menyimpan kata-kata');
            });
        });
        
        // Simpan koreksi terjemahan
        document.getElementById('save-corrections').addEventListener('click', function() {
            const idToEn = {};
            const enToId = {};
            
            // Ambil koreksi Indonesia ke Inggris
            const idToEnRows = document.querySelectorAll('#id-to-en-container .flex.items-center');
            idToEnRows.forEach(row => {
                const fromInput = row.querySelector('.from-word');
                const toInput = row.querySelector('.to-word');
                
                if (fromInput && toInput && fromInput.value.trim() !== '' && toInput.value.trim() !== '') {
                    idToEn[fromInput.value.trim()] = toInput.value.trim();
                }
            });
            
            // Ambil koreksi Inggris ke Indonesia
            const enToIdRows = document.querySelectorAll('#en-to-id-container .flex.items-center');
            enToIdRows.forEach(row => {
                const fromInput = row.querySelector('.from-word');
                const toInput = row.querySelector('.to-word');
                
                if (fromInput && toInput && fromInput.value.trim() !== '' && toInput.value.trim() !== '') {
                    enToId[fromInput.value.trim()] = toInput.value.trim();
                }
            });
            
            fetch('{{ route("translation.corrections.save") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    id_to_en: idToEn,
                    en_to_id: enToId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Koreksi terjemahan berhasil disimpan');
                } else {
                    alert('Terjadi kesalahan: ' + (data.message || 'Tidak dapat menyimpan koreksi'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menyimpan koreksi terjemahan');
            });
        });
        
        // Setup handler hapus
        setupDeleteHandlers();
        
        // Fungsi untuk menambah baris koreksi baru
        function addCorrectionRow(container) {
            const newRow = document.createElement('div');
            newRow.className = 'flex items-center mb-2';
            newRow.innerHTML = `
                <input type="text" class="from-word w-full p-2 border rounded-md mr-2" placeholder="${container.id === 'id-to-en-container' ? 'Kata Indonesia' : 'Kata Inggris'}">
                <span class="mx-2">→</span>
                <input type="text" class="to-word w-full p-2 border rounded-md" placeholder="${container.id === 'id-to-en-container' ? 'Kata Inggris' : 'Kata Indonesia'}">
                <button type="button" class="ml-2 bg-red-500 text-white p-2 rounded-md hover:bg-red-600 delete-correction">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            `;
            container.appendChild(newRow);
            setupDeleteHandlers();
        }
        
        // Fungsi untuk mengatur handler hapus
        function setupDeleteHandlers() {
            // Hapus kata yang dilindungi
            document.querySelectorAll('.delete-word').forEach(button => {
                button.addEventListener('click', function() {
                    if (document.querySelectorAll('#preserved-words-container .flex.items-center').length > 1) {
                        this.parentElement.remove();
                    } else {
                        this.parentElement.querySelector('input').value = '';
                    }
                });
            });
            
            // Hapus koreksi
            document.querySelectorAll('.delete-correction').forEach(button => {
                button.addEventListener('click', function() {
                    const container = this.closest('#id-to-en-container, #en-to-id-container');
                    if (container.querySelectorAll('.flex.items-center').length > 1) {
                        this.parentElement.remove();
                    } else {
                        const inputs = this.parentElement.querySelectorAll('input');
                        inputs.forEach(input => input.value = '');
                    }
                });
            });
        }
    });
</script>
@endpush 