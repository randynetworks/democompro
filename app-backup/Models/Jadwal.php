<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $fillable = [
        'headline',
        'headline_en',
        'deskripsi',
        'deskripsi_en',
        'start_date',
        'end_date',
    ];
}
