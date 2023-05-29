<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            \DB::table('workers')->insert([
                'title' => $faker->sentence(2),
                'hourly_rate' => $faker->randomFloat(2, 75, 170),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
