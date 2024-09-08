<?php

namespace Database\Seeders;

use App\Models\Landing;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LandingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $landing = [
            [
                'gambar'=>'profil_perusahaan.png',
                'nama_perusahaan'=>'Reinsuransi Indonesia Syariah',
                'motto'=>'Andal, profesional, Amanah',
                'motto_en'=>'Reliable, professional, trustworthy',
                'deskripsi'=>'Reindo Syariah is a person who is reliable, professional, trustworthy and always tries to improve himself to become a center of knowledge, always making improvements in all fields to get the best results.',
                'deskripsi_en'=>'Mengawali langkah sebagai sebuah Divisi Syariah PT Reasuransi Internasional Indonesia (ReINDO) atau kini yang telah berganti nama menjadi PT Reasuransi Indonesia Utama (Indonesia Re) pada tahun 2004 hingga 2016, ReINDO Syariah telah mencatatkan sejarah panjang dengan sederet capaian gemilang sebagai retakaful terpercaya. Berbekal pengalaman panjang dan dukungan penuh pemegang saham, pemangku kepentingan, dan regulator, ReINDO Syariah pun melakukan spin-off sebagai perusahaan reasuransi syariah yang memfokuskan bisnisnya pada reasuransi jiwa dan umum. PT Reasuransi Syariah Indonesia (ReINDO Syariah) berdiri pada tanggal 4 Mei 2016 dan resmi beroperasi pada 1 Juni 2016. Dukungan berharga yang terus mengalir dari seluruh pemangku kepentingan, terutama karyawan dan ceding company, menjadi motivasi utama bagi ReINDO Syariah untuk senantiasa memperluas portofolio dan memperkuat infrastruktur bisnisnya. Sejalan dengan visi untuk menjadi reasuradur syariah yang terdepan, terkuat, dan terpercaya, ReINDO Syariah akan terus berkarya dan berkontribusi bagi kemajuan industri asuransi dan pembangunan ekonomi nasional.'
            ]

        ];

        foreach ($landing as $key => $value) {
            Landing::create($value);
        }
    }
}
