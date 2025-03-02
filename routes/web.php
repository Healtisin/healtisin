<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PricingController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PrivacyPolicyController;
use App\Http\Controllers\TermsOfUseController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);
    Route::post('verify/otp', [RegisterController::class, 'verifyOtp'])->name('verify.otp');
    Route::post('verify/resend-otp', [RegisterController::class, 'resendOtp'])->name('resend.otp');
    Route::get('forgot-password', [ForgotPasswordController::class, 'showEmailForm'])->name('password.request');
    Route::post('forgot-password/send-otp', [ForgotPasswordController::class, 'sendOtp'])->name('password.otp.send');
    Route::get('forgot-password/verify-otp', [ForgotPasswordController::class, 'showOtpForm'])->name('password.otp.form');
    Route::post('forgot-password/verify-otp', [ForgotPasswordController::class, 'verifyOtp'])->name('password.verify.otp');
    Route::post('forgot-password/resend-otp', [ForgotPasswordController::class, 'resendOtp'])->name('password.otp.resend');
    Route::get('reset-password/{email}', [ForgotPasswordController::class, 'showResetForm'])
        ->name('password.reset');
    Route::post('reset-password', [ForgotPasswordController::class, 'resetPassword'])
        ->name('password.update');
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

Route::get('/pricing/pro', [PricingController::class, 'showProPage'])->name('pricing.pro');

Route::get('/pricing/payment', [PaymentController::class, 'showPaymentPage'])->name('pricing.payment');

Route::middleware(['auth'])->group(function () {
    Route::post('/payments', [PaymentController::class, 'store'])->name('payment.store');
    Route::post('/payments/{payment}/proof', [PaymentController::class, 'uploadProof'])->name('payment.proof');
    Route::get('/pricing/select-package', [PaymentController::class, 'selectPackage'])
        ->name('pricing.select-package');
    Route::post('/pricing/payment-details', [PaymentController::class, 'paymentDetails'])
        ->name('pricing.payment-details');
    Route::post('/pricing/process-payment', [PaymentController::class, 'processPayment'])
        ->name('pricing.process-payment');
    Route::get('/pricing/payment-confirmation/{id}', [PaymentController::class, 'paymentConfirmation'])
        ->name('pricing.payment-confirmation');
    Route::post('/payment/notification', [PaymentController::class, 'handleNotification'])->name('payment.notification');
    Route::post('/pricing/payment/{payment}/upload-proof', [PaymentController::class, 'uploadPaymentProof'])
        ->name('pricing.upload-proof');
});
Route::post('/payment/notification', [PaymentController::class, 'handleNotification']);
Route::get('/payment/success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
Route::get('/payment/pending', [PaymentController::class, 'paymentPending'])->name('payment.pending');
Route::get('/payment/error', [PaymentController::class, 'paymentError'])->name('payment.error');
//ADMIN
Route::prefix('admin')->group(function () {
    // Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/users', [UserController::class, 'index'])->name('admin.users');
    Route::get('/users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');

    //Transaksi
    Route::get('/transactions', [TransactionController::class, 'index'])->name('admin.transactions');
    Route::delete('/transactions/{id}', [TransactionController::class, 'destroy'])->name('admin.transactions.destroy');

    //Payments
    Route::get('/payments', [PaymentController::class, 'index'])->name('admin.payments');

    //Pricing
    Route::get('/pricing', [PricingController::class, 'index'])->name('admin.pricing');

    //Messages
    Route::get('/messages', [MessageController::class, 'index'])->name('admin.messages');
    Route::delete('/messages/{id}', [MessageController::class, 'destroy'])->name('admin.messages.destroy');
});

Route::post('/profile/phone/update', [ProfileController::class, 'updatePhone'])->name('profile.phone.update');

Route::delete('/profile/delete', [ProfileController::class, 'destroy'])->name('profile.delete');

Route::get('/activate/{token}', [RegisterController::class, 'activate'])->name('activate');

Route::get('/chat/{id}', [ChatController::class, 'show'])->name('chat.show');
Route::post('/chat/history', [ChatController::class, 'storeHistory'])->name('chat.history.store');
Route::get('/chat/histories', [ChatController::class, 'getHistories']);
Route::delete('/chat/delete/{id}', [ChatController::class, 'deleteChat'])->name('chat.delete');
Route::post('/chat/send', [ChatController::class, 'sendMessage']);

Route::get('/faq', [FaqController::class, 'index'])->name('faq');
Route::post('/faq/question/{id}/{type?}', [FaqController::class, 'incrementClick'])->name('faq.increment');

Route::get('/berita', [NewsController::class, 'index'])->name('news.index');
Route::get('/berita/{slug}', [NewsController::class, 'show'])->name('news.show');

Route::get('/tentang-kami', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('partials.contact');
})->name('contact');

Route::prefix('partials')->group(function () {
    Route::get('/contact', [MessageController::class, 'create'])->name('partials.contact');
    Route::post('/contact', [MessageController::class, 'store'])->name('partials.contact.store');
});

Route::get('/privacy-policy', [PrivacyPolicyController::class, 'index'])->name('privacy.policy');
Route::get('/terms-of-use', [TermsOfUseController::class, 'index'])->name('terms.of.use');

Route::delete('/chat/delete-last-message/{chatId}', [ChatController::class, 'deleteLastMessage'])->middleware('auth');

