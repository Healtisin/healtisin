<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Payment;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalTransaction = Payment::count();

        $lastYearUsers = User::whereYear('created_at', now()->subYear()->year)->count();

        $userIncreasePercentage = $lastYearUsers > 0 ?
            round((($totalUsers - $lastYearUsers) / $lastYearUsers) * 100, 2) : 0;

        $todaySales = 35485;
        $salesIncreasePercentage = 2.8;

        return view('admin.dashboard', [
            'totalUsers' => $totalUsers,
            'totalTransaction' => $totalTransaction,
            'lastYearUsers' => $lastYearUsers,
            'userIncreasePercentage' => $userIncreasePercentage,
            'todaySales' => $todaySales,
            'salesIncreasePercentage' => $salesIncreasePercentage,
        ]);
    }

    public function index()
    {
        $activeUsers = User::where('status', 'active')->count();
        $inactiveUsers = User::where('status', 'inactive')->count();
        $totalUsers = $activeUsers + $inactiveUsers;

        $activePercentage = round(($activeUsers / $totalUsers) * 100, 2);
        $inactivePercentage = round(($inactiveUsers / $totalUsers) * 100, 2);

        return view('admin.dashboard', [
            'activePercentage' => $activePercentage,
            'inactivePercentage' => $inactivePercentage,
        ]);
    }
}
