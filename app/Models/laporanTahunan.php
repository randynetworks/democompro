<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class laporanTahunan extends Model
{
    use HasFactory;

    protected $fillable = [
        'tahun',
        'rata_rata',
        'file',
    ];

    //  halaman tidak ditampilkan
    public static function chart_laporan()
    {
        $deliveries = laporanTahunan::select('tahun', 'rata_rata')
        ->orderBy('tahun', 'asc')
        ->get();
    
        $categories = [];
        $series = [];

        foreach ($deliveries as $delivery) {
            $categories[] = $delivery->tahun;
            $series[] = $delivery->rata_rata;
        }

        return [
            'categories' => $categories,
            'series' => $series,
        ];
        // }
    }

    public static function filter_tahun() {
        $deliveries = laporanTahunan::select('tahun')->get();
        $filter_tahun = [];

        foreach ($deliveries as $delivery) {
            $filter_tahun[] = $delivery->tahun;
        }

        sort($filter_tahun);

        return $filter_tahun;
    }
}
