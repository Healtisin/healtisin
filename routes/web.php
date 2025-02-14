<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\PaymentController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);
    Route::get('forgot-password', [ForgotPasswordController::class, 'showForgotForm'])->name('password.forgot');
    Route::post('forgot-password', [ForgotPasswordController::class, 'sendOtp'])->name('password.otp.send');
    Route::get('/password/otp', [ForgotPasswordController::class, 'showOtpForm'])->name('password.otp.form');
    Route::post('/password/verify-otp', [ForgotPasswordController::class, 'verifyOtp'])->name('password.verify.otp');
    Route::get('reset-password/{email}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('password.reset.submit');
    Route::post('/password/otp/resend', [ForgotPasswordController::class, 'resendOtp'])->name('password.otp.resend');
});
Route::get('/password/reset', function () {
    return view('auth.passwords.email');
})->name('password.request');


Route::post('logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/home', function () {
        return view('home');
    })->name('home');
    
    Route::get('/change-password', [PasswordController::class, 'showChangePasswordForm'])
         ->name('password.change');
    Route::post('/change-password', [PasswordController::class, 'updatePassword'])
         ->name('password.change.update');
});

Route::post('/verify-password', [PasswordController::class, 'verifyPassword'])->name('password.verify');

/**
 * Socialite auth routes
 */
Route::prefix('auth')->group(function () {
    Route::get('/google', [SocialiteController::class, 'redirectToProvider'])->name('google.login');
    Route::get('/callback', [SocialiteController::class, 'handleProvideCallback'])->name('google.callback');
});

Route::post('/profile/name', [ProfileController::class, 'updateName'])->name('profile.name.update');

Route::post('/chat/send', [ChatController::class, 'sendMessage'])->name('chat.send');

Route::post('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.photo.update');

Route::post('/language/change', [LanguageController::class, 'change'])->name('language.change');

Route::get('/pricing/pro', function () {
    return view('pricing.pro');
})->name('pricing.pro');

Route::middleware(['auth'])->group(function () {
    Route::post('/payments', [PaymentController::class, 'store'])->name('payment.store');
    Route::post('/payments/{payment}/proof', [PaymentController::class, 'uploadProof'])->name('payment.proof');
});