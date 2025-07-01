<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Nasabah;
use App\Models\Feedback;
use Faker\Factory as Faker;

class FeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 20; $i++) {
            Feedback::create([
                'judul_feedback' => $faker->sentence(6),
                'isi_feedback' => $faker->paragraph(3),
                'nasabah_id' => $faker->numberBetween(1, 7),
            ]);
        }
    }
}
