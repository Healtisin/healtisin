<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;
use Illuminate\Support\Facades\Log;

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
            ['code' => 'shopeepay', 'name' => 'Shoppeepay', 'icon' => 'images/payments/shopeepay.png'],
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
        // Validasi input
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

        // Ambil detail paket
        $package = $this->getPackageDetails($request->package_id);

        // Buat pembayaran baru
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
        ]);

        // Setup konfigurasi Midtrans
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Buat parameter transaksi Midtrans
        $transactionDetails = [
            'order_id' => $payment->id, // ID pembayaran
            'gross_amount' => $payment->amount, // Jumlah pembayaran
        ];

        $customerDetails = [
            'first_name' => $payment->customer_name,
            'email' => $payment->customer_email,
            'phone' => $payment->customer_phone,
        ];

        // Tentukan metode pembayaran yang diaktifkan
        $enabledPayments = [];
        $specificParams = [];

        // Jika metode pembayaran adalah e-wallet, arahkan ke QRIS
        if (in_array($request->payment_method, ['gopay', 'ovo', 'shopeepay', 'qris'])) {
            $enabledPayments = ['qris', 'gopay', 'shopeepay', 'ovo'];
        } elseif (in_array($request->payment_method, ['bca', 'mandiri', 'bni'])) {
            $enabledPayments = ['bank_transfer']; // Hanya aktifkan transfer bank
            $specificParams['bank_transfer'] = [
                'bank' => $request->payment_method, // Tentukan bank (BCA, Mandiri, atau BNI)
            ];
        } elseif ($request->payment_method === 'cc') {
            $enabledPayments = ['credit_card']; // Hanya aktifkan kartu kredit
        } else {
            return redirect()->back()->with('error', 'Metode pembayaran tidak valid.');
        }

        // Gabungkan parameter transaksi
        $params = [
            'transaction_details' => $transactionDetails,
            'customer_details' => $customerDetails,
            'enabled_payments' => $enabledPayments, // Batasi metode pembayaran
        ];

        // Tambahkan parameter khusus jika ada
        if (!empty($specificParams)) {
            $params = array_merge($params, $specificParams);
        }

        // Generate Snap Token
        try {
            $snapToken = Snap::getSnapToken($params);
            Log::info('Snap Token berhasil di-generate:', ['snap_token' => $snapToken]); // Log Snap Token
        } catch (\Exception $e) {
            Log::error('Gagal generate Snap Token:', ['error' => $e->getMessage()]); // Log error
            return redirect()->back()->with('error', 'Gagal memproses pembayaran. Silakan coba lagi.');
        }

        // Simpan Snap Token ke database
        $payment->update(['snap_token' => $snapToken]);


        // Redirect ke halaman konfirmasi pembayaran
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
    public function handleNotification(Request $request)
    {
        Log::info('Midtrans Notification Received:', $request->all());
    
        $serverKey = config('services.midtrans.server_key');
        $hashed = hash("sha512", $request->order_id.$request->status_code.$request->gross_amount.$serverKey);
    
        if ($hashed !== $request->signature_key) {
            Log::error('Invalid Signature Key!', [
                'expected' => $hashed,
                'received' => $request->signature_key,
            ]);
            return response()->json(['message' => 'Invalid signature'], 403);
        }
    
        $payment = Payment::find($request->order_id);
        if (!$payment) {
            Log::error('Payment Not Found!', ['order_id' => $request->order_id]);
            return response()->json(['message' => 'Payment not found'], 404);
        }
    
        Log::info('Transaction Status:', [
            'order_id' => $payment->id,
            'transaction_status' => $request->transaction_status,
            'fraud_status' => $request->fraud_status
        ]);
    
        if (in_array($request->transaction_status, ['capture', 'settlement'])) {
            $payment->status = 'paid';
        } elseif (in_array($request->transaction_status, ['pending'])) {
            $payment->status = 'unpaid';
        } elseif (in_array($request->transaction_status, ['cancel', 'expire', 'deny'])) {
            $payment->status = 'expired';
        }
    
        $payment->save();
        return response()->json(['message' => 'Notification processed']);
    }
    
    

    /**
     * Redirect ke home setelah pembayaran sukses.
     */
    public function paymentSuccess()
    {
        return redirect()->route('home')->with('success', 'Pembayaran berhasil diproses.');
    }

    /**
     * Redirect ke home setelah pembayaran tertunda.
     */
    public function paymentPending()
    {
        return redirect()->route('home')->with('warning', 'Pembayaran Anda sedang diproses.');
    }

    /**
     * Redirect ke home setelah pembayaran gagal.
     */
    public function paymentError()
    {
        return redirect()->route('home')->with('error', 'Pembayaran gagal diproses. Silakan coba lagi.');
    }

    public function checkPaymentStatus($id)
    {
        $payment = Payment::findOrFail($id);
    
        // Cek status pembayaran menggunakan Snap API
        try {
            $status = \Midtrans\Transaction::status($payment->id);
            Log::info('Midtrans Payment Status:', (array) $status); // Log status pembayaran
    
            if ($status['transaction_status'] == 'settlement' || $status['transaction_status'] == 'capture') {
                $payment->update(['status' => 'paid']);
                return response()->json(['status' => 'success', 'redirect' => route('home')]);
            }
        } catch (\Exception $e) {
            Log::error('Error checking payment status:', ['error' => $e->getMessage()]);
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

}
