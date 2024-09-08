<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AkunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            [
                'name'=>'AkunAdmin',
                'username'=>'admin',
                'email'=>'admin@gmail.com',
                'password'=>Hash::make('admin12345')
            ]

        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }

    }
}
