<?php

namespace Database\Factories;

use App\Models\DataDownload;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DataDownloadSeeder>
 */
class DataDownloadModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = DataDownload::class;

    public function definition()
    {
        return [
            'nama' => $this->faker->name(),
            'email' => $this->faker->email(),
            'kategori' => $this->faker->randomElement([1, 2]),
            'waktu'    => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
