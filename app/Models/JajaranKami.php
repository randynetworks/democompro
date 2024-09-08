<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JajaranKami extends Model
{
    use HasFactory;

    protected $fillable = [
        'gambar',
        'nama',
        'deskripsi',
        'deskripsi_en',
        'id_jabatan_fk',
        'tagline',
        'tagline_en',
    ];

    public function jabatan()
    {
        // hasone relasi dengan master jabatan
        return $this->belongsTo(MasterJabatan::class, 'id_jabatan_fk', 'id');
    }
}
