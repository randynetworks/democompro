<?php

namespace Database\Seeders;

use App\Models\KontakKami;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KontakKamiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'email'=>'cosecretary@reindosyariah.co.id',
                'phone'=>'T 62 21 22478009',
                'location'=>'Gedung Reindo Syariah Jl. Rawamangun Muka Raya No. 2 Jakarta Timur',
                'maps'=>'<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.50588619175!2d106.87310567377962!3d-6.196787060705514!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f44697913653%3A0x1374b195a11fce23!2sReINDO%20Syariah!5e0!3m2!1sid!2sid!4v1717055687011!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
            ]

        ];

        foreach ($data as $key => $value) {
            KontakKami::create($value);
        }
    }
}
