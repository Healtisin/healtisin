<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'user_id',
        'amount',
        'duration',
        'payment_method',
        'status',
        'payment_proof',
        'customer_name',
        'customer_email',
        'customer_phone',
        'expired_at',
        'payment_code',
        'qr_code'
    ];

    protected $casts = [
        'expired_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}