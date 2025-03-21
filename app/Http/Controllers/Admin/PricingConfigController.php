<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PricingConfig;
use Illuminate\Http\Request;

class PricingConfigController extends Controller
{
    /**
     * Menampilkan halaman konfigurasi harga
     */
    public function index()
    {
        $pricingConfig = PricingConfig::where('is_active', true)->first();
        if (!$pricingConfig) {
            $pricingConfig = PricingConfig::first();
        }
        
        return view('admin.pricing.index', compact('pricingConfig'));
    }

    /**
     * Menyimpan perubahan konfigurasi harga
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'monthly_price' => 'required|numeric|min:0',
            'duration_3_months_discount' => 'required|integer|between:0,100',
            'duration_6_months_discount' => 'required|integer|between:0,100',
            'duration_12_months_discount' => 'required|integer|between:0,100',
        ]);

        $pricingConfig = PricingConfig::findOrFail($id);
        $pricingConfig->update($validatedData);

        return redirect()->route('admin.pricing')->with('success', 'Konfigurasi harga berhasil diperbarui');
    }
}
