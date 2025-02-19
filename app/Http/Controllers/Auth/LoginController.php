<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $input = $request->get('login');
        
        $credentials = [];
        $field = filter_var($input, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $credentials[$field] = $input;
        $credentials['password'] = $request->get('password');
        $credentials['is_active'] = true;

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
        
            // Ambil redirect dari input form, jika kosong arahkan ke home
            $redirectTo = $request->input('redirect', route('home'));
        
            return redirect($redirectTo);
        }
        

        return back()->withErrors([
            'login' => 'Username/email atau password salah, atau akun belum diaktivasi.',
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
