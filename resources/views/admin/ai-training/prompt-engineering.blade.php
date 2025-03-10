@extends('admin.app')

@section('title', 'Prompt Engineering')

@section('content')

@include('components.breadcrumbs')

<div class="container mx-auto px-4 py-6">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mb-6">
        <h1 class="text-2xl font-bold mb-6 text-gray-800 dark:text-white">Prompt Engineering</h1>
        
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="mb-8">
            <p class="text-gray-600 dark:text-gray-300 mb-4">
                Prompt engineering adalah teknik untuk merancang, membuat, dan mengoptimalkan prompt yang diberikan kepada model AI untuk mendapatkan hasil yang diinginkan. 
                Di halaman ini, Anda dapat menyunting prompt yang digunakan untuk berbagai fitur aplikasi.
            </p>
        </div>

        <form action="{{ route('admin.prompt-engineering') }}" method="POST" class="space-y-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <div class="mb-6">
                        <label for="prompt_type" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Tipe Prompt</label>
                        <select id="prompt_type" name="prompt_type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option value="general">Prompt Umum</option>
                            <option value="medical">Prompt Medis</option>
                            <option value="diagnostic">Prompt Diagnostik</option>
                            <option value="recommendation">Prompt Rekomendasi Pengobatan</option>
                        </select>
                    </div>

                    <div class="mb-6">
                        <label for="prompt_language" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Bahasa</label>
                        <select id="prompt_language" name="prompt_language" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option value="id">Bahasa Indonesia</option>
                            <option value="en">Bahasa Inggris</option>
                        </select>
                    </div>
                    
                    <div class="mb-6">
                        <label for="prompt_version" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Versi</label>
                        <input type="text" id="prompt_version" name="prompt_version" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="1.0">
                    </div>
                </div>
                
                <div>
                    <div class="mb-6">
                        <label for="prompt_content" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Isi Prompt</label>
                        <textarea id="prompt_content" name="prompt_content" rows="10" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">Anda adalah asisten kesehatan AI yang memberikan informasi medis umum. Berikan informasi yang akurat dan jelas. Jangan memberikan diagnosis spesifik. Jika pertanyaan di luar konteks medis, beri tahu pengguna bahwa Anda hanya dapat membantu pertanyaan terkait kesehatan.</textarea>
                    </div>
                    
                    <div class="mb-6">
                        <label for="prompt_description" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Deskripsi</label>
                        <textarea id="prompt_description" name="prompt_description" rows="2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">Prompt dasar untuk informasi kesehatan umum</textarea>
                    </div>
                </div>
            </div>

            <div class="flex justify-end">
                <button type="button" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded mr-2">
                    Reset
                </button>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Simpan Prompt
                </button>
            </div>
        </form>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold mb-4 text-gray-800 dark:text-white">Riwayat Prompt</h2>
        
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white dark:bg-gray-700 rounded-lg">
                <thead class="bg-gray-100 dark:bg-gray-600">
                    <tr>
                        <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Tipe</th>
                        <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Bahasa</th>
                        <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Versi</th>
                        <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Tanggal Dibuat</th>
                        <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
                    <tr>
                        <td class="py-4 px-4 text-sm text-gray-900 dark:text-white">Prompt Umum</td>
                        <td class="py-4 px-4 text-sm text-gray-900 dark:text-white">Bahasa Indonesia</td>
                        <td class="py-4 px-4 text-sm text-gray-900 dark:text-white">1.0</td>
                        <td class="py-4 px-4 text-sm text-gray-900 dark:text-white">10 Mar 2025</td>
                        <td class="py-4 px-4 text-sm text-gray-900 dark:text-white">
                            <button class="text-blue-600 hover:text-blue-800 mr-2">Lihat</button>
                            <button class="text-green-600 hover:text-green-800 mr-2">Edit</button>
                            <button class="text-red-600 hover:text-red-800">Hapus</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="py-4 px-4 text-sm text-gray-900 dark:text-white">Prompt Medis</td>
                        <td class="py-4 px-4 text-sm text-gray-900 dark:text-white">Bahasa Indonesia</td>
                        <td class="py-4 px-4 text-sm text-gray-900 dark:text-white">1.0</td>
                        <td class="py-4 px-4 text-sm text-gray-900 dark:text-white">9 Mar 2025</td>
                        <td class="py-4 px-4 text-sm text-gray-900 dark:text-white">
                            <button class="text-blue-600 hover:text-blue-800 mr-2">Lihat</button>
                            <button class="text-green-600 hover:text-green-800 mr-2">Edit</button>
                            <button class="text-red-600 hover:text-red-800">Hapus</button>
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
        // Implementasi script untuk menghandle pemilihan tipe prompt
        const promptTypeSelect = document.getElementById('prompt_type');
        promptTypeSelect.addEventListener('change', function() {
            // Logika untuk mengganti contoh prompt berdasarkan tipe yang dipilih
            const promptContent = document.getElementById('prompt_content');
            const promptDescription = document.getElementById('prompt_description');
            
            switch(this.value) {
                case 'general':
                    promptContent.value = 'Anda adalah asisten kesehatan AI yang memberikan informasi medis umum. Berikan informasi yang akurat dan jelas. Jangan memberikan diagnosis spesifik. Jika pertanyaan di luar konteks medis, beri tahu pengguna bahwa Anda hanya dapat membantu pertanyaan terkait kesehatan.';
                    promptDescription.value = 'Prompt dasar untuk informasi kesehatan umum';
                    break;
                case 'medical':
                    promptContent.value = 'Anda adalah asisten kesehatan AI dengan pengetahuan medis khusus. Berikan informasi medis yang akurat berdasarkan literatur ilmiah terkini. Jelaskan konsep medis dengan bahasa yang mudah dipahami. Jangan memberikan diagnosis atau saran pengobatan spesifik. Jelaskan bahwa informasi yang diberikan bersifat umum dan pengguna harus berkonsultasi dengan tenaga medis profesional.';
                    promptDescription.value = 'Prompt untuk informasi medis yang lebih mendalam';
                    break;
                case 'diagnostic':
                    promptContent.value = 'Anda adalah asisten kesehatan AI yang membantu memahami gejala. Berdasarkan gejala yang dijelaskan, berikan informasi tentang kemungkinan kondisi umum yang terkait, tanpa memberikan diagnosis spesifik. Selalu sarankan pengguna untuk berkonsultasi dengan dokter untuk diagnosis dan pengobatan yang tepat.';
                    promptDescription.value = 'Prompt untuk membantu memahami gejala';
                    break;
                case 'recommendation':
                    promptContent.value = 'Anda adalah asisten kesehatan AI yang memberikan informasi tentang pengobatan umum untuk kondisi tertentu. Berikan informasi tentang pengobatan yang umumnya digunakan, termasuk obat-obatan yang tersedia bebas, perubahan gaya hidup, dan pendekatan non-farmakologis. Jelaskan bahwa informasi tersebut bersifat umum dan pengguna harus berkonsultasi dengan tenaga medis untuk rekomendasi yang disesuaikan dengan kondisi spesifik mereka.';
                    promptDescription.value = 'Prompt untuk informasi pengobatan umum';
                    break;
            }
        });
    });
</script>
@endsection 