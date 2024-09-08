<?php

namespace Database\Seeders;

use App\Models\Sertifikat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SertifikatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $sertifikat = [
            [
                'gambar'=>'profil_perusahaan.png',
                'nama'=>'Sertifikat test',
                'kategori'=>'1',
                'waktu'=>'2024-05-28 07:59:18'
            ],
            [
                'gambar'=>'profil_perusahaan.png',
                'nama'=>'Sertifikat test',
                'kategori'=>'2',
                'waktu'=>'2024-05-28 07:59:18'
            ]

        ];

        foreach ($sertifikat as $key => $value) {
            Sertifikat::create($value);
        }
    }
}
