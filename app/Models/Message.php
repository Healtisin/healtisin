<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
    ];
    
    protected $appends = ['formatted_date', 'formatted_time'];
    
    public function getFormattedDateAttribute()
    {
        return Carbon::parse($this->created_at)->format('d M Y');
    }
    
    public function getFormattedTimeAttribute()
    {
        return Carbon::parse($this->created_at)->format('H:i:s');
    }
}
