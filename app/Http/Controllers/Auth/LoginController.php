<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Admin;
class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $input = $request->get('login');
        $field = filter_var($input, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
    
        // Cari user atau admin
        $user = User::where($field, $input)->first();
        $admin = Admin::where($field, $input)->first();
    
        // Jika tidak ditemukan
        if (!$user && !$admin) {
            return back()->withErrors([
                'login' => 'Username/email atau password salah.',
            ])->withInput($request->only('login', 'remember'));
        }
    
        // Tentukan model dan guard
        $model = $user ? $user : $admin;
        $guard = $user ? 'web' : 'admin';
    
        // Jika akun belum aktif
        if (!$model->is_active) {
            return back()->withErrors([
                'login' => 'Akun Anda belum diaktivasi. Silakan cek email untuk aktivasi.',
            ])->withInput($request->only('login', 'remember'));
        }
    
        // Coba login
        $credentials = [
            $field => $input,
            'password' => $request->get('password'),
        ];
    
        if (Auth::guard($guard)->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
    
            // Redirect berdasarkan guard
            if ($guard === 'admin') {
                return redirect()->route('admin.dashboard'); // Redirect ke dashboard admin
            }
    
            return redirect()->intended(route('home')); // Redirect ke home untuk user
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
