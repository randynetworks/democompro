<?php

namespace Database\Seeders;

use App\Http\Controllers\ucapanController;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AkunSeeder::class,
            DataDownloadSeeder::class,
            DokumentasiSeeder::class,
            JajaranKamiSeeder::class,
            KontakKamiSeeder::class,
            LandingSeeder::class,
            LowonganSeeder::class,
            NilaiSeeder::class,
            ProfilSeeder::class,
            SertifikatSeeder::class,
            TujuanSeeder::class,
            UcapanSeeder::class,
            VisiMisiSeeder::class,            
        ]);
    }
}
