<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class podcast extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'embed',
        'judul',
        'judul_en'
    ];
}
