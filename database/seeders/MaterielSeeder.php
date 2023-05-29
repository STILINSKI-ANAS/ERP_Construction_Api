<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class MaterielSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            \DB::table('materiels')->insert([
                'title' => $faker->sentence(2),
                'hourly_rate' => $faker->randomFloat(2, 500, 1000),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
