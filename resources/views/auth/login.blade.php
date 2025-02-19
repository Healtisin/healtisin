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
                
                @if (session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <input type="hidden" name="redirect" value="{{ request('redirect') }}">
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
                            <input type="checkbox" name="remember" class="text-[#24b0ba]">
                            <span class="ml-2 text-sm">Remember Me</span>
                        </div>
                        <a href="{{ route('password.request') }}" class="text-sm text-gray-600">Forgot Password</a>
                    </div>
                    <button type="submit" class="w-full py-2 bg-[#24b0ba] text-white rounded-md hover:bg-[#1d8f98]">
                        Sign In
                    </button>
                </form>
                <div class="mt-4">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-white text-gray-500">Or continue with</span>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <a href="{{ route('google.login') }}" 
                           class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                            <img src="https://www.google.com/favicon.ico" alt="Google" class="h-5 w-5 mr-2">
                            Continue with Google
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Welcome Section -->
            <div class="w-1/2 bg-[#24b0ba] p-8 text-white rounded-r-lg flex flex-col items-center justify-center">
                <h2 class="text-3xl font-semibold mb-4">Welcome to login</h2>
                <p class="mb-6">Don't have an account?</p>
                <a href="{{ route('register') }}" class="px-6 py-2 border-2 border-white rounded-full hover:bg-white hover:text-[#24b0ba]">
                    Sign Up
                </a>
            </div>
        </div>
    </div>
</body>
</html>
