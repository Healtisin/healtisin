<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $input = $request->get('login');
    
        // Tentukan field login (email atau username)
        $field = filter_var($input, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
    
        // Cari user berdasarkan email atau username
        $user = User::where($field, $input)->first();
    
        // Jika user tidak ditemukan
        if (!$user) {
            return back()->withErrors([
                'login' => 'Username/email atau password salah.',
            ])->withInput($request->only('login', 'remember'));
        }
    
        // Jika akun belum aktif
        if (!$user->is_active) {
            return back()->withErrors([
                'login' => 'Akun Anda belum diaktivasi. Silakan cek email untuk aktivasi.',
            ])->withInput($request->only('login', 'remember'));
        }
    
        // Coba login
        $credentials = [
            $field => $input,
            'password' => $request->get('password'),
        ];
    
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
    
            // Redirect berdasarkan role
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard'); // Redirect ke dashboard admin
            }
    
            // Periksa apakah ada parameter redirect
            $redirectUrl = $request->input('redirect');
            if ($redirectUrl) {
                return redirect()->to($redirectUrl); // Redirect ke URL yang diminta
            }
    
            return redirect()->intended(route('home')); // Default redirect ke home
        }
    
        // Jika login gagal
        return back()->withErrors([
            'login' => 'Username/email atau password salah.',
        ])->withInput($request->only('login', 'remember'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
