<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nilai extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'icon',
        'text',
        'text_en',
        'dekripsi',
        'dekripsi_en',
        'gambar',
    ];
}

