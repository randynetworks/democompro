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
        //relasi hasmany dengan solusi detail
        return $this->hasMany(SolusiDetail::class);
    }
}
