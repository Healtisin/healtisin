<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    @include('partials.meta-tags')
    @include('partials.dark-mode-init')
    @vite('resources/css/app.css')
    @vite('resources/js/translate.js')
    @include('lang.language-modal')
    <title>@yield('title') - {{ App\Helpers\InformationHelper::getProductName() }}</title>
</head>

<body class="bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-200 transition-colors duration-200">
    @include('partials.header')

    <main class="pt-16 md:pt-24 pb-12 md:pb-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @yield('content')
        </div>
    </main>

    @include('partials.footer')

    @stack('scripts')
</body>

</html> 