<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $faker = Faker::create('jp_JP');
        $faker->seed(123);

        $daftar_titel = ["M.Kom", "M.Sc", "M.T", "M.Si"];
        for ($i=0; $i < 10; $i++) { 
            \App\Models\Dosen::create(
                [
                    'nama' => $faker->firstName." ".$faker->lastName." ".$faker->randomElement($daftar_titel)
                ]

                );
        }

        //Generate data mahasiswa
        $jurusan = ["Ilmu Komputer", "Teknik Informatika", "Sistem Informasi"];
        for ($i=0; $i < 10; $i++) { 
            \App\Models\Mahasiswa::create(
                [
                    'nama' => $faker->firstName." ".$faker->lastName,
                    'jurusan' => $faker->randomElement($jurusan),
                ]
                );
        }

        //Generate data beasiswa
        $beasiswa = ["Pertamina", "Telkom", "LPDP", "Kemendikbud", "PPA"];
        for ($i = 0; $i < 5; $i++) {
            \App\Models\Beasiswa::create(
                [
                    'nama' => "Beasiswa " . $faker->unique()->randomElement($beasiswa),
                    'jumlah_dana' => $faker->numberBetween(5, 12) * 1000000,
                ]
            );
        }

    }
}
