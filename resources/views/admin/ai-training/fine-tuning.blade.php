@extends('admin.app')

@section('title', 'Fine-tuning AI')

@section('content')

@include('components.breadcrumbs')

<div class="container mx-auto px-4 py-6">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mb-6">
        <h1 class="text-2xl font-bold mb-6 text-gray-800 dark:text-white">Fine-tuning Model AI</h1>
        
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="mb-8">
            <p class="text-gray-600 dark:text-gray-300 mb-4">
                Fine-tuning adalah proses penyesuaian model AI yang telah dilatih sebelumnya dengan dataset khusus 
                untuk meningkatkan kemampuannya dalam menangani tugas spesifik.
                Di halaman ini, Anda dapat mengupload dataset yang akan digunakan untuk fine-tuning model AI.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
                <h2 class="text-xl font-semibold mb-4 text-gray-800 dark:text-white">Upload Dataset</h2>
                
                <form action="{{ route('admin.fine-tuning') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div class="mb-4">
                        <label for="model_name" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Nama Model</label>
                        <input type="text" id="model_name" name="model_name" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Contoh: medical-assistant-v1" required>
                    </div>
                    
                    <div class="mb-4">
                        <label for="dataset_description" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Deskripsi Dataset</label>
                        <textarea id="dataset_description" name="dataset_description" rows="3" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Jelaskan tujuan dan konten dataset ini"></textarea>
                    </div>
                    
                    <div class="mb-4">
                        <label for="dataset_type" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Tipe Dataset</label>
                        <select id="dataset_type" name="dataset_type" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option value="medical_qa">Pertanyaan Medis & Jawaban</option>
                            <option value="symptom_diagnosis">Gejala & Diagnosis</option>
                            <option value="medical_conversation">Percakapan Konsultasi Medis</option>
                        </select>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">File Dataset</label>
                        <div class="flex items-center justify-center w-full">
                            <label for="dataset_file" class="flex flex-col items-center justify-center w-full h-40 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-white dark:bg-gray-600 hover:bg-gray-50 dark:hover:bg-gray-500">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Klik untuk upload</span> atau drag and drop</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">JSON, CSV, atau TXT (MAX. 10MB)</p>
                                </div>
                                <input id="dataset_file" name="dataset_file" type="file" class="hidden" accept=".json,.csv,.txt" />
                            </label>
                        </div>
                        <p class="mt-2 text-xs text-gray-500 dark:text-gray-400" id="file-name">Belum ada file yang dipilih</p>
                    </div>
                    
                    <div class="flex justify-end">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Upload Dataset
                        </button>
                    </div>
                </form>
            </div>
            
            <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
                <h2 class="text-xl font-semibold mb-4 text-gray-800 dark:text-white">Parameter Fine-tuning</h2>
                
                <form action="{{ route('admin.fine-tuning') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="mb-4">
                        <label for="dataset_id" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Pilih Dataset</label>
                        <select id="dataset_id" name="dataset_id" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option value="" selected disabled>Pilih dataset yang diupload</option>
                            <option value="1">medical-assistant-v1 (Pertanyaan Medis & Jawaban)</option>
                            <option value="2">symptom-checker-v1 (Gejala & Diagnosis)</option>
                        </select>
                    </div>
                    
                    <div class="mb-4">
                        <label for="base_model" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Model Dasar</label>
                        <select id="base_model" name="parameters[base_model]" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option value="gpt-3.5-turbo">GPT-3.5 Turbo</option>
                            <option value="gpt-4">GPT-4</option>
                            <option value="llama-2">Llama 2</option>
                            <option value="claude-2">Claude 2</option>
                        </select>
                    </div>
                    
                    <div class="mb-4">
                        <label for="epochs" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Jumlah Epochs</label>
                        <input type="number" id="epochs" name="parameters[epochs]" min="1" max="10" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="3">
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Jumlah epoch menentukan berapa kali model akan berlatih dengan seluruh dataset.</p>
                    </div>
                    
                    <div class="mb-4">
                        <label for="learning_rate" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Learning Rate</label>
                        <select id="learning_rate" name="parameters[learning_rate]" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option value="0.00001">0.00001 (Sangat Rendah)</option>
                            <option value="0.0001" selected>0.0001 (Rendah)</option>
                            <option value="0.001">0.001 (Sedang)</option>
                            <option value="0.01">0.01 (Tinggi)</option>
                        </select>
                    </div>
                    
                    <div class="mb-4">
                        <label for="batch_size" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Batch Size</label>
                        <select id="batch_size" name="parameters[batch_size]" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option value="1">1 (Kecil)</option>
                            <option value="4" selected>4 (Sedang)</option>
                            <option value="8">8 (Besar)</option>
                        </select>
                    </div>
                    
                    <div class="flex justify-end">
                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            Mulai Fine-tuning
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold mb-4 text-gray-800 dark:text-white">Model Yang Dilatih</h2>
        
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white dark:bg-gray-700 rounded-lg">
                <thead class="bg-gray-100 dark:bg-gray-600">
                    <tr>
                        <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nama Model</th>
                        <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Dataset</th>
                        <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Model Dasar</th>
                        <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                        <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Tanggal Mulai</th>
                        <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
                    <tr>
                        <td class="py-4 px-4 text-sm text-gray-900 dark:text-white">medical-assistant-v1</td>
                        <td class="py-4 px-4 text-sm text-gray-900 dark:text-white">Pertanyaan Medis & Jawaban</td>
                        <td class="py-4 px-4 text-sm text-gray-900 dark:text-white">GPT-3.5 Turbo</td>
                        <td class="py-4 px-4 text-sm">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Selesai
                            </span>
                        </td>
                        <td class="py-4 px-4 text-sm text-gray-900 dark:text-white">08 Mar 2025</td>
                        <td class="py-4 px-4 text-sm text-gray-900 dark:text-white">
                            <button class="text-blue-600 hover:text-blue-800 mr-2">Detail</button>
                            <button class="text-red-600 hover:text-red-800">Hapus</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="py-4 px-4 text-sm text-gray-900 dark:text-white">symptom-checker-v1</td>
                        <td class="py-4 px-4 text-sm text-gray-900 dark:text-white">Gejala & Diagnosis</td>
                        <td class="py-4 px-4 text-sm text-gray-900 dark:text-white">GPT-4</td>
                        <td class="py-4 px-4 text-sm">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                Sedang Berjalan
                            </span>
                        </td>
                        <td class="py-4 px-4 text-sm text-gray-900 dark:text-white">10 Mar 2025</td>
                        <td class="py-4 px-4 text-sm text-gray-900 dark:text-white">
                            <button class="text-blue-600 hover:text-blue-800 mr-2">Detail</button>
                            <button class="text-red-600 hover:text-red-800">Batalkan</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Script untuk menampilkan nama file yang dipilih
        const fileInput = document.getElementById('dataset_file');
        const fileNameDisplay = document.getElementById('file-name');
        
        fileInput.addEventListener('change', function() {
            if (fileInput.files.length > 0) {
                fileNameDisplay.textContent = `File terpilih: ${fileInput.files[0].name}`;
            } else {
                fileNameDisplay.textContent = 'Belum ada file yang dipilih';
            }
        });
    });
</script>
@endsection 