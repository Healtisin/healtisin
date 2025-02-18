<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Services\OtpService;

class RegisterController extends Controller
{
    protected $otpService;

    public function __construct(OtpService $otpService)
    {
        $this->otpService = $otpService;
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['nullable', 'string', 'max:15'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'is_active' => false
        ]);

        // Generate dan kirim OTP
        $otp = $this->otpService->createOtp($user->email, 'email_verification');
        $this->otpService->sendOtpEmail($user->email, $otp, 'email_verification');

        return view('auth.verify-email', ['email' => $user->email]);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|digits:6'
        ]);

        if (!$this->otpService->verifyOtp($request->email, $request->otp, 'email_verification')) {
            return back()->with('error', 'Kode OTP tidak valid atau sudah kadaluarsa.');
        }

        // Aktivasi user
        User::where('email', $request->email)->update([
            'is_active' => true,
            'email_verified_at' => now()
        ]);

        // Hapus data verifikasi
        $this->otpService->deleteOtp($request->email, 'email_verification');

        return redirect()->route('login')
            ->with('success', 'Akun berhasil diaktivasi! Silakan login.');
    }

    public function resendOtp(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)
                    ->where('is_active', false)
                    ->first();

        if (!$user) {
            return back()->with('error', 'Email tidak ditemukan atau akun sudah aktif.');
        }

        // Generate OTP baru
        $otp = $this->otpService->createOtp($user->email, 'email_verification');
        
        // Kirim ulang email OTP
        $this->otpService->sendOtpEmail($user->email, $otp, 'email_verification');

        return back()->with('success', 'Kode OTP baru telah dikirim ke email Anda.');
    }
}

