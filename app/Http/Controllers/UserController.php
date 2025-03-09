<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use App\Models\ChatHistory;
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
        // Ambil parameter dari request
        $sort = $request->query('sort', 'name'); // Default: sort by name
        $direction = $request->query('direction', 'asc'); // Default: ascending
        $search = $request->query('search', ''); // Default: no search
        $perPage = 10; // Jumlah item per halaman
        
        // Buat query builder untuk User
        $query = User::query();

        // Tambahkan pencarian jika ada
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('username', 'like', "%{$search}%");
            });
        }

        // Tambahkan sorting
        if (in_array($sort, ['name', 'username', 'email', 'is_active'])) {
            $query->orderBy($sort, $direction);
        }

        // Ambil data dengan paginasi
        $users = $query->paginate($perPage)->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    public function adminIndex(Request $request)
    {
        // Ambil parameter dari request
        $sort = $request->query('sort', 'name'); // Default: sort by name
        $direction = $request->query('direction', 'asc'); // Default: ascending
        $search = $request->query('search', ''); // Default: no search
        $perPage = 10; // Jumlah item per halaman
        
        // Buat query builder untuk Admin
        $query = Admin::query();

        // Tambahkan pencarian jika ada
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('username', 'like', "%{$search}%");
            });
        }

        // Tambahkan sorting
        if (in_array($sort, ['name', 'username', 'email', 'is_active'])) {
            $query->orderBy($sort, $direction);
        }

        // Ambil data dengan paginasi
        $users = $query->paginate($perPage)->withQueryString();

        return view('admin.users.index-admin', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function createAdmin()
    {
        return view('admin.users.create-admin');
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'subscription_status' => 'required|string|in:free,premium',
            'is_active' => 'required|boolean',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Upload foto profile jika ada
        $profilePhoto = null;
        if ($request->hasFile('profile_photo')) {
            $profilePhoto = $request->file('profile_photo')->store('profile-photos', 'public');
        }

        // Simpan user baru
        $user = User::create([
            'name' => $validated['name'],
            'username' => $validated['username'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'profile_photo' => $profilePhoto,
            'subscription_status' => $validated['subscription_status'],
            'email_verified_at' => now(), // Langsung terverifikasi
            'is_active' => $validated['is_active'],
        ]);

        // Tambahkan log
        LogHelper::info('user', "User baru dibuat: {$user->name}", [
            'user_id' => $user->id,
        ]);

        return redirect()
            ->route('admin.users')
            ->with('success', 'Pengguna berhasil ditambahkan!');
    }

    public function storeAdmin(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:admins',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|unique:admins',
            'password' => 'required|string|min:8',
            'subscription_status' => 'required|string|in:free,premium',
            'is_active' => 'required|boolean',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Upload foto profile jika ada
        $profilePhoto = null;
        if ($request->hasFile('profile_photo')) {
            $profilePhoto = $request->file('profile_photo')->store('profile-photos', 'public');
        }

        // Simpan admin baru
        $admin = Admin::create([
            'name' => $validated['name'],
            'username' => $validated['username'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'profile_photo' => $profilePhoto,
            'subscription_status' => $validated['subscription_status'],
            'email_verified_at' => now(), // Langsung terverifikasi
            'is_active' => $validated['is_active'],
        ]);

        // Tambahkan log
        LogHelper::info('admin', "Admin baru dibuat: {$admin->name}", [
            'admin_id' => $admin->id,
        ]);

        return redirect()
            ->route('admin.admins')
            ->with('success', 'Admin berhasil ditambahkan!');
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
            'phone' => 'required|string|max:20',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'is_active' => 'required|boolean',
            'subscription_status' => 'required|string|in:free,premium',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Jika ada password baru, gunakan bcrypt
        if (!empty($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }

        // Upload foto profile jika ada
        if ($request->hasFile('profile_photo')) {
            // Hapus foto lama jika ada
            if ($user->profile_photo) {
                Storage::delete('public/' . $user->profile_photo);
            }
            
            $path = $request->file('profile_photo')->store('profile-photos', 'public');
            $validated['profile_photo'] = $path;
        }

        $user->update($validated);

        // Tambahkan log
        LogHelper::info('user', "User diperbarui: {$user->name}", [
            'user_id' => $user->id,
            'changes' => array_diff_assoc($validated, $user->getOriginal())
        ]);

        return redirect()
            ->route('admin.users.edit', $user->id)
            ->with('success', 'Pengguna berhasil diperbarui!');
    }


    public function destroy(User $user)
    {
        $user->delete();

        // Tambahkan log
        LogHelper::info('user', "User dihapus: {$user->name}", [
            'user_id' => $user->id
        ]);

        return redirect()
            ->route('admin.users')
            ->with('success', 'Pengguna berhasil dihapus!');
    }

    public function deleteUserPhoto(User $user)
    {
        if ($user->profile_photo) {
            // Hapus file foto dari storage
            Storage::delete('public/' . $user->profile_photo);
            
            // Update data user (set profile_photo menjadi null)
            $user->update(['profile_photo' => null]);
            
            // Tambahkan log
            LogHelper::info('user', "Foto profil dihapus untuk user: {$user->name}", [
                'user_id' => $user->id
            ]);
            
            return redirect()
                ->route('admin.users.edit', $user->id)
                ->with('success', 'Foto profil berhasil dihapus!');
        }
        
        return redirect()
            ->route('admin.users.edit', $user->id)
            ->with('error', 'Tidak ada foto profil untuk dihapus.');
    }

    public function deleteAdminPhoto(Admin $admin)
    {
        if ($admin->profile_photo) {
            // Hapus file foto dari storage
            Storage::delete('public/' . $admin->profile_photo);
            
            // Update data admin (set profile_photo menjadi null)
            $admin->update(['profile_photo' => null]);
            
            // Tambahkan log
            LogHelper::info('admin', "Foto profil dihapus untuk admin: {$admin->name}", [
                'admin_id' => $admin->id
            ]);
            
            return redirect()
                ->route('admin.admins.edit', $admin->id)
                ->with('success', 'Foto profil berhasil dihapus!');
        }
        
        return redirect()
            ->route('admin.admins.edit', $admin->id)
            ->with('error', 'Tidak ada foto profil untuk dihapus.');
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
            'phone' => 'required|string|max:20',
            'email' => 'required|email|unique:admins,email,' . $admin->id,
        ]);

        $admin->update($validated);

        return redirect()
            ->route('admin.admins.edit', $admin->id)
            ->with('success', 'Admin berhasil diperbarui!');
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
