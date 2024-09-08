<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KunjungWeb extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'total_visits',
    ];

    public function incrementTotalVisits()
    { 
        //  membuat total kunjungan website
        $this->total_visits++;
        $this->save();
    }

    public static function total_kunjung($date)
    {
        // fungsi untuk get data dengan filter  yang digunakan di chart area total kunjung

        //  default filter 30 hari kebelakang
        if ($date == "30hari") {
            $deliveries = KunjungWeb::select('total_visits', 'created_at') // select field yang dibtuhkan
            ->whereBetween('created_at', [now()->subDays(30), now()]) // cari data yang created_at nya 30 hari yang lalu samapi saat ini
            ->orderBy('created_at', 'asc') // di urutkan secara ascending dari yang terlama ke terbaru
            ->get()
            ->groupBy(function($date) {
                return Carbon::parse($date->created_at)->format('Y-m-d');  // format tanggal
            });
            // transform bntuk data
            $totals = [];
            foreach ($deliveries as $date => $delivery) {
                $totals[] = [
                    'total_visits' => $date,
                    'total' => $delivery->count()
                ];
            }
            
            return $totals;

        // jika filter selain '30 hari'
        } else {
            $dateRange = explode(' - ', $date); // pisahkan rentang waktu
            $startDate = Carbon::createFromFormat('m/d/Y', trim($dateRange[0]))->startOfDay(); // ambil index pertama
            $endDate = Carbon::createFromFormat('m/d/Y', trim($dateRange[1]))->endOfDay(); // ambil index kedua

            $deliveries = KunjungWeb::select('total_visits', 'created_at') // select field yang dipelukan
            ->whereBetween('created_at', [$startDate, $endDate]) // cari deta dengan created at sesuai rentang filter yang dikirim
            ->orderBy('created_at', 'asc') // urutkan dari terlama  ke keterbaru
            ->get()
            ->groupBy(function($date) {
                return Carbon::parse($date->created_at)->format('Y-m-d');  // format tanggal
            });
            // transform bentuk data
            $totals = [];
            foreach ($deliveries as $date => $delivery) {
                $totals[] = [
                    'total_visits' => $date,
                    'total' => $delivery->count()
                ];
            }
            return $totals;
        }

    }
}
