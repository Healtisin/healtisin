<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
            'status' => 'required|in:Active,Inactive',
        ]);

        // Generate password acak
        $password = Str::random(8);

        // Tambahkan password ke data yang akan disimpan
        $userData = array_merge($validated, [
            'password' => Hash::make($password),
        ]);

        // Simpan user baru
        $user = User::create($userData);

        // Redirect dengan pesan sukses
        return redirect()
            ->route('admin.users')
            ->with('success', 'User created successfully.')
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
            'status' => 'required|in:Active,Inactive',
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
}
