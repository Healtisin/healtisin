<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-[800px] flex">
            <!-- Form Section -->
            <div class="w-1/2 p-8">
                <h2 class="text-2xl font-semibold mb-6">Reset Password</h2>
                <p class="text-gray-600 text-sm mb-4">Masukkan password baru untuk akun Anda.</p>

                @if (session('error'))
                    <div class="bg-red-100 text-red-700 px-4 py-2 mb-4 rounded-md">{{ session('error') }}</div>
                @endif

                @if (session('success'))
                    <div class="bg-green-100 text-green-700 px-4 py-2 mb-4 rounded-md">{{ session('success') }}</div>
                @endif

                <form method="POST" action="{{ route('password.reset.submit') }}">
                    @csrf
                    <input type="hidden" name="email" value="{{ $email }}">

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Password Baru</label>
                        <input type="password" 
                               name="password" 
                               class="w-full px-3 py-2 border rounded-md bg-gray-50" 
                               placeholder="Masukkan password baru" 
                               required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                        <input type="password" 
                               name="password_confirmation" 
                               class="w-full px-3 py-2 border rounded-md bg-gray-50" 
                               placeholder="Konfirmasi password" 
                               required>
                    </div>

                    <button type="submit" class="w-full py-2 bg-[#24b0ba] text-white rounded-md hover:bg-[#1d8f98]">
                        Reset Password
                    </button>
                </form>
            </div>
            
            <!-- Illustration Section -->
            <div class="w-1/2 bg-[#24b0ba] p-8 text-white rounded-r-lg flex flex-col items-center justify-center">
                <h2 class="text-3xl font-semibold mb-4">Atur Ulang Password</h2>
                <p class="text-center">Pastikan password baru Anda aman dan mudah diingat.</p>
            </div>
        </div>
    </div>
</body>
</html>
