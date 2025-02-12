<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);
    Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])
        ->name('password.request');
    Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
        ->name('password.email');
    Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])
        ->name('password.reset');
    Route::post('reset-password', [ResetPasswordController::class, 'reset'])
        ->name('password.update');
});

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

