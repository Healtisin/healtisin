<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\SocialAccount;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProvideCallback()
    {
        try {
            $socialUser = Socialite::driver('google')
                ->stateless()
                ->user();
                
            \Log::info('Google User Data:', [
                'id' => $socialUser->getId(),
                'email' => $socialUser->getEmail(),
                'name' => $socialUser->getName()
            ]);
            
        } catch (Exception $e) {
            \Log::error('Socialite Error: ' . $e->getMessage());
            return redirect()->route('login')
                ->with('error', 'Terjadi kesalahan saat login dengan Google: ' . $e->getMessage());
        }

        try {
            $user = $this->findOrCreateUser($socialUser, 'google');
            auth()->login($user, true);
            
            return redirect()->route('home');
        } catch (Exception $e) {
            \Log::error('User Creation Error: ' . $e->getMessage());
            return redirect()->route('login')
                ->with('error', 'Terjadi kesalahan saat membuat user: ' . $e->getMessage());
        }
    }

    protected function findOrCreateUser($socialUser, $provider)
    {
        $socialAccount = SocialAccount::where('provider_id', $socialUser->getId())
            ->where('provider_name', $provider)
            ->first();

        if ($socialAccount) {
            return $socialAccount->user;
        }

        $user = User::where('email', $socialUser->getEmail())->first();

        if (!$user) {
            // Generate username dari email
            $username = Str::before($socialUser->getEmail(), '@');
            $baseUsername = $username;
            $counter = 1;
            
            // Pastikan username unik
            while (User::where('username', $username)->exists()) {
                $username = $baseUsername . $counter;
                $counter++;
            }

            $user = User::create([
                'name' => $socialUser->getName(),
                'email' => $socialUser->getEmail(),
                'username' => $username,
                'password' => Hash::make(Str::random(16))
            ]);
        }

        $user->socialAccounts()->create([
            'provider_id' => $socialUser->getId(),
            'provider_name' => $provider
        ]);

        return $user;
    }
}
