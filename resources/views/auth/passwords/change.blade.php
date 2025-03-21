<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('partials.title', ['segment' => 'Ubah Password'])
    @include('partials.dark-mode-init')
    @vite('resources/css/app.css')
    @vite('resources/js/translate.js')
    @include('lang.language-modal')
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200 transition-colors duration-200">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg w-full max-w-[500px] p-5 sm:p-6 md:p-8">
            <div class="flex items-center gap-2 sm:gap-3 mb-4 sm:mb-6">
                <a href="{{ route('home') }}" class="p-1.5 sm:p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>
                <h2 class="text-xl sm:text-2xl font-semibold dark:text-gray-200">Ubah Password</h2>
            </div>

            @if (session('success'))
                <div class="bg-green-100 dark:bg-green-900 border border-green-400 dark:border-green-600 text-green-700 dark:text-green-200 px-3 sm:px-4 py-2 sm:py-3 rounded mb-4 text-sm sm:text-base">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.change.update') }}">
                @csrf
                <div class="mb-4">
                    <label class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Password Saat Ini</label>
                    <input type="password" 
                           name="current_password" 
                           class="w-full px-3 py-2 text-sm sm:text-base border rounded-md bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200" 
                           required>
                    @error('current_password')
                        <span class="text-red-600 dark:text-red-400 text-xs sm:text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Password Baru</label>
                    <input type="password" 
                           name="password" 
                           class="w-full px-3 py-2 text-sm sm:text-base border rounded-md bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200" 
                           required>
                    @error('password')
                        <span class="text-red-600 dark:text-red-400 text-xs sm:text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Konfirmasi Password Baru</label>
                    <input type="password" 
                           name="password_confirmation" 
                           class="w-full px-3 py-2 text-sm sm:text-base border rounded-md bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200" 
                           required>
                </div>

                <button type="submit" class="w-full py-2 sm:py-2.5 bg-[#24b0ba] text-white rounded-md hover:bg-[#73c7e3] text-sm sm:text-base">
                    Ubah Password
                </button>
            </form>
        </div>
    </div>
</body>
</html>