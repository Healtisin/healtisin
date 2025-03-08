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
                'is_active' => false, // Default status inactive
            ]);
        } elseif ($validated['role'] === 'admin') {
            $user = Admin::create([
                'name' => $validated['name'],
                'username' => $validated['username'],
                'mobile' => $validated['mobile'],
                'email' => $validated['email'],
                'password' => Hash::make($password), // Hash password
                'is_active' => false, // Default status inactive
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
            'activationUrl' => $activationUrl,
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
            ->with('success', 'User created successfully. Please check email for activation.')
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

    // Method untuk aktivasi akun
    public function activateAccount($id, $type = 'user')
    {
        // Cari user atau admin berdasarkan ID dan tipe
        if ($type === 'user') {
            $user = User::find($id);
        } elseif ($type === 'admin') {
            $user = Admin::find($id);
        } else {
            return redirect()->route('login')->with('error', 'Tipe akun tidak valid.');
        }
    
        // Jika user/admin tidak ditemukan
        if (!$user) {
            return redirect()->route('login')->with('error', 'Akun tidak ditemukan.');
        }
    
        // Update kolom email_verified_at dan is_active
        $user->update([
            'email_verified_at' => now(), // Set waktu sekarang
            'is_active' => true, // Set status aktif
        ]);
    
        // Redirect ke halaman login dengan pesan sukses
        return redirect()->route('login')->with('success', 'Akun Anda berhasil diaktivasi. Silakan login.');
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
}
