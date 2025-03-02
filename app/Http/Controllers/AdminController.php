<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Import model User

class AdminController extends Controller
{
    public function dashboard()
    {
        // Hitung jumlah pengguna saat ini
        $totalUsers = User::count();

        // Hitung jumlah pengguna tahun lalu
        $lastYearUsers = User::whereYear('created_at', now()->subYear()->year)->count();

        // Hitung persentase kenaikan atau penurunan
        $userIncreasePercentage = $lastYearUsers > 0 ?
            round((($totalUsers - $lastYearUsers) / $lastYearUsers) * 100, 2) : 0;

        // Data statis untuk contoh (jika diperlukan)
        $todaySales = 35485; // Contoh data penjualan hari ini
        $salesIncreasePercentage = 2.8; // Contoh persentase kenaikan penjualan

        // Kirim data ke view
        return view('admin.dashboard', [
            'totalUsers' => $totalUsers,
            'lastYearUsers' => $lastYearUsers,
            'userIncreasePercentage' => $userIncreasePercentage,
            'todaySales' => $todaySales,
            'salesIncreasePercentage' => $salesIncreasePercentage,
        ]);
    }
}
