<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    protected $table = 'information';
    
    protected $fillable = [
        'website_name',
        'product_name',
        'website_description',
        'product_description',
        'phone',
        'whatsapp',
        'email',
        'address',
        'map_coordinates'
    ];
}
