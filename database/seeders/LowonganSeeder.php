<?php

namespace Database\Seeders;

use App\Models\Lowongan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LowonganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $link = [
            [
                'url'=>'https://id.linkedin.com/company/reindosyariah',
            ]

        ];

        foreach ($link as $key => $value) {
            Lowongan::create($value);
        }
    }
}
