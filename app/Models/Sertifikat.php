<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sertifikat extends Model
{
    use HasFactory;

    protected $fillable = [
        'gambar',
        'nama',
        'nama_en',
        'kategori',
        'waktu'
    ];

    // filter tahun custom
    public static function filter_tahun() {
        // get data sertifikat
        $data = Sertifikat::select('waktu')->get();
        //buat array 
        $filter_tahun = [];
        // ambil hanya tahun nya dan append ke aray
        foreach ($data as $sertifikat) {
            $tahun = date('Y', strtotime($sertifikat->waktu));

            if (!in_array($tahun, $filter_tahun)) {
                $filter_tahun[] = $tahun;
            }
        }

        sort($filter_tahun);

        return $filter_tahun;
    }
}
