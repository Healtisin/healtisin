<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Helpers\InformationHelper;
use App\Models\Otp;

class OtpService
{
    public function generateOtp(): string
    {
        return str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
    }

    public function createOtp(string $email, string $type): string
    {
        $otp = $this->generateOtp();

        DB::table('otps')->updateOrInsert(
            ['email' => $email, 'type' => $type],
            ['otp' => $otp, 'created_at' => now()]
        );

        return $otp;
    }

    public function verifyOtp(string $email, string $otp, string $type): bool
    {
        $otpData = DB::table('otps')
            ->where('email', $email)
            ->where('otp', $otp)
            ->where('type', $type)
            ->first();

        if (!$otpData) {
            return false;
        }

        if (Carbon::parse($otpData->created_at)->addMinutes(5)->isPast()) {
            return false;
        }

        return true;
    }

    public function deleteOtp(string $email, string $type): void
    {
        DB::table('otps')
            ->where('email', $email)
            ->where('type', $type)
            ->delete();
    }

    public function sendOtpEmail(string $email, string $otp, string $type): void
    {
        $view = $type === 'email_verification' 
            ? 'emails.verification-otp'
            : 'emails.reset-password-otp';

        $subject = $type === 'email_verification'
            ? 'Kode OTP Verifikasi - ' . InformationHelper::getProductName()
            : 'Kode OTP Reset Password - ' . InformationHelper::getProductName();

        Mail::send($view, ['otp' => $otp], function($message) use ($email, $subject) {
            $message->to($email)->subject($subject);
        });
    }
}