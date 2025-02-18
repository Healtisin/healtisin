<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::all();
        return view('admin.payment.index', compact('payments'));
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

    public function showPaymentPage()
    {
        return view('pricing.payment');
    }

    public function selectPackage()
    {
        // Cek jika user sudah memiliki pending payment
        $pendingPayment = Payment::where('user_id', Auth::id())
            ->where('status', 'unpaid')
            ->first();

        if ($pendingPayment) {
            return redirect()->route('pricing.payment-confirmation', $pendingPayment->id);
        }

        $packages = [
            [
                'duration' => 1,
                'name' => '1 Bulan',
                'total' => 99000,
                'monthly' => 99000,
                'discount' => 0,
                'savings' => 0
            ],
            [
                'duration' => 3,
                'name' => '3 Bulan',
                'total' => 267300,
                'monthly' => 89100,
                'discount' => 10,
                'savings' => 29700
            ],
            [
                'duration' => 6,
                'name' => '6 Bulan',
                'total' => 504900,
                'monthly' => 84150,
                'discount' => 15,
                'savings' => 89100
            ],
            [
                'duration' => 12,
                'name' => '1 Tahun',
                'total' => 891000,
                'monthly' => 74250,
                'discount' => 25,
                'savings' => 297000
            ]
        ];

        $ewallets = [
            ['code' => 'gopay', 'name' => 'GoPay', 'icon' => 'images/payments/gopay.png'],
            ['code' => 'ovo', 'name' => 'OVO', 'icon' => 'images/payments/ovo.jpg'],
            ['code' => 'dana', 'name' => 'DANA', 'icon' => 'images/payments/dana.jpeg'],
            ['code' => 'shopeepay', 'name' => 'Shoppeepay', 'icon' => 'images/payments/shopeepay.png'],
            ['code' => 'paypal', 'name' => 'PayPal', 'icon' => 'images/payments/paypal.png'],
            ['code' => 'qris', 'name' => 'QRIS', 'icon' => 'images/payments/qris.png']
        ];

        $banks = [
            ['code' => 'bca', 'name' => 'BCA', 'icon' => 'images/payments/bca.png'],
            ['code' => 'mandiri', 'name' => 'Mandiri', 'icon' => 'images/payments/mandiri.png'],
            ['code' => 'bni', 'name' => 'BNI', 'icon' => 'images/payments/bni.png'],
            ['code' => 'bri', 'name' => 'BRI', 'icon' => 'images/payments/bri.png']
        ];

        $creditCards = [
            ['code' => 'cc', 'name' => 'Kartu Kredit', 'icon' => 'images/payments/cc.png']
        ];

        return view('pricing.select-package', compact('packages', 'ewallets', 'banks'));
    }

    public function paymentDetails(Request $request)
    {
        $request->validate([
            'package' => 'required|integer|in:1,3,6,12',
            'payment_method' => 'required|string'
        ]);

        $package = $this->getPackageDetails($request->package);
        $payment_method = $request->payment_method;

        return view('pricing.payment-details', compact('package', 'payment_method'));
    }

    private function getPackageDetails($duration)
    {
        $packages = [
            1 => [
                'id' => 1,
                'duration' => 1,
                'name' => '1 Bulan',
                'total' => 99000,
                'monthly' => 99000,
                'discount' => 0,
                'savings' => 0,
                'final_total' => 99000
            ],
            3 => [
                'id' => 3,
                'duration' => 3,
                'name' => '3 Bulan',
                'total' => 297000,
                'monthly' => 89100,
                'discount' => 10,
                'savings' => 29700,
                'final_total' => 267300
            ],
            6 => [
                'id' => 6,
                'duration' => 6,
                'name' => '6 Bulan',
                'total' => 594000,
                'monthly' => 84150,
                'discount' => 15,
                'savings' => 89100,
                'final_total' => 504900
            ],
            12 => [
                'id' => 12,
                'duration' => 12,
                'name' => '1 Tahun',
                'total' => 1188000,
                'monthly' => 74250,
                'discount' => 25,
                'savings' => 297000,
                'final_total' => 891000
            ]
        ];

        return $packages[$duration] ?? null;
    }

    private function generatePaymentCode($method)
    {
        switch ($method) {
            case 'gopay':
                return 'GOPAY' . strtoupper(Str::random(8));
            case 'ovo':
                return 'OVO' . strtoupper(Str::random(8));
            case 'dana':
                return 'DANA' . strtoupper(Str::random(8));
            case 'bca':
                return '8277' . str_pad(Auth::id(), 6, '0', STR_PAD_LEFT) . rand(100, 999);
            case 'mandiri':
                return '88888' . str_pad(Auth::id(), 6, '0', STR_PAD_LEFT) . rand(100, 999);
            case 'bni':
                return '8899' . str_pad(Auth::id(), 6, '0', STR_PAD_LEFT) . rand(100, 999);
            default:
                return strtoupper(Str::random(12));
        }
    }

    public function processPayment(Request $request)
    {
        $request->validate([
            'package_id' => 'required|integer|in:1,3,6,12',
            'payment_method' => 'required|string',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20'
        ]);

        // Cek apakah sudah ada pembayaran yang belum selesai
        $existingPayment = Payment::where('user_id', Auth::id())
            ->where('status', 'unpaid')
            ->where('expired_at', '>', now())
            ->first();

        if ($existingPayment) {
            return redirect()->route('pricing.payment-confirmation', $existingPayment->id)
                ->with('error', 'Anda memiliki pembayaran yang belum diselesaikan');
        }

        $package = $this->getPackageDetails($request->package_id);

        $payment = Payment::create([
            'user_id' => Auth::id(),
            'amount' => $package['final_total'],
            'duration' => $package['duration'],
            'payment_method' => $request->payment_method,
            'status' => 'unpaid',
            'customer_name' => $request->full_name,
            'customer_email' => $request->email,
            'customer_phone' => $request->phone,
            'expired_at' => now()->addHours(24),
            'payment_code' => $this->generatePaymentCode($request->payment_method),
            'qr_code' => $request->payment_method == 'qris' ? $this->generateQRCode() : null
        ]);

        return redirect()->route('pricing.payment-confirmation', $payment->id);
    }

    public function paymentConfirmation($id)
    {
        $payment = Payment::findOrFail($id);

        // Cek kepemilikan payment
        if ($payment->user_id !== Auth::id()) {
            return redirect()->route('home');
        }

        // Cek status kadaluarsa
        if ($payment->expired_at < now()) {
            $payment->update(['status' => 'expired']);
            return redirect()->route('pricing.pro')
                ->with('error', 'Pembayaran telah kadaluarsa. Silakan melakukan pemesanan ulang.');
        }

        return view('pricing.payment-confirmation', compact('payment'));
    }

    public function checkPaymentStatus($id)
    {
        $payment = Payment::findOrFail($id);

        // Jika metode pembayaran adalah bank, cek status VA
        if (in_array($payment->payment_method, ['bca', 'mandiri', 'bni'])) {
            $this->checkVAPayment($payment);
        }

        if ($payment->status === 'paid') {
            return response()->json([
                'status' => 'success',
                'redirect' => route('home')
            ]);
        }

        return response()->json(['status' => $payment->status]);
    }

    private function checkVAPayment($payment)
    {
        // Di sini nantinya akan diintegrasikan dengan API payment gateway
        // Untuk sementara, kita simulasikan pengecekan status

        if ($payment->status === 'unpaid' && $payment->expired_at > now()) {
            // Cek status pembayaran ke payment gateway
            // Jika pembayaran berhasil:
            $payment->update([
                'status' => 'paid',
                'paid_at' => now()
            ]);

            // Update status user menjadi pro
            $payment->user->update([
                'is_pro' => true,
                'pro_until' => now()->addMonths($payment->duration)
            ]);

            return true;
        }

        return false;
    }

    private function processCreditCardPayment($payment, $cardDetails)
    {
        // Implementasi integrasi dengan payment gateway
        // Contoh simulasi:
        $payment->update([
            'status' => 'paid',
            'paid_at' => now()
        ]);

        $payment->user->update([
            'is_pro' => true,
            'pro_until' => now()->addMonths($payment->duration)
        ]);

        return true;
    }

    public function processPayPal(Request $request, $orderId, $paymentId)
    {
        $payment = Payment::findOrFail($paymentId);

        // Verifikasi pembayaran dengan API PayPal
        // Implementasi verifikasi order_id

        $payment->update([
            'status' => 'paid',
            'paid_at' => now(),
            'payment_code' => $orderId
        ]);

        $payment->user->update([
            'is_pro' => true,
            'pro_until' => now()->addMonths($payment->duration)
        ]);

        return response()->json(['status' => 'success']);
    }
}
