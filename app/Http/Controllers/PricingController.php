<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\PricingConfig;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PricingController extends Controller
{
    public function index()
    {
        $payments = Payment::all();
        return view('admin.pricing.index', compact('payments'));
    }

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

        // Ambil konfigurasi harga dari database
        $pricingConfig = PricingConfig::where('is_active', true)->first();
        if (!$pricingConfig) {
            $pricingConfig = PricingConfig::first();
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

        // Hitung harga paket berdasarkan konfigurasi
        $monthlyPrice = $pricingConfig->monthly_price;
        $discount3Months = $pricingConfig->duration_3_months_discount;
        $discount6Months = $pricingConfig->duration_6_months_discount;
        $discount12Months = $pricingConfig->duration_12_months_discount;

        $packages = [
            [
                'duration' => 1,
                'name' => '1 Bulan',
                'price' => $monthlyPrice,
                'monthly' => $monthlyPrice,
                'discount' => 0,
                'savings' => 0
            ],
            [
                'duration' => 3,
                'name' => '3 Bulan',
                'price' => $monthlyPrice * 3 * (100 - $discount3Months) / 100,
                'monthly' => $monthlyPrice * (100 - $discount3Months) / 100,
                'discount' => $discount3Months,
                'savings' => $monthlyPrice * 3 * $discount3Months / 100
            ],
            [
                'duration' => 6,
                'name' => '6 Bulan',
                'price' => $monthlyPrice * 6 * (100 - $discount6Months) / 100,
                'monthly' => $monthlyPrice * (100 - $discount6Months) / 100,
                'discount' => $discount6Months,
                'savings' => $monthlyPrice * 6 * $discount6Months / 100
            ],
            [
                'duration' => 12,
                'name' => '1 Tahun',
                'price' => $monthlyPrice * 12 * (100 - $discount12Months) / 100,
                'monthly' => $monthlyPrice * (100 - $discount12Months) / 100,
                'discount' => $discount12Months,
                'savings' => $monthlyPrice * 12 * $discount12Months / 100
            ]
        ];

        return view('pricing.pro', compact('features', 'packages'));
    }
}
