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
        $this->total_visits++;
        $this->save();
    }

    public static function total_kunjung($date)
    {
        if ($date == "30hari") {
            $deliveries = KunjungWeb::select('total_visits', 'created_at') 
            ->whereBetween('created_at', [now()->subDays(30), now()])
            ->orderBy('created_at', 'asc')
            ->get()
            ->groupBy(function($date) {
                return Carbon::parse($date->created_at)->format('Y-m-d'); 
            });

            $totals = [];
            foreach ($deliveries as $date => $delivery) {
                $totals[] = [
                    'total_visits' => $date,
                    'total' => $delivery->count()
                ];
            }
            
            return $totals;
        } else {
            $dateRange = explode(' - ', $date); 
            $startDate = Carbon::createFromFormat('m/d/Y', trim($dateRange[0]))->startOfDay();
            $endDate = Carbon::createFromFormat('m/d/Y', trim($dateRange[1]))->endOfDay();

            $deliveries = KunjungWeb::select('total_visits', 'created_at')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->orderBy('created_at', 'asc')
            ->get()
            ->groupBy(function($date) {
                return Carbon::parse($date->created_at)->format('Y-m-d'); 
            });

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
