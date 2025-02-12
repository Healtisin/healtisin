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
            <div class="w-1/2 bg-[#ff5c7c] p-8 text-white rounded-l-lg flex flex-col items-center justify-center">
                <h2 class="text-3xl font-semibold mb-4">Welcome Back!</h2>
                <p class="mb-6">Already have an account?</p>
                <a href="{{ route('login') }}" class="px-6 py-2 border-2 border-white rounded-full hover:bg-white hover:text-[#ff5c7c]">
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
                    <button type="submit" class="w-full py-2 bg-[#ff5c7c] text-white rounded-md hover:bg-[#ff4367]">
                        Sign Up
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
