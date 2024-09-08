<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Landing extends Model
{
    use HasFactory;

    protected $fillable = [
        'gambar',
        'nama_perusahaan',
        'motto',
        'motto_en',
        'deskripsi_en',
        'deskripsi'
    ];
}
