<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

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
        'snap_token'
    ];

    protected $casts = [
        'expired_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}