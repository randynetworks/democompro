<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class DataDownload extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'email',
        'kategori',
        'waktu'
    ];
}
