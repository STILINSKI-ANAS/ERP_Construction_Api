<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            \DB::table('projets')->insert([
                'name' => $faker->sentence(2),
                'addresse' => $faker->address,
                'charges' => $faker->randomFloat(10000, 0, 20000),
                'produits' => $faker->randomFloat(2, 20000, 30000),
                'balance' => $faker->randomFloat(2, 0, 10000),
                'numEmployes' => $faker->numberBetween(1, 100),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
