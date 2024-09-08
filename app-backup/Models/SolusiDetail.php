<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolusiDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'solusi_id',
        'judul',
        'judul_en',
        'deskripsi',
        'deskripsi_en',
    ];

    public function solusi()
    {
        return $this->belongsTo(Solusi::class);
    }
}
