<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email - Healtisin AI</title>
    @include('partials.dark-mode-init')
    @vite('resources/css/app.css')
    @vite('resources/js/translate.js')
    @include('lang.language-modal')
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200 transition-colors duration-200">
    <!-- Header with Language and Theme Toggles -->
    <div class="fixed top-0 right-0 p-4 flex items-center gap-2">
        <!-- Language Toggle -->
        <button onclick="showLanguageModal()" class="p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full flex items-center gap-2 text-gray-600 dark:text-gray-300">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129" />
            </svg>
            <span class="text-sm">{{ strtoupper(app()->getLocale()) }}</span>
        </button>

        <!-- Theme Toggle -->
        <button id="theme-toggle" class="p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full">
            <!-- Sun Icon -->
            <svg id="theme-toggle-light-icon" class="hidden w-5 h-5 text-gray-600 dark:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
            <!-- Moon Icon -->
            <svg id="theme-toggle-dark-icon" class="w-5 h-5 text-gray-600 dark:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
            </svg>
        </button>
    </div>

    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg w-[800px] flex">
            <!-- Form Section -->
            <div class="w-1/2 p-8">
                <h2 class="text-2xl font-semibold mb-6 dark:text-gray-200">Verifikasi Email</h2>
                
                @if (session('error'))
                    <div class="bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-200 px-4 py-2 mb-4 rounded-md">
                        {{ session('error') }}
                    </div>
                @endif

                @if (session('success'))
                    <div class="bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-200 px-4 py-2 mb-4 rounded-md">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('verify.otp') }}">
                    @csrf
                    <input type="hidden" name="email" value="{{ $email }}">
                    
                    <div class="mb-6">
                        <div class="bg-blue-50 dark:bg-blue-900/50 border-l-4 border-blue-500 p-4 mb-4">
                            <p class="text-blue-700 dark:text-blue-200">Kode OTP telah dikirim ke email:</p>
                            <p class="font-medium mt-1 dark:text-blue-100">{{ $email }}</p>
                        </div>
                        
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Kode OTP</label>
                        <input type="text" 
                               name="otp" 
                               class="w-full px-3 py-2 border rounded-md bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 text-center tracking-widest text-xl" 
                               placeholder="Masukkan kode OTP"
                               maxlength="6"
                               required>
                        @error('otp')
                            <span class="text-red-600 dark:text-red-400 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="w-full py-2 bg-[#24b0ba] text-white rounded-md hover:bg-[#1d8f98]">
                        Verifikasi
                    </button>
                </form>

                <div class="mt-6 text-sm text-center">
                    <form action="{{ route('resend.otp') }}" method="POST">
                        @csrf
                        <input type="hidden" name="email" value="{{ $email }}">
                        <button type="submit" class="text-gray-600 dark:text-gray-400 hover:text-[#24b0ba] dark:hover:text-[#73c7e3]">
                            Kirim ulang kode OTP
                        </button>
                    </form>
                </div>
            </div>
            
            <!-- Illustration Section -->
            <div class="w-1/2 bg-[#24b0ba] p-8 text-white rounded-r-lg flex flex-col items-center justify-center">
                <h2 class="text-3xl font-semibold mb-4">Satu Langkah Lagi!</h2>
                <p class="text-center">Masukkan kode OTP untuk mengaktifkan akun Anda.</p>
            </div>
        </div>
    </div>
</body>
</html>