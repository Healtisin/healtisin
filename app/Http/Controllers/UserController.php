<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Pastikan model User di-import

class UserController extends Controller
{
    // Menampilkan daftar user
    public function index()
    {
        $users = User::all(); // Ambil semua data user dari database
        return view('admin.users.index', compact('users'));
    }

    // Menampilkan form untuk membuat user baru
    public function create()
    {
        return view('admin.users.create');
    }

    // Menyimpan user baru ke database
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|string|max:20',
            'email' => 'required|email|unique:users,email',
            'status' => 'required|in:Active,Inactive',
        ]);

        // Simpan data ke database
        User::create($request->all());

        // Redirect ke halaman daftar user dengan pesan sukses
        return redirect()->route('admin.users.index')
            ->with('success', 'User created successfully.');
    }

    // Menampilkan form untuk mengedit user
    public function edit(User $user)
    {
        return view('admin.users.update', compact('user'));
    }

    // Mengupdate data user di database
    public function update(Request $request, User $user)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|string|max:20',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'status' => 'required|in:Active,Inactive',
        ]);

        // Update data di database
        $user->update($request->all());

        // Redirect ke halaman daftar user dengan pesan sukses
        return redirect()->route('admin.users.index')
            ->with('success', 'User updated successfully.');
    }
}
