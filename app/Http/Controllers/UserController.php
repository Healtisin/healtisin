<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use App\Helpers\LogHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // Ambil parameter role dari request (jika ada)
        $role = $request->query('role', 'user'); // Default: user

        // Jika role adalah 'user', ambil data dari tabel users
        if ($role === 'user') {
            $users = User::all();
        }
        // Jika role adalah 'admin', ambil data dari tabel admins
        elseif ($role === 'admin') {
            $users = Admin::all();
        }

        return view('admin.users.index', compact('users', 'role'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'mobile' => 'required|string|max:20',
            'email' => 'required|email|unique:users',
            'role' => 'required|in:user,admin', // Tambahkan validasi untuk role
            'password' => 'nullable|string|min:8', // Password opsional
        ]);

        // Generate password acak jika admin tidak memasukkan password
        $password = $validated['password'] ?? Str::random(8);

        // Simpan user baru berdasarkan role
        if ($validated['role'] === 'user') {
            $user = User::create([
                'name' => $validated['name'],
                'username' => $validated['username'],
                'mobile' => $validated['mobile'],
                'email' => $validated['email'],
                'password' => Hash::make($password), // Hash password
                'email_verified_at' => now(), // Langsung terverifikasi
                'is_active' => true, // Default status inactive
            ]);
        } elseif ($validated['role'] === 'admin') {
            $user = Admin::create([
                'name' => $validated['name'],
                'username' => $validated['username'],
                'mobile' => $validated['mobile'],
                'email' => $validated['email'],
                'password' => Hash::make($password), // Hash password
                'email_verified_at' => now(), // Langsung terverifikasi
                'is_active' => true, // Default status inactive
            ]);
        }

        // Generate URL aktivasi dengan parameter type
        $activationUrl = route('activate.account', [
            'id' => $user->id,
            'type' => $validated['role'], // Tambahkan parameter type
        ]);

        // Kirim email verifikasi tanpa Mailable class
        Mail::send('emails.adminverification', [
            'user' => $user,
            'password' => $password, // Kirim password ke email
        ], function ($message) use ($user) {
            $message->to($user->email) // Email penerima
                ->subject('Verifikasi Akun Anda'); // Subject email
        });

        // Tambahkan log
        LogHelper::info('user', "User baru ditambahkan: {$user->name}", [
            'user_id' => $user->id,
            'email' => $user->email
        ]);

        // Redirect dengan pesan sukses
        return redirect()
            ->route('admin.users', ['role' => $validated['role']]) // Redirect ke halaman sesuai role
            ->with('success', 'User created successfully. Password has been sent to email.')
            ->with('generated_password', $password); // Password untuk ditampilkan sekali
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'mobile' => 'required|string|max:20',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update($validated);

        // Tambahkan log
        LogHelper::info('user', "User diperbarui: {$user->name}", [
            'user_id' => $user->id,
            'changes' => $request->only(['name', 'email', 'status'])
        ]);

        return redirect()
            ->route('admin.users')
            ->with('success', 'User updated successfully.');
    }


    public function destroy(User $user)
    {
        $user->delete();

        // Tambahkan log
        LogHelper::info('user', "User dihapus: {$user->name}", [
            'user_id' => $user->id,
            'email' => $user->email
        ]);

        return redirect()
            ->route('admin.users')
            ->with('success', 'User deleted successfully.');
    }


    public function editAdmin(Admin $admin)
    {
        return view('admin.users.edit', compact('admin'));
    }
    public function updateAdmin(Request $request, Admin $admin)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:admins,username,' . $admin->id,
            'mobile' => 'required|string|max:20',
            'email' => 'required|email|unique:admins,email,' . $admin->id,
        ]);

        $admin->update($validated);

        return redirect()
            ->route('admin.users', ['role' => 'admin'])
            ->with('success', 'Admin updated successfully.');
    }
    public function destroyAdmin(Admin $admin)
    {
        $admin->delete();
        return redirect()
            ->route('admin.users', ['role' => 'admin'])
            ->with('success', 'Admin deleted successfully.');
    }
    public function updateProfile(Request $request)
    {
        // Ambil admin yang sedang login
        $admin = Auth::guard('admin')->user();

        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:admins,username,' . $admin->id,
            'email' => 'required|email|unique:admins,email,' . $admin->id,
            'phone' => 'required|string|max:20',
        ]);

        // Update data admin
        $admin->name = $validated['name'];
        $admin->username = $validated['username'];
        $admin->email = $validated['email'];
        $admin->phone = $validated['phone'];
        $admin->save(); // Simpan perubahan

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
    public function changePassword(Request $request)
    {
        // Ambil admin yang sedang login
        $admin = Auth::guard('admin')->user();

        // Validasi input
        $validated = $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        // Cek apakah current password benar
        if (!Hash::check($validated['current_password'], $admin->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Current password is incorrect']);
        }

        // Update password
        $admin->password = Hash::make($validated['new_password']);
        $admin->save(); // Simpan perubahan

        return redirect()->back()->with('success', 'Password changed successfully.');
    }
    public function uploadPhoto(Request $request)
    {
        // Ambil admin yang sedang login
        $admin = Auth::guard('admin')->user();

        // Validasi input
        $validated = $request->validate([
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Simpan foto ke storage
        if ($request->hasFile('profile_photo')) {
            $photoPath = $request->file('profile_photo')->store('profile-photos', 'public');
            $admin->profile_photo = $photoPath;
            $admin->save(); // Simpan perubahan
        }

        return redirect()->back()->with('success', 'Photo uploaded successfully.');
    }
    public function deletePhoto()
{
    $admin = Auth::guard('admin')->user();

    if ($admin->profile_photo) {
        Storage::delete('public/' . $admin->profile_photo);
        $admin->profile_photo = null;
        $admin->save();
    }

    return redirect()->back()->with('success', 'Foto profil berhasil dihapus.');
}

}
