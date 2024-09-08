<?php

namespace Database\Seeders;

use App\Models\VisiMisi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VisiMisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $visi_misi = [
            [
                'visi'=>'Menjadi Reasuradur Syariah terdepan, terkuat dan terpercaya bagi industri asuransi syariah nasional dengan kiprah regional.',
                'visi_en'=>'To become the leading, strongest and most trusted Sharia Reinsurer for the national sharia insurance industry with regional involvement.',
                'misi'=>'ReINDO Syariah hadir sebagai perusahaan reasuransi syariah yang sehat, kuat dan mandiri dalam menjaga amanah peserta, memegang teguh profesionalisme dan memberikan manfaat yang optimal bagi stakeholders serta dapat berkontribusi untuk pembangunan ekonomi nasional.',
                'misi_en'=>'ReINDO Syariah is present as a sharia reinsurance company that is healthy, strong and independent in maintaining the trust of participants, upholding professionalism and providing optimal benefits for stakeholders and can contribute to national economic development.'
            ]

        ];

        foreach ($visi_misi as $key => $value) {
            VisiMisi::create($value);
        }
    }
}
