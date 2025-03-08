<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Healtisin AI Admin')</title>
    @include('partials.dark-mode-init')
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    @vite('resources/js/translate.js')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @include('lang.language-modal')
</head>

<body class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200 transition-colors duration-200">
    <div class="flex h-screen overflow-hidden">
        <div class="flex-shrink-0 bg-white dark:bg-gray-800 h-screen w-auto overflow-y-auto border-r border-gray-200 dark:border-gray-700">
            @include('admin.sidebar')
        </div>

        <div class="flex-1 h-screen overflow-y-auto">
            <!-- Header with Language and Theme Toggles -->
            <div class="sticky top-0 z-10 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 px-8 py-4 flex justify-end items-center gap-2">
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

            @yield('content')
        </div>
    </div>
</body>

</html>