<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dataset extends Model
{
    use HasFactory, SoftDeletes;
    
    /**
     * Atribut yang bisa diisi (fillable)
     * 
     * @var array
     */
    protected $fillable = [
        'name',
        'file_path',
        'status',
        'user_id',
        'metadata',
        'result_data',
    ];
    
    /**
     * Atribut yang harus dikonversi
     * 
     * @var array
     */
    protected $casts = [
        'metadata' => 'array',
        'result_data' => 'array',
    ];
    
    /**
     * Relasi dengan User
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
} 