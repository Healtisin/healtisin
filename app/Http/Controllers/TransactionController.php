<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;

class TransactionController extends Controller
{
    public function index()
    {
        $payments = Payment::all();
        return view('admin.transaction.index', compact('payments'));
    }

    public function destroy($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();
        return redirect()->route('admin.transactions')
            ->with('success', 'Payment deleted successfully');
    }
}
