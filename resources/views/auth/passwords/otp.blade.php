<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi OTP</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-[800px] flex">
            <!-- Form Section -->
            <div class="w-1/2 p-8">
                <h2 class="text-2xl font-semibold mb-6">Verifikasi OTP</h2>
                <p class="text-gray-600 text-sm mb-4">Masukkan kode OTP yang dikirimkan ke email Anda.</p>

                @if (session('error'))
                    <div class="bg-red-100 text-red-700 px-4 py-2 mb-4 rounded-md">{{ session('error') }}</div>
                @endif

                <form action="{{ route('password.verify.otp') }}" method="POST">
                    @csrf
                    <input type="hidden" name="email" value="{{ old('email', session('email')) }}">

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kode OTP</label>
                        <input type="text" 
                               name="otp" 
                               class="w-full px-3 py-2 border rounded-md bg-gray-50 text-center tracking-widest text-xl" 
                               placeholder="123456" 
                               required>
                    </div>

                    <button type="submit" class="w-full py-2 bg-[#24b0ba] text-white rounded-md hover:bg-[#1d8f98]">
                        Verifikasi
                    </button>
                </form>

                <div class="mt-6 text-sm text-center">
                    <form action="{{ route('password.otp.resend') }}" method="POST">
                        @csrf
                        <input type="hidden" name="email" value="{{ old('email', session('email')) }}">
                        <button type="submit" class="text-gray-600 hover:text-[#24b0ba]">
                            Kirim ulang OTP
                        </button>
                    </form>
                </div>
            </div>
            
            <!-- Illustration Section -->
            <div class="w-1/2 bg-[#24b0ba] p-8 text-white rounded-r-lg flex flex-col items-center justify-center">
                <h2 class="text-3xl font-semibold mb-4">Verifikasi Akun</h2>
                <p class="text-center">Masukkan kode OTP yang telah dikirim ke email Anda untuk melanjutkan proses reset password.</p>
            </div>
        </div>
    </div>
</body>
</html>
