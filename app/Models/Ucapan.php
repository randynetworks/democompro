<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ucapan extends Model
{
    use HasFactory;

    protected $fillable = [
        'gambar',
        'nama',
        'id_jabatan_fk',
        'deskripsi',
        'deskripsi_en',
        'tagline',
        'tagline_en',
    ];
}
