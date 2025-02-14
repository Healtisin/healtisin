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
        'status', // pending, success, failed
        'payment_proof',
        'expired_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
