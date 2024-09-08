<?php

namespace Database\Seeders;

use App\Models\Ucapan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UcapanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ucapan = [
            [
                'gambar'=>'profil_perusahaan.png',
                'nama'=>'TATI FEBRIYANTI',
                'id_jabatan_fk'=> 1,
                'deskripsi'=>'Mengawali langkah sebagai sebuah Divisi Syariah PT Reasuransi Internasional Indonesia (ReINDO) atau kini yang telah berganti nama menjadi PT Reasuransi Indonesia Utama (Indonesia Re) pada tahun 2004 hingga 2016, ReINDO Syariah telah mencatatkan sejarah panjang dengan sederet capaian gemilang sebagai retakaful terpercaya. Berbekal pengalaman panjang dan dukungan penuh pemegang saham, pemangku kepentingan, dan regulator, ReINDO Syariah pun melakukan spin-off sebagai perusahaan reasuransi syariah yang memfokuskan bisnisnya pada reasuransi jiwa dan umum. PT Reasuransi Syariah Indonesia (ReINDO Syariah) berdiri pada tanggal 4 Mei 2016 dan resmi beroperasi pada 1 Juni 2016. Dukungan berharga yang terus mengalir dari seluruh pemangku kepentingan, terutama karyawan dan ceding company, menjadi motivasi utama bagi ReINDO Syariah untuk senantiasa memperluas portofolio dan memperkuat infrastruktur bisnisnya. Sejalan dengan visi untuk menjadi reasuradur syariah yang terdepan, terkuat, dan terpercaya, ReINDO Syariah akan terus berkarya dan berkontribusi bagi kemajuan industri asuransi dan pembangunan ekonomi nasional.',
                'deskripsi_en'=>'Starting from 2004 to 2016, ReINDO Syariah has recorded a long history with a series of brilliant achievements as a trusted crackaful. Armed with long experience and full support from shareholders, stakeholders and regulators, ReINDO Syariah also carried out a spin-off as a sharia reinsurance company that focuses its business on life and general reinsurance. PT Reinsurance Syariah Indonesia (ReINDO Syariah) was founded on May 4 2016 and officially started operating on June 1 2016. The valuable support that continues to flow from all stakeholders, especially employees and the current company, is the main motivation for ReINDO Syariah to continuously expand its portfolio and strengthen business infrastructure. In line with its vision to become the leading, strongest and most trusted sharia reinsurer, ReINDO Syariah will continue to work and contribute to the progress of the insurance industry and national economic development.'

            ]

        ];

        foreach ($ucapan as $key => $value) {
            Ucapan::create($value);
        }
    }
}
