<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class DeleteInactiveUsers extends Command
{
    protected $signature = 'users:delete-inactive';
    protected $description = 'Delete inactive users after 7 days';

    public function handle()
    {
        $users = User::where('is_active', false)
                    ->where('activation_expires_at', '<', now())
                    ->get();

        foreach ($users as $user) {
            $user->delete();
        }

        $this->info(count($users) . ' inactive users have been deleted.');
    }
}