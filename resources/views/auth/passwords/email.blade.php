<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - Healtisin AI</title>
    @include('partials.dark-mode-init')
    @vite('resources/css/app.css')
    @vite('resources/js/translate.js')
    @include('lang.language-modal')
</head>
<style>
    .error-container {
        min-height: 60px; /* Atur tinggi tetap */
    }
</style>

<body class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200 transition-colors duration-200">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg w-[800px] flex">
            <!-- Form Section -->
            <div class="w-1/2 p-8">
                <h2 class="text-2xl font-semibold mb-6 dark:text-gray-200">Forgot Password</h2>
                <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">Masukkan email Anda untuk menerima kode OTP.</p>

                <div class="error-container">
    @if (session('error'))
        <div class="bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-200 px-4 py-2 mb-4 rounded-md">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->has('email'))
        <div class="bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-200 px-4 py-2 mb-4 rounded-md">
            {{ $errors->first('email') }}
        </div>
    @endif
</div>


@if (session('success'))
    <div class="bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-200 px-4 py-2 mb-4 rounded-md">{{ session('success') }}</div>
@endif

                <form method="POST" action="{{ route('password.otp.send') }}">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">EMAIL</label>
                        <input type="email" 
                               name="email" 
                               class="w-full px-3 py-2 border rounded-md bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200" 
                               placeholder="Masukkan email Anda" 
                               required>
                    </div>
                    <button type="submit" class="w-full py-2 bg-[#24b0ba] text-white rounded-md hover:bg-[#1d8f98]">
                        Kirim OTP
                    </button>
                </form>

                <div class="mt-6 text-sm text-center">
                    <a href="{{ route('login') }}" class="text-gray-600 dark:text-gray-400 hover:text-[#24b0ba] dark:hover:text-[#73c7e3]">Kembali ke Login</a>
                </div>
            </div>
            
            <!-- Illustration Section -->
            <div class="w-1/2 bg-[#24b0ba] p-8 text-white rounded-r-lg flex flex-col items-center justify-center">
                <h2 class="text-3xl font-semibold mb-4">Lupa Password?</h2>
                <p class="text-center">Jangan khawatir! Masukkan email Anda dan kami akan mengirimkan kode OTP untuk reset password.</p>
            </div>
        </div>
    </div>
</body>
</html>
