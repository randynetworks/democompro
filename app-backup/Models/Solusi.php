<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solusi extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategori',
        'kategori_en',
    ];

    public function details()
    {
        return $this->hasMany(SolusiDetail::class);
    }
}
