<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Data default/tetap
        User::factory()->create([
            'name' => 'admin',
            'email' => 'healtisin@gmail.com',
            'username' => 'healtisin',
            'password' => Hash::make('12345'),
            'is_active' => true,
        ]);

        $this->call([
            AdminSeeder::class, // Admin default
            InformationSeeder::class, // Data informasi website dan produk
        ]);

        // Data dummy menggunakan factory
        if (app()->environment('local', 'development')) {
            // Generate users dengan berbagai status
            User::factory()
                ->count(20)
                ->unverified()
                ->create();

            User::factory()
                ->count(20)
                ->active()
                ->create();

            User::factory()
                ->count(20)
                ->active()
                ->proSubscription()
                ->create();

            // Generate berita dummy
            \App\Models\News::factory(10)->create();

            // Generate transaksi dummy
            \App\Models\Payment::factory()
                ->count(30)
                ->create();

            \App\Models\Payment::factory()
                ->count(10)
                ->paid()
                ->create();

            \App\Models\Payment::factory()
                ->count(5)
                ->expired()
                ->create();

            \App\Models\Payment::factory()
                ->count(5)
                ->failed()
                ->create();
        }
    }
}
