<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pengepul;
use Faker\Factory as Faker;

class PengepulSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 15; $i++) {
            Pengepul::create([
                'nama' => $faker->company,
                'alamat' => $faker->address,
                'kontak' => $faker->phoneNumber,
            ]);
        }
    }
}
