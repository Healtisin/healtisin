@extends('admin.app')

@section('content')
@include('components.breadcrumbs')

<div class="container mx-auto px-4 sm:px-8">
    <div class="py-8">
        <div class="flex justify-between mb-6">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">Konfigurasi Harga</h2>
        </div>

        @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
            <p>{{ session('success') }}</p>
        </div>
        @endif
        
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
            <form action="{{ route('admin.pricing.config.update', $pricingConfig->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-6">
                    <label class="block text-gray-700 dark:text-gray-300 mb-2" for="monthly_price">
                        Harga Bulanan (Rp)
                    </label>
                    <input 
                        type="number" 
                        id="monthly_price" 
                        name="monthly_price" 
                        value="{{ $pricingConfig->monthly_price }}" 
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white" 
                        required 
                    />
                    @error('monthly_price')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                    <div>
                        <label class="block text-gray-700 dark:text-gray-300 mb-2" for="duration_3_months_discount">
                            Diskon 3 Bulan (%)
                        </label>
                        <input 
                            type="number" 
                            id="duration_3_months_discount" 
                            name="duration_3_months_discount" 
                            value="{{ $pricingConfig->duration_3_months_discount }}" 
                            min="0" 
                            max="100" 
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white" 
                            required 
                        />
                        @error('duration_3_months_discount')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label class="block text-gray-700 dark:text-gray-300 mb-2" for="duration_6_months_discount">
                            Diskon 6 Bulan (%)
                        </label>
                        <input 
                            type="number" 
                            id="duration_6_months_discount" 
                            name="duration_6_months_discount" 
                            value="{{ $pricingConfig->duration_6_months_discount }}" 
                            min="0" 
                            max="100" 
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white" 
                            required 
                        />
                        @error('duration_6_months_discount')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label class="block text-gray-700 dark:text-gray-300 mb-2" for="duration_12_months_discount">
                            Diskon 12 Bulan (%)
                        </label>
                        <input 
                            type="number" 
                            id="duration_12_months_discount" 
                            name="duration_12_months_discount" 
                            value="{{ $pricingConfig->duration_12_months_discount }}" 
                            min="0" 
                            max="100" 
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white" 
                            required 
                        />
                        @error('duration_12_months_discount')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div class="mt-8">
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
        
        <div class="mt-8 bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
            <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">Simulasi Harga</h3>
            
            <div class="overflow-x-auto">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th class="px-5 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-800 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Durasi</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-800 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Harga Total</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-800 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Harga per Bulan</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-800 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Diskon</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-800 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Penghematan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">1 Bulan</td>
                            <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">Rp {{ number_format($pricingConfig->monthly_price, 0, ',', '.') }}</td>
                            <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">Rp {{ number_format($pricingConfig->monthly_price, 0, ',', '.') }}</td>
                            <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">0%</td>
                            <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">Rp 0</td>
                        </tr>
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">3 Bulan</td>
                            <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">
                                Rp {{ number_format($pricingConfig->monthly_price * 3 * (100 - $pricingConfig->duration_3_months_discount) / 100, 0, ',', '.') }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">
                                Rp {{ number_format($pricingConfig->monthly_price * (100 - $pricingConfig->duration_3_months_discount) / 100, 0, ',', '.') }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">{{ $pricingConfig->duration_3_months_discount }}%</td>
                            <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">
                                Rp {{ number_format($pricingConfig->monthly_price * 3 * $pricingConfig->duration_3_months_discount / 100, 0, ',', '.') }}
                            </td>
                        </tr>
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">6 Bulan</td>
                            <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">
                                Rp {{ number_format($pricingConfig->monthly_price * 6 * (100 - $pricingConfig->duration_6_months_discount) / 100, 0, ',', '.') }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">
                                Rp {{ number_format($pricingConfig->monthly_price * (100 - $pricingConfig->duration_6_months_discount) / 100, 0, ',', '.') }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">{{ $pricingConfig->duration_6_months_discount }}%</td>
                            <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">
                                Rp {{ number_format($pricingConfig->monthly_price * 6 * $pricingConfig->duration_6_months_discount / 100, 0, ',', '.') }}
                            </td>
                        </tr>
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">12 Bulan</td>
                            <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">
                                Rp {{ number_format($pricingConfig->monthly_price * 12 * (100 - $pricingConfig->duration_12_months_discount) / 100, 0, ',', '.') }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">
                                Rp {{ number_format($pricingConfig->monthly_price * (100 - $pricingConfig->duration_12_months_discount) / 100, 0, ',', '.') }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">{{ $pricingConfig->duration_12_months_discount }}%</td>
                            <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">
                                Rp {{ number_format($pricingConfig->monthly_price * 12 * $pricingConfig->duration_12_months_discount / 100, 0, ',', '.') }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection