<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Admin extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Kolom yang bisa diisi (mass assignable).
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'phone', // Tambahkan ini
        'profile_photo', // Tambahkan ini
        'password',
        'is_active',
        'email_verified_at'
    ];

    /**
     * Kolom yang disembunyikan saat serialisasi.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casting tipe data.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Otomatis membuat remember token saat admin dibuat.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($admin) {
            $admin->remember_token = Str::random(60);
        });
    }

    /**
     * Verifikasi password.
     */
    public function verifyPassword(string $password): bool
    {
        return Hash::check($password, $this->password);
    }
}