<?php

namespace Database\Seeders;

use App\Models\Tujuan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TujuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tujuan = [
            [
                'tujuan'=>'Menyelenggarakan usaha pertanggungan ulang berdasarkan prinsip syariah untuk risiko yang dihadapi perusahaan asuransi umum, asuransi jiwa dan penjaminan” dan Melakukan kegiatan investasi dan kegiatan lain yang lazim dilakukan oleh perusahaan asuransi dengan memperhatikan ketentuan peraturan perundang-undangan serta prinsip syariah.',
                'tujuan_en'=>'Carrying out re-insurance business based on sharia principles for risks faced by general insurance, life insurance and guarantee companies" and carrying out investment activities and other activities commonly carried out by insurance companies by taking into account the provisions of laws and regulations and sharia principles.',
            ]

        ];

        foreach ($tujuan as $key => $value) {
            Tujuan::create($value);
        }
    }
}
