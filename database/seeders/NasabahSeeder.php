<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Nasabah;
use App\Models\Saldo;
use Faker\Factory as Faker;

class NasabahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 20; $i++) {
            $nasabah = Nasabah::create([
                'no_registrasi' => 'REG' . $faker->unique()->numberBetween(100, 999),
                'nik' => $faker->numerify('################'),
                'nama_lengkap' => $faker->name,
                'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan']),
                'tempat_lahir' => $faker->city,
                'tanggal_lahir' => $faker->date('Y-m-d', '2000-01-01'),
                'no_hp' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'username' => $faker->unique()->userName,
                'password' => bcrypt('password123'),
                'alamat_lengkap' => $faker->address,
                'foto' => 'default.jpg',
            ]);

            Saldo::create([
                'nasabah_id' => $nasabah->id,
                'saldo' => 0,
                'tanggal_update' => now(),
            ]);
        }
    }
}
