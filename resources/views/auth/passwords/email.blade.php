<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset Password - Healtisin AI</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-[500px] p-8">
            <h2 class="text-2xl font-semibold mb-6">Reset Password</h2>
            
            @if (session('status'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">EMAIL ADDRESS</label>
                    <input type="email" name="email" class="w-full px-3 py-2 border rounded-md bg-gray-50" required>
                    @error('email')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="w-full py-2 bg-[#ff5c7c] text-white rounded-md hover:bg-[#ff4367]">
                    Send Password Reset Link
                </button>
            </form>
            
            <div class="mt-4 text-center">
                <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-[#ff5c7c]">
                    Back to Login
                </a>
            </div>
        </div>
    </div>
</body>
</html>
