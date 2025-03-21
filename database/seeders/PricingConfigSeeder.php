<?php

namespace Database\Seeders;

use App\Models\PricingConfig;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PricingConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PricingConfig::create([
            'plan_name' => 'Pro',
            'monthly_price' => 99000.00,
            'duration_3_months_discount' => 10,
            'duration_6_months_discount' => 15,
            'duration_12_months_discount' => 25,
            'is_active' => true
        ]);
    }
}
