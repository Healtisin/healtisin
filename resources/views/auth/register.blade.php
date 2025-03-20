<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('partials.title', ['segment' => 'Register'])
    @include('partials.dark-mode-init')
    @vite('resources/css/app.css')
    @vite('resources/js/translate.js')
    @include('lang.language-modal')
</head>

<body class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200 transition-colors duration-200">
    <!-- Header with Language and Theme Toggles -->
    <div class="fixed top-0 right-0 p-3 sm:p-4 flex items-center gap-2">
        <!-- Language Toggle -->
        <button onclick="showLanguageModal()"
            class="p-1.5 sm:p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full flex items-center gap-2 text-gray-600 dark:text-gray-300">
            <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129" />
            </svg>
            <span class="text-xs sm:text-sm">{{ strtoupper(app()->getLocale()) }}</span>
        </button>

        <!-- Theme Toggle -->
        <button id="theme-toggle" class="p-1.5 sm:p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full">
            <!-- Sun Icon -->
            <svg id="theme-toggle-light-icon" class="hidden w-4 h-4 sm:w-5 sm:h-5 text-gray-600 dark:text-gray-300" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
            <!-- Moon Icon -->
            <svg id="theme-toggle-dark-icon" class="w-4 h-4 sm:w-5 sm:h-5 text-gray-600 dark:text-gray-300" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
            </svg>
        </button>
    </div>

    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg w-full max-w-[1000px] flex flex-col lg:flex-row overflow-hidden">
            <!-- Welcome Section -->
            <div class="w-full lg:w-1/2 bg-[#24b0ba] p-5 sm:p-6 md:p-8 text-white rounded-t-lg lg:rounded-l-lg lg:rounded-tr-none flex flex-col items-center justify-center">
                <h2 class="text-xl sm:text-2xl md:text-3xl font-semibold mb-3 sm:mb-4">Welcome Back!</h2>
                <p class="mb-4 sm:mb-6 text-sm sm:text-base text-center">Already have an account?</p>
                <a href="{{ route('login') }}"
                    class="px-5 sm:px-6 py-2 sm:py-2.5 border-2 border-white rounded-full hover:bg-white hover:text-[#24b0ba] text-sm sm:text-base transition-colors">
                    Sign In
                </a>
            </div>

            <!-- Form Section -->
            <div class="w-full lg:w-4/5 p-5 sm:p-6 md:p-8">
                <h2 class="text-xl sm:text-2xl font-semibold mb-4 sm:mb-6 dark:text-gray-200">Create Account</h2>
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <!-- Kolom Input -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">NAME</label>
                            <input type="text" name="name"
                                class="w-full px-3 py-2 text-sm sm:text-base border rounded-md bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200"
                                required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">EMAIL</label>
                            <input type="email" name="email"
                                class="w-full px-3 py-2 text-sm sm:text-base border rounded-md bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200"
                                required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">NOMOR TELEPON</label>
                            <input type="tel" name="phone"
                                class="w-full px-3 py-2 text-sm sm:text-base border rounded-md bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 @error('phone') border-red-500 @enderror"
                                placeholder="Contoh: 08123456789" value="{{ old('phone') }}" required>
                            @error('phone')
                            <span class="text-red-600 dark:text-red-400 text-xs sm:text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">USERNAME</label>
                            <input type="text" name="username"
                                class="w-full px-3 py-2 text-sm sm:text-base border rounded-md bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200"
                                required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">PASSWORD</label>
                            <input type="password" name="password"
                                class="w-full px-3 py-2 text-sm sm:text-base border rounded-md bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200"
                                required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">CONFIRM PASSWORD</label>
                            <input type="password" name="password_confirmation"
                                class="w-full px-3 py-2 text-sm sm:text-base border rounded-md bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200"
                                required>
                        </div>
                    </div>
                    <button type="submit"
                        class="w-full py-2 sm:py-2.5 bg-[#24b0ba] text-white rounded-md hover:bg-[#1d8f98] mt-4 text-sm sm:text-base">
                        Sign Up
                    </button>
                </form>

                <!-- Tambahkan setelah form register -->
                <div class="mt-4">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300 dark:border-gray-600"></div>
                        </div>
                        <div class="relative flex justify-center text-xs sm:text-sm">
                            <span class="px-2 bg-white dark:bg-gray-800 text-gray-500 dark:text-gray-400">Atau daftar dengan</span>
                        </div>
                    </div>

                    <div class="mt-4">
                        <a href="{{ url('auth/google') }}"
                            class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <img src="https://www.google.com/favicon.ico" alt="Google" class="h-4 sm:h-5 w-4 sm:w-5 mr-2">
                            Daftar dengan Google
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>