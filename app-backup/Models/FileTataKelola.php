<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileTataKelola extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'tata_kelola',
        'risiko',
    ];
}
