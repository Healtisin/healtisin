<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email - Healtisin AI</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-[800px] flex">
            <!-- Form Section -->
            <div class="w-1/2 p-8">
                <h2 class="text-2xl font-semibold mb-6">Verifikasi Email</h2>
                
                @if (session('error'))
                    <div class="bg-red-100 text-red-700 px-4 py-2 mb-4 rounded-md">
                        {{ session('error') }}
                    </div>
                @endif

                @if (session('success'))
                    <div class="bg-green-100 text-green-700 px-4 py-2 mb-4 rounded-md">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('verify.otp') }}">
                    @csrf
                    <input type="hidden" name="email" value="{{ $email }}">
                    
                    <div class="mb-6">
                        <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-4">
                            <p class="text-blue-700">Kode OTP telah dikirim ke email:</p>
                            <p class="font-medium mt-1">{{ $email }}</p>
                        </div>
                        
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kode OTP</label>
                        <input type="text" 
                               name="otp" 
                               class="w-full px-3 py-2 border rounded-md bg-gray-50 text-center tracking-widest text-xl" 
                               placeholder="Masukkan kode OTP"
                               maxlength="6"
                               required>
                        @error('otp')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="w-full py-2 bg-[#24b0ba] text-white rounded-md hover:bg-[#1d8f98]">
                        Verifikasi
                    </button>
                </form>

                <div class="mt-6 text-sm text-center">
                    <form action="{{ route('resend.otp') }}" method="POST">
                        @csrf
                        <input type="hidden" name="email" value="{{ $email }}">
                        <button type="submit" class="text-gray-600 hover:text-[#24b0ba]">
                            Kirim ulang kode OTP
                        </button>
                    </form>
                </div>
            </div>
            
            <!-- Illustration Section -->
            <div class="w-1/2 bg-[#24b0ba] p-8 text-white rounded-r-lg flex flex-col items-center justify-center">
                <h2 class="text-3xl font-semibold mb-4">Satu Langkah Lagi!</h2>
                <p class="text-center">Masukkan kode OTP untuk mengaktifkan akun Anda.</p>
            </div>
        </div>
    </div>
</body>
</html>