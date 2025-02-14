<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'duration' => 'required|integer',
            'payment_method' => 'required|string'
        ]);

        $payment = Payment::create([
            'user_id' => Auth::id(),
            'amount' => $request->amount,
            'duration' => $request->duration,
            'payment_method' => $request->payment_method,
            'status' => 'pending',
            'expired_at' => now()->addHours(24)
        ]);

        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Pembayaran berhasil dibuat',
                'data' => $payment
            ]);
        }

        return redirect()->route('payment.show', $payment->id)
            ->with('success', 'Silakan selesaikan pembayaran Anda');
    }

    public function uploadProof(Request $request, Payment $payment)
    {
        $request->validate([
            'proof' => 'required|image|max:2048'
        ]);

        $path = $request->file('proof')->store('payment-proofs', 'public');
        
        $payment->update([
            'payment_proof' => $path,
            'status' => 'pending' // menunggu verifikasi admin
        ]);

        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Bukti pembayaran berhasil diunggah'
            ]);
        }

        return back()->with('success', 'Bukti pembayaran berhasil diunggah');
    }
}
