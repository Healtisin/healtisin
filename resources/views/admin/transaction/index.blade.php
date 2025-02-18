@extends('admin.app')

@section('content')
@include('components.breadcrumbs')

<div class="container mx-auto px-4 sm:px-8">
    <div class="py-8">
        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
            <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                No</th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Customer Name</th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Customer Phone</th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Email</th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Payment Type</th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Payment Amount</th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Status</th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payments as $index => $payment)
                        <tr>
                            <!-- Kolom No -->
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                {{ $index + 1 }}
                            </td>

                            <!-- Kolom Customer Name -->
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                {{ $payment->customer_name }}
                            </td>

                            <!-- Kolom Customer Phone -->
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                {{ $payment->customer_phone }}
                            </td>

                            <!-- Kolom Email -->
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                {{ $payment->customer_email }}
                            </td>

                            <!-- Kolom Payment Type -->
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                {{ $payment->payment_method }}
                            </td>

                            <!-- Kolom Payment Amount -->
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                Rp. {{ number_format($payment->amount, 2) }}
                            </td>

                            <!-- Kolom Status -->
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                @if($payment->status == 'paid')
                                <span
                                    class="px-2 py-1 text-sm font-semibold text-green-800 bg-green-200 rounded-full">Paid</span>
                                @elseif($payment->status == 'unpaid')
                                <span
                                    class="px-2 py-1 text-sm font-semibold text-yellow-800 bg-yellow-200 rounded-full">Unpaid</span>
                                @elseif($payment->status == 'expired')
                                <span
                                    class="px-2 py-1 text-sm font-semibold text-red-800 bg-red-200 rounded-full">Expired</span>
                                @elseif($payment->status == 'failed')
                                <span
                                    class="px-2 py-1 text-sm font-semibold text-red-800 bg-red-200 rounded-full">Failed</span>
                                @endif
                            </td>

                            <!-- Kolom Action -->
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <form action="{{ route('admin.transactions.destroy', $payment->id) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 ml-2">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection