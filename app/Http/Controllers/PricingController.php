<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PricingController extends Controller
{
    public function showProPage()
    {
        // Cek pembayaran yang sedang berlangsung
        $pendingPayment = Payment::where('user_id', Auth::id())
            ->whereIn('status', ['unpaid', 'pending'])
            ->where('expired_at', '>', now())
            ->first();

        if ($pendingPayment) {
            return redirect()->route('pricing.payment-confirmation', ['id' => $pendingPayment->id]);
        }

        $features = [
            [
                'name' => 'Konsultasi dengan Dokter',
                'free' => '1x/bulan',
                'pro' => 'Unlimited'
            ],
            [
                'name' => 'Akses Artikel Kesehatan',
                'free' => 'Terbatas',
                'pro' => 'Unlimited'
            ],
            [
                'name' => 'Fitur Chat dengan Dokter',
                'free' => '✕',
                'pro' => '✓'
            ],
            [
                'name' => 'Rekam Medis Digital',
                'free' => 'Basic',
                'pro' => 'Advanced'
            ],
            [
                'name' => 'Reminder Obat & Vitamin',
                'free' => '✕',
                'pro' => '✓'
            ],
            [
                'name' => 'Tracking Kesehatan',
                'free' => 'Basic',
                'pro' => 'Advanced'
            ],
            [
                'name' => 'Prioritas Antrian',
                'free' => '✕',
                'pro' => '✓'
            ]
        ];

        $packages = [
            [
                'duration' => 1,
                'name' => '1 Bulan',
                'price' => 99000,
                'monthly' => 99000,
                'discount' => 0,
                'savings' => 0
            ],
            [
                'duration' => 3,
                'name' => '3 Bulan',
                'price' => 267300,
                'monthly' => 89100,
                'discount' => 10,
                'savings' => 29700
            ],
            [
                'duration' => 6,
                'name' => '6 Bulan',
                'price' => 504900,
                'monthly' => 84150,
                'discount' => 15,
                'savings' => 89100
            ],
            [
                'duration' => 12,
                'name' => '1 Tahun',
                'price' => 891000,
                'monthly' => 74250,
                'discount' => 25,
                'savings' => 297000
            ]
        ];

        return view('pricing.pro', compact('features', 'packages'));
    }
}