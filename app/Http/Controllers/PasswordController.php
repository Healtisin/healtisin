<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class PasswordController extends Controller
{
    /**
     * Tampilkan halaman ubah password.
     */
    public function showChangePasswordForm()
    {
        return view('auth.passwords.change');
    }

    /**
     * Proses update password.
     */
    public function updatePassword(Request $request)
    {
        // Validasi input
        $data = $request->validate([
            'current_password' => 'required',
            'password'         => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        // Cek apakah password saat ini sesuai
        if (!Hash::check($data['current_password'], $user->password)) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Password saat ini salah'
                ], 422);
            }
            return back()->withErrors(['current_password' => 'Password saat ini salah']);
        }

        // Pastikan password baru tidak sama dengan password saat ini
        if (Hash::check($data['password'], $user->password)) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Password baru tidak boleh sama dengan password saat ini'
                ], 422);
            }
            return back()->withErrors(['password' => 'Password baru tidak boleh sama dengan password saat ini']);
        }

        // Update password
        $user->password = Hash::make($data['password']);
        $user->save();

        if ($request->wantsJson()) {
            return response()->json([
                'status'  => 'success',
                'message' => 'Password berhasil diubah'
            ]);
        }

        return redirect()->route('password.change')->with('success', 'Password berhasil diubah');
    }
}
