<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class TataKelola extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'email',
        'kategori',
        'waktu',
    ]; 

    // halaman tidak ditampilkan
    public static function total_download($date)
    {
        if ($date == "30hari") {
            $deliveries = TataKelola::select('nama', 'waktu') 
            ->whereBetween('waktu', [now()->subDays(30), now()])
            ->orderBy('waktu', 'asc')
            ->get()
            ->groupBy(function($date) {
                return Carbon::parse($date->waktu)->format('Y-m-d'); 
            });

            $totals = [];
            foreach ($deliveries as $date => $delivery) {
                $totals[] = [
                    'nama' => $date,
                    'total' => $delivery->count()
                ];
            }
            
            return $totals;
        } else {
            $dateRange = explode(' - ', $date); 
            $startDate = Carbon::createFromFormat('m/d/Y', trim($dateRange[0]))->startOfDay();
            $endDate = Carbon::createFromFormat('m/d/Y', trim($dateRange[1]))->endOfDay();

            $deliveries = TataKelola::select('nama', 'waktu')
            ->whereBetween('waktu', [$startDate, $endDate])
            ->orderBy('waktu', 'asc')
            ->get()
            ->groupBy(function($date) {
                return Carbon::parse($date->waktu)->format('Y-m-d'); 
            });

            $totals = [];
            foreach ($deliveries as $date => $delivery) {
                $totals[] = [
                    'nama' => $date,
                    'total' => $delivery->count()
                ];
            }
            return $totals;
        }

    }
    
    public static function table_data_download($date){  
        $dateRange = explode(' - ', $date); 
        $startDate = Carbon::createFromFormat('m/d/Y', trim($dateRange[0]))->startOfDay();
        $endDate = Carbon::createFromFormat('m/d/Y', trim($dateRange[1]))->endOfDay();

        $deliveries = TataKelola::select("id","nama","email","kategori","waktu") 
        ->whereBetween('waktu', [$startDate, $endDate])
        ->orderBy('waktu', 'desc')
        ->get();

        return $deliveries;
    }
}
