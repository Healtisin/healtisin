<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat admin default
        Admin::create([
            'name' => 'Admin Healtisin',
            'email' => 'admin.healtisin@gmail.com',
            'username' => 'admin.healtisin',
            'password' => Hash::make('12345'), 
            'is_active' => true, 
        ]);
    }
}