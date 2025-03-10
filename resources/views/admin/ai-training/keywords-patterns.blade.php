@extends('admin.app')

@section('content')
<div class="container mx-auto px-4 py-6">
        <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Keywords & Patterns</h1>
        <p class="text-gray-600 dark:text-gray-300 mt-2">Kelola kata kunci dan pola pertanyaan yang digunakan oleh AI.</p>
        </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Greetings Card -->
        <a href="{{ route('admin.keywords-patterns.greetings') }}" class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Greetings</h2>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                    </svg>
            </div>
            <p class="text-gray-600 dark:text-gray-300">Kelola kata-kata sapaan dan ungkapan sopan yang digunakan oleh AI.</p>
            <div class="mt-4 text-sm text-gray-500">
                Kategori: Basic, Formal, Religious, Polite
            </div>
        </a>

        <!-- Health Keywords Card -->
        <a href="{{ route('admin.keywords-patterns.health-keywords') }}" class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Health Keywords</h2>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                    </svg>
            </div>
            <p class="text-gray-600 dark:text-gray-300">Kelola kata kunci terkait kesehatan yang digunakan oleh AI.</p>
            <div class="mt-4 text-sm text-gray-500">
                Kategori: Diseases, Symptoms, Mental, dan lainnya
            </div>
        </a>

        <!-- Question Patterns Card -->
        <a href="{{ route('admin.keywords-patterns.question-patterns') }}" class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Question Patterns</h2>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                </svg>
            </div>
            <p class="text-gray-600 dark:text-gray-300">Kelola pola pertanyaan yang dapat dikenali oleh AI.</p>
            <div class="mt-4 text-sm text-gray-500">
                Format: Regex Patterns untuk mencocokkan pertanyaan
            </div>
        </a>
    </div>
</div>
@endsection 