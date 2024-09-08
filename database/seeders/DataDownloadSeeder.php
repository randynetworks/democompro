<?php

namespace Database\Seeders;

use App\Models\DataDownload;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DataDownloadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DataDownload::factory()->count(50)->create();

    }
}
