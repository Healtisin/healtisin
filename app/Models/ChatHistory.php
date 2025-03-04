<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChatHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'title',
        'last_message',
        'messages',
        'last_interaction',
        'context'
    ];

    protected $casts = [
        'messages' => 'array',
        'context' => 'array',
        'last_interaction' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
