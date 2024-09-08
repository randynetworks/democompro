<?php

namespace Database\Seeders;

use App\Models\Documentasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DokumentasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'gambar'=>'profil_perusahaan.png',
                'text'=>'lorem ipsum',
                'text_en'=>'lorem ipsum',
                'kategori'=>'1',
                'waktu'=>'2024-05-30 17:42:47',
            ]

        ];

        foreach ($data as $key => $value) {
            Documentasi::create($value);
        }
    }
}
