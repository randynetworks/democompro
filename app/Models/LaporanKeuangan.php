<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Mockery\Undefined;

class LaporanKeuangan extends Model
{
    use HasFactory;

    protected $fillable = [
        'bulan',
        'rata_rata',
        'file',
    ];

    // ------------ halaman tidak ditampilkan
    public static function chart_laporan($filter)
    {
        if (isset($filter) && $filter !== 'undefined') {
            $deliveries = LaporanKeuangan::select('bulan', 'rata_rata')
            ->orderBy('bulan', 'asc')
            ->get();

            $categories = [];
            $series = [];

            foreach ($deliveries as $delivery) {
                $bulan_tahun = explode('-', $delivery->bulan);
                $tahun = $bulan_tahun[0];
                $bulan = $bulan_tahun[1];

                if ($tahun == $filter) {
                    $parts = explode('-', $delivery->bulan);
                    $date = Carbon::create($parts[0], $parts[1])->locale('en')->monthName . ' ' . $parts[0];

                    $categories[] = $date;
                    $series[] = $delivery->rata_rata;
                }
            }

            return [
                'categories' => $categories,
                'series' => $series,
            ];

        }else{
            $deliveries = LaporanKeuangan::select('bulan', 'rata_rata')->orderBy('bulan', 'asc')->get();

            $categories = [];
            $series = [];

            foreach ($deliveries as $delivery) {
                $bulan_tahun = explode('-', $delivery->bulan);
                $tahun = $bulan_tahun[0];
                $bulan = $bulan_tahun[1];

                if ($tahun == now()->year) {
                    $parts = explode('-', $delivery->bulan);
                    $date = Carbon::create($parts[0], $parts[1])->locale('en')->monthName . ' ' . $parts[0];

                    $categories[] = $date;
                    $series[] = $delivery->rata_rata;
                }
            }

            return [
                'categories' => $categories,
                'series' => $series,
            ];
        }
    }

    public static function filter_tahun() {
        $deliveries = LaporanKeuangan::select('bulan')->get();
        $filter_tahun = [];

        foreach ($deliveries as $delivery) {
            $bulan_tahun = explode('-', $delivery->bulan);
            $tahun = $bulan_tahun[0];

            if (!in_array($tahun, $filter_tahun)) {
                $filter_tahun[] = $tahun;
            }
        }

        sort($filter_tahun);

        return $filter_tahun;
    }
}

