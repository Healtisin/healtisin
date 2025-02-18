<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Services\OtpService;

class ForgotPasswordController extends Controller
{
    protected $otpService;

    public function __construct(OtpService $otpService)
    {
        $this->otpService = $otpService;
    }

    // Menampilkan form input email
    public function showEmailForm()
    {
        return view('auth.passwords.email');
    }

    // Mengirim OTP ke email
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        try {
            $otp = $this->otpService->createOtp($request->email, 'password_reset');
            $this->otpService->sendOtpEmail($request->email, $otp, 'password_reset');

            return redirect()->route('password.otp.form')->with([
                'success' => 'Kode OTP telah dikirim ke email Anda.',
                'email' => $request->email
            ]);
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengirim email. Silakan coba lagi.');
        }
    }
    

    // Menampilkan form OTP
    public function showOtpForm(Request $request)
    {
        return view('auth.passwords.otp', ['email' => session('email')]);
    }

    // Verifikasi OTP
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|digits:6',
        ]);

        $otpData = DB::table('password_resets')->where('email', $request->email)->first();

        if (!$otpData || $otpData->token != $request->otp) {
            return back()->with('error', 'Kode OTP salah atau sudah kadaluarsa.');
        }

        // Cek apakah OTP masih berlaku (5 menit)
        if (Carbon::parse($otpData->created_at)->addMinutes(5)->isPast()) {
            return back()->with('error', 'Kode OTP sudah kadaluarsa.');
        }

        // Redirect ke reset password dengan menyertakan email di URL
        return redirect()->route('password.reset', ['email' => $request->email]);
    }

    // Menampilkan form reset password
    public function showResetForm($email)
    {
        return view('auth.passwords.reset', ['email' => $email]);
    }

    // Reset password
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::where('email', $request->email)->update([
            'password' => Hash::make($request->password),
        ]);

        // Hapus OTP setelah berhasil reset password
        DB::table('password_resets')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('success', 'Password berhasil direset.');
    }

    // Kirim ulang OTP
    public function resendOtp(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        try {
            $otp = $this->otpService->createOtp($request->email, 'password_reset');
            $this->otpService->sendOtpEmail($request->email, $otp, 'password_reset');

            return back()->with([
                'success' => 'OTP baru telah dikirim ke email Anda.',
                'email' => $request->email
            ]);
        } catch (\Exception $e) {
            Log::error("Gagal mengirim ulang OTP: " . $e->getMessage());
            return back()->with('error', 'Gagal mengirim ulang OTP. Silakan coba lagi.');
        }
    }
}
