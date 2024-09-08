<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dynamic_menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'navbar',
        'navbar_en',
        'deskripsi',
        'deskripsi_en',
        'body',
    ];

}
