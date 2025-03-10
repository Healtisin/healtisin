<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Healtisin AI</title>
    @include('partials.dark-mode-init')
    @vite('resources/css/app.css')
    @vite('resources/js/translate.js')
    @include('lang.language-modal')
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200 transition-colors duration-200">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg w-full max-w-[800px] flex flex-col lg:flex-row overflow-hidden">
            <div class="w-full lg:w-1/2 p-5 sm:p-6 md:p-8">
                <h2 class="text-xl sm:text-2xl font-semibold mb-4 sm:mb-6 dark:text-gray-200">Reset Password</h2>
                
                @if (session('error'))
                    <div class="bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-200 px-3 sm:px-4 py-2 sm:py-3 mb-4 rounded-md text-sm sm:text-base">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('password.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="email" value="{{ $email }}">
                    
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
                        <label class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Konfirmasi Password</label>
                        <input type="password" 
                               name="password_confirmation" 
                               class="w-full px-3 py-2 text-sm sm:text-base border rounded-md bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200" 
                               required>
                    </div>

                    <button type="submit" class="w-full py-2 sm:py-2.5 bg-[#24b0ba] text-white rounded-md hover:bg-[#1d8f98] text-sm sm:text-base">
                        Reset Password
                    </button>
                </form>
            </div>
            
            <div class="w-full lg:w-1/2 bg-[#24b0ba] p-5 sm:p-6 md:p-8 text-white rounded-b-lg lg:rounded-r-lg lg:rounded-bl-none flex flex-col items-center justify-center">
                <h2 class="text-xl sm:text-2xl md:text-3xl font-semibold mb-3 sm:mb-4 text-center">Reset Password</h2>
                <p class="text-sm sm:text-base text-center">Masukkan password baru untuk akun Anda.</p>
            </div>
        </div>
    </div>
</body>
</html>