<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{
    public function updateName(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->save();

        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Nama berhasil diubah'
            ]);
        }

        return back()->with('success', 'Nama berhasil diubah');
    }

    public function updatePhoto(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|max:2048'
        ]);

        $user = Auth::user();

        if ($user->profile_photo) {
            Storage::disk('public')->delete($user->profile_photo);
        }

        $path = $request->file('photo')->store('profile-photos', 'public');
        $user->profile_photo = $path;
        $user->save();

        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Foto profil berhasil diubah',
                'photo_url' => asset('storage/' . $path)
            ]);
        }

        return back()->with('success', 'Foto profil berhasil diubah');
    }

    public function updatePhone(Request $request)
    {
        $request->validate([
            'phone' => 'required|string|max:20|regex:/^[0-9]+$/',
        ], [
            'phone.required' => 'Nomor telepon wajib diisi',
            'phone.max' => 'Nomor telepon maksimal 20 karakter',
            'phone.regex' => 'Nomor telepon hanya boleh berisi angka'
        ]);

        $user = Auth::user();
        $user->phone = $request->phone;
        $user->save();

        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Nomor telepon berhasil diubah'
            ]);
        }

        return back()->with('success', 'Nomor telepon berhasil diubah');
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'password' => 'required',
        ]);

        $user = Auth::user();

        // Verifikasi password
        if (!Hash::check($request->password, $user->password)) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Password yang Anda masukkan salah'
                ], 422);
            }
            throw ValidationException::withMessages([
                'password' => ['Password yang Anda masukkan salah'],
            ]);
        }

        // Hapus foto profil jika ada
        if ($user->profile_photo) {
            Storage::disk('public')->delete($user->profile_photo);
        }

        // Hapus user
        $user->delete();

        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Akun berhasil dihapus'
            ]);
        }

        return redirect('/login')->with('success', 'Akun berhasil dihapus');
    }

    public function deletePhoto()
    {
        $user = Auth::user();
        
        // Hapus file foto dari storage
        if ($user->profile_photo) {
            Storage::disk('public')->delete($user->profile_photo);
            $user->profile_photo = null;
            $user->save();
        }
        
        if (request()->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Foto profil berhasil dihapus'
            ]);
        }
        
        return back()->with('success', 'Foto profil berhasil dihapus');
    }
}
