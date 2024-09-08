<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Whistleblowing extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    
    protected $fillable = [
        'nama_pelapor',
        'no_tlp_pelapor',
        'email_pelapor',
        'tindakan_yang_dilaporkan',
        'lampiran',
        'nama_terlapor',
        'jabatan_terlapor',
        'waktu',
        'lokasi',
        'kronologis',
        'nominal',
    ];

    public static function total_whistleblowing($date)
    {
        if ($date == "30hari") {
            $deliveries = Whistleblowing::select('nama_pelapor', 'created_at') 
            ->whereBetween('created_at', [now()->subDays(30), now()])
            ->orderBy('created_at', 'asc')
            ->get()
            ->groupBy(function($date) {
                return Carbon::parse($date->created_at)->format('Y-m-d'); 
            });

            $totals = [];
            foreach ($deliveries as $date => $delivery) {
                $totals[] = [
                    'nama_pelapor' => $date,
                    'total' => $delivery->count()
                ];
            }
            return $totals;
        } else {
            $dateRange = explode(' - ', $date); 
            $startDate = Carbon::createFromFormat('m/d/Y', trim($dateRange[0]))->startOfDay();
            $endDate = Carbon::createFromFormat('m/d/Y', trim($dateRange[1]))->endOfDay();

            $deliveries = Whistleblowing::select('nama_pelapor', 'created_at')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->orderBy('created_at', 'asc')
            ->get()
            ->groupBy(function($date) {
                return Carbon::parse($date->created_at)->format('Y-m-d'); 
            });

            $totals = [];
            foreach ($deliveries as $date => $delivery) {
                $totals[] = [
                    'nama_pelapor' => $date,
                    'total' => $delivery->count()
                ];
            }
            return $totals;
        }

    }
}
