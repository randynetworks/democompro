<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Joblist extends Model
{
    use HasFactory;

    protected $fillable = [
        'gambar',
        'judul',
        'judul_en',
        'deskripsi',
        'deskripsi_en',
        'waktu',
        'slug',
    ];
}
