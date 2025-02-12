<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - Healtisin AI</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-[800px] flex">
            <!-- Welcome Section -->
            <div class="w-1/2 bg-[#24b0ba] p-8 text-white rounded-l-lg flex flex-col items-center justify-center">
                <h2 class="text-3xl font-semibold mb-4">Welcome Back!</h2>
                <p class="mb-6">Already have an account?</p>
                <a href="{{ route('login') }}" class="px-6 py-2 border-2 border-white rounded-full hover:bg-white hover:text-[#24b0ba]">
                    Sign In
                </a>
            </div>

            <!-- Form Section -->
            <div class="w-1/2 p-8">
                <h2 class="text-2xl font-semibold mb-6">Create Account</h2>
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">NAME</label>
                        <input type="text" name="name" class="w-full px-3 py-2 border rounded-md bg-gray-50" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">EMAIL</label>
                        <input type="email" name="email" class="w-full px-3 py-2 border rounded-md bg-gray-50" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">USERNAME</label>
                        <input type="text" name="username" class="w-full px-3 py-2 border rounded-md bg-gray-50" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">PASSWORD</label>
                        <input type="password" name="password" class="w-full px-3 py-2 border rounded-md bg-gray-50" required>
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1">CONFIRM PASSWORD</label>
                        <input type="password" name="password_confirmation" class="w-full px-3 py-2 border rounded-md bg-gray-50" required>
                    </div>
                    <button type="submit" class="w-full py-2 bg-[#24b0ba] text-white rounded-md hover:bg-[#1d8f98]">
                        Sign Up
                    </button>
                </form>

                <!-- Tambahkan setelah form register -->
                <div class="mt-4">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-white text-gray-500">Atau daftar dengan</span>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <a href="{{ url('auth/google') }}" 
                           class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                            <img src="https://www.google.com/favicon.ico" alt="Google" class="h-5 w-5 mr-2">
                            Daftar dengan Google
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
