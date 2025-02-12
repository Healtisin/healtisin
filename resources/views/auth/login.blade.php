<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Healtisin AI</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-[800px] flex">
            <!-- Form Section -->
            <div class="w-1/2 p-8">
                <h2 class="text-2xl font-semibold mb-6">Sign In</h2>
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">USERNAME / EMAIL</label>
                        <input type="text" 
                               name="login" 
                               value="{{ old('login') }}"
                               class="w-full px-3 py-2 border rounded-md bg-gray-50" 
                               placeholder="Masukkan username atau email">
                        @error('login')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1">PASSWORD</label>
                        <input type="password" 
                               name="password" 
                               class="w-full px-3 py-2 border rounded-md bg-gray-50" 
                               placeholder="Masukkan password">
                        @error('password')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center">
                            <input type="checkbox" name="remember" class="text-[#ff5c7c]">
                            <span class="ml-2 text-sm">Remember Me</span>
                        </div>
                        <a href="{{ route('password.request') }}" class="text-sm text-gray-600">Forgot Password</a>
                    </div>
                    <button type="submit" class="w-full py-2 bg-[#ff5c7c] text-white rounded-md hover:bg-[#ff4367]">
                        Sign In
                    </button>
                </form>
            </div>
            
            <!-- Welcome Section -->
            <div class="w-1/2 bg-[#ff5c7c] p-8 text-white rounded-r-lg flex flex-col items-center justify-center">
                <h2 class="text-3xl font-semibold mb-4">Welcome to login</h2>
                <p class="mb-6">Don't have an account?</p>
                <a href="{{ route('register') }}" class="px-6 py-2 border-2 border-white rounded-full hover:bg-white hover:text-[#ff5c7c]">
                    Sign Up
                </a>
            </div>
        </div>
    </div>
</body>
</html>
