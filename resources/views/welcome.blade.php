<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Healtisin AI</title>
    @vite('resources/css/app.css')
</head>

<body>
    @include('partials.header')

    <main class="pt-24 pb-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Hero Section -->
            @include('partials.hero')

            <!-- Capabilities Section -->
            @include('partials.capabilities')

            <!-- Pricing Section -->
            @include('partials.pricing')

            <!-- Why Healtisin Section -->
            @include('partials.benefits')
        </div>
    </main>

    @include('partials.footer')
</body>

</html>