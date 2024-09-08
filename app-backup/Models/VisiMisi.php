<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisiMisi extends Model
{
    use HasFactory;

    protected $fillable = [
        'visi',
        'visi_en',
        'misi',
        'misi_en',
    ];
}

