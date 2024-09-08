<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeritaArtikel extends Model
{
    use HasFactory;

    protected $fillable = [
        'thumbnail',
        'judul',
        'judul_en',
        'isi_berita',
        'isi_berita_en',
        'total_kunjung',
        'waktu',
        'kategori',
        'slug',
    ];
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
