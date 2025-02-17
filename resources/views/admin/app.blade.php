<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Healtisin AI</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">
    <!-- <header class="bg-white shadow-sm fixed top-0 left-0 right-0 z-50">
        <div class="container mx-auto px-6 py-4 flex items-center justify-between">
            <div class="flex items-center">
                <a href="/" class="flex items-center">
                    <img id="logoImage" src="{{ asset('images/logo.png') }}" alt="Logo"
                        class="h-8 transition-all duration-300">
                </a>
            </div>

            <nav class="text-gray-600" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="#"
                            class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-900">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M10 2a1 1 0 00-.707.293l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h10a1 1 0 001-1v-6.586l1.293 1.293a1 1 0 001.414-1.414l-7-7A1 1 0 0010 2z" />
                            </svg>
                            Home
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M7.293 9.293a1 1 0 011.414 0L10 10.586l1.293-1.293a1 1 0 111.414 1.414l-2 2a1 1 0 01-1.414 0l-2-2a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                            <a href="#"
                                class="ml-1 text-sm font-medium text-gray-700 hover:text-gray-900 md:ml-2">Dashboard</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M7.293 9.293a1 1 0 011.414 0L10 10.586l1.293-1.293a1 1 0 111.414 1.414l-2 2a1 1 0 01-1.414 0l-2-2a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Overview</span>
                        </div>
                    </li>
                </ol>
            </nav>
            <div class="flex items-center">
                <span class="text-gray-800 font-medium">Wahyudi (Superuser)</span>
            </div>
        </div>
    </header> -->
    <div class="flex h-screen overflow-hidden">
        <div class="flex-shrink-0 bg-white h-screen w-auto overflow-y-auto">
            @include('admin.sidebar')
        </div>

        <div class="flex-1 h-screen overflow-y-auto">
            @yield('content')
        </div>
    </div>
</body>

</html>