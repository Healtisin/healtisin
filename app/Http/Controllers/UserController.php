<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
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
            'role' => 'required|in:user,admin',
            'password' => 'nullable|string|min:8', // Password opsional
        ]);
    
        // Generate password acak jika admin tidak memasukkan password
        $password = $validated['password'] ?? Str::random(8);
    
        // Simpan user baru
        $user = User::create([
            'name' => $validated['name'],
            'username' => $validated['username'],
            'mobile' => $validated['mobile'],
            'email' => $validated['email'],
            'password' => Hash::make($password), // Hash password
            'role' => $validated['role'],
            'is_active' => false, // Default status inactive
        ]);
    
        // Generate URL aktivasi (tanpa signed URL)
        $activationUrl = route('activate.account', ['id' => $user->id]);
    
        // Kirim email verifikasi tanpa Mailable class
        Mail::send('emails.adminverification', [
            'user' => $user,
            'activationUrl' => $activationUrl,
            'password' => $password, // Kirim password ke email
        ], function ($message) use ($user) {
            $message->to($user->email) // Email penerima
                    ->subject('Verifikasi Akun Anda'); // Subject email
        });
    
        // Redirect dengan pesan sukses
        return redirect()
            ->route('admin.users')
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
            'role' => 'required|in:user,admin',
        ]);

        $user->update($validated);

        return redirect()
            ->route('admin.users')
            ->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()
            ->route('admin.users')
            ->with('success', 'User deleted successfully.');
    }

        // Method untuk aktivasi akun
        public function activateAccount($id)
        {
            // Cari user berdasarkan ID
            $user = User::find($id);
        
            // Jika user tidak ditemukan
            if (!$user) {
                return redirect()->route('login')->with('error', 'User not found.');
            }
        
            // Update kolom email_verified_at dan is_active
            $user->update([
                'email_verified_at' => now(), // Set waktu sekarang
                'is_active' => true, // Set status aktif
            ]);
        
            // Redirect ke halaman login dengan pesan sukses
            return redirect()->route('login')->with('success', 'Akun Anda berhasil diaktivasi. Silakan login.');
        }
}
