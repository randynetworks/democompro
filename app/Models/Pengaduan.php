<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class Pengaduan extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'nama_perusahaan',
        'nama_pic',
        'alamat_perusahaan',
        'no_tlp_perusahaan',
        'no_hp_pic',
        'email',
        'lampiran',
        'jenis_layanan',
        'jenis_layanan_lainnya',
        'kategori',
        'uraian',
    ];

    
    // fungsi get data untuk chart area pengaduan
    public static function total_pengaduan($date)
    {
        // default filter rentang waktu adalah 30 hari kebelakang
        if ($date == "30hari") {
            $deliveries = Pengaduan::select('nama_perusahaan', 'created_at') 
            ->whereBetween('created_at', [now()->subDays(30), now()])
            ->orderBy('created_at', 'asc')
            ->get()
            ->groupBy(function($date) {
                return Carbon::parse($date->created_at)->format('Y-m-d'); 
            });

            $totals = [];
            foreach ($deliveries as $date => $delivery) {
                $totals[] = [
                    'nama_perusahaan' => $date,
                    'total' => $delivery->count()
                ];
            }
            
            return $totals;

        //jika filter tidak '30 hari'
        } else {
            $dateRange = explode(' - ', $date); 
            $startDate = Carbon::createFromFormat('m/d/Y', trim($dateRange[0]))->startOfDay();
            $endDate = Carbon::createFromFormat('m/d/Y', trim($dateRange[1]))->endOfDay();

            $deliveries = Pengaduan::select('nama_perusahaan', 'created_at')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->orderBy('created_at', 'asc')
            ->get()
            ->groupBy(function($date) {
                return Carbon::parse($date->created_at)->format('Y-m-d'); 
            });

            $totals = [];
            foreach ($deliveries as $date => $delivery) {
                $totals[] = [
                    'nama_perusahaan' => $date,
                    'total' => $delivery->count()
                ];
            }
            return $totals;
        }

    }
}
