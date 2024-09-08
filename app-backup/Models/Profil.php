<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_perusahaan',
        'deskripsi',
        'deskripsi_en',
        'gambar',
        'url_youtube',
    ];
}
