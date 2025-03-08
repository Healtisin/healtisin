<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Healtisin AI</title>
    @include('partials.dark-mode-init')
    @vite('resources/css/app.css')
    @vite('resources/js/translate.js')
    @include('lang.language-modal')
</head>

<body class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200 transition-colors duration-200">
<<<<<<< Updated upstream
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
=======
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg w-full max-w-[800px] flex flex-col lg:flex-row">
>>>>>>> Stashed changes
            <!-- Form Section -->
            <div class="w-full lg:w-1/2 p-6 md:p-8">
                <h2 class="text-2xl font-semibold mb-6 dark:text-gray-200">Sign In</h2>

                @if (session('success'))
<<<<<<< Updated upstream
                    <div class="bg-green-100 dark:bg-green-900 border border-green-400 dark:border-green-600 text-green-700 dark:text-green-200 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="bg-red-100 dark:bg-red-900 border border-red-400 dark:border-red-600 text-red-700 dark:text-red-200 px-4 py-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
=======
                <div
                    class="bg-green-100 dark:bg-green-900 border-l-4 border-green-500 text-green-700 dark:text-green-200 p-4 mb-4">
                    {{ session('success') }}
                </div>
                @endif

                @if (session('error'))
                <div
                    class="bg-red-100 dark:bg-red-900 border-l-4 border-red-500 text-red-700 dark:text-red-200 p-4 mb-4">
                    {{ session('error') }}
                </div>
>>>>>>> Stashed changes
                @endif

                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <input type="hidden" name="redirect" value="{{ request('redirect') }}">
                    <div class="mb-4">
<<<<<<< Updated upstream
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">USERNAME / EMAIL</label>
                        <input type="text" 
                               name="login" 
                               value="{{ old('login') }}"
                               class="w-full px-3 py-2 border rounded-md bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200" 
                               placeholder="Masukkan username atau email">
                        @error('login')
                            <span class="text-red-600 dark:text-red-400 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">PASSWORD</label>
                        <input type="password" 
                               name="password" 
                               class="w-full px-3 py-2 border rounded-md bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200" 
                               placeholder="Masukkan password">
                        @error('password')
                            <span class="text-red-600 dark:text-red-400 text-sm">{{ $message }}</span>
=======
                        <label class="block text-sm font-medium text-gray-700 mb-1">USERNAME / EMAIL</label>
                        <input type="text" name="login" value="{{ old('login') }}"
                            class="w-full px-3 py-2 border rounded-md bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200"
                            placeholder="Masukkan username atau email">
                        @error('login')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1">PASSWORD</label>
                        <input type="password" name="password"
                            class="w-full px-3 py-2 border rounded-md bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200"
                            placeholder="Masukkan password">
                        @error('password')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
>>>>>>> Stashed changes
                        @enderror
                    </div>
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center">
<<<<<<< Updated upstream
                            <input type="checkbox" name="remember" class="text-[#24b0ba] dark:bg-gray-700 dark:border-gray-600">
                            <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Remember Me</span>
                        </div>
                        <a href="{{ route('password.request') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-[#24b0ba] dark:hover:text-[#73c7e3]">Forgot Password</a>
=======
                            <input type="checkbox" name="remember" class="text-[#24b0ba]">
                            <span class="ml-2 text-sm dark:text-gray-300">Remember Me</span>
                        </div>
                        <a href="{{ route('password.request') }}"
                            class="text-sm text-gray-600 dark:text-gray-400">Forgot Password</a>
>>>>>>> Stashed changes
                    </div>
                    <button type="submit" class="w-full py-2 bg-[#24b0ba] text-white rounded-md hover:bg-[#1d8f98]">
                        Sign In
                    </button>
                </form>
                <div class="mt-4">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300 dark:border-gray-600"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
<<<<<<< Updated upstream
                            <span class="px-2 bg-white dark:bg-gray-800 text-gray-500 dark:text-gray-400">Or continue with</span>
=======
                            <span class="px-2 bg-white dark:bg-gray-800 text-gray-500">Or continue with</span>
>>>>>>> Stashed changes
                        </div>
                    </div>

                    <div class="mt-4">
<<<<<<< Updated upstream
                        <a href="{{ route('google.login') }}" 
                           class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
=======
                        <a href="{{ route('google.login') }}"
                            class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 dark:hover:bg-gray-600">
>>>>>>> Stashed changes
                            <img src="https://www.google.com/favicon.ico" alt="Google" class="h-5 w-5 mr-2">
                            Continue with Google
                        </a>
                    </div>
                </div>
            </div>

            <!-- Welcome Section -->
            <div
                class="w-full lg:w-1/2 bg-[#24b0ba] p-6 md:p-8 text-white rounded-b-lg lg:rounded-r-lg lg:rounded-bl-none flex flex-col items-center justify-center">
                <h2 class="text-2xl md:text-3xl font-semibold mb-4">Welcome to login</h2>
                <p class="mb-6 text-center">Don't have an account?</p>
                <a href="{{ route('register') }}"
                    class="px-6 py-2 border-2 border-white rounded-full hover:bg-white hover:text-[#24b0ba]">
                    Sign Up
                </a>
            </div>
        </div>
    </div>
</body>

</html>