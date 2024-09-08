<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KontakKami extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'email',
        'phone',
        'location',
        'maps',
        'instagram',
        'url_instagram',
    ];
}
