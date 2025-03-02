<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Import model User

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::count();

        $lastYearUsers = User::whereYear('created_at', now()->subYear()->year)->count();

        $userIncreasePercentage = $lastYearUsers > 0 ?
            round((($totalUsers - $lastYearUsers) / $lastYearUsers) * 100, 2) : 0;

        $todaySales = 35485;
        $salesIncreasePercentage = 2.8;

        return view('admin.dashboard', [
            'totalUsers' => $totalUsers,
            'lastYearUsers' => $lastYearUsers,
            'userIncreasePercentage' => $userIncreasePercentage,
            'todaySales' => $todaySales,
            'salesIncreasePercentage' => $salesIncreasePercentage,
        ]);
    }
}
