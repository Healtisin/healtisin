<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Healtisin AI</title>
    @include('partials.dark-mode-init')
    @vite('resources/css/app.css')
    @vite('resources/js/translate.js')
    @include('lang.language-modal')
</head>

<body class="bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-200 transition-colors duration-200">
    @include('partials.header')

    <main class="pt-16 md:pt-24 pb-12 md:pb-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Hero Section -->
            <div class="mb-16 md:mb-24">
                @include('partials.hero')
            </div>

            <!-- Capabilities Section -->
            <div class="mb-16 md:mb-24">
                @include('partials.capabilities')
            </div>

            <!-- Pricing Section -->
            <div class="mb-16 md:mb-24">
                @include('partials.pricing')
            </div>

            <!-- Why Healtisin Section -->
            <div class="mb-16 md:mb-24">
                @include('partials.benefits')
            </div>
        </div>
    </main>

    @include('partials.footer')
</body>

</html>