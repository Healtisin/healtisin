<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Healtisin AI</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">
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