<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PricingConfig extends Model
{
    use HasFactory;

    protected $fillable = [
        'plan_name',
        'monthly_price',
        'duration_3_months_discount',
        'duration_6_months_discount',
        'duration_12_months_discount',
        'is_active'
    ];

    protected $casts = [
        'monthly_price' => 'decimal:2',
        'duration_3_months_discount' => 'integer',
        'duration_6_months_discount' => 'integer',
        'duration_12_months_discount' => 'integer',
        'is_active' => 'boolean'
    ];
}
