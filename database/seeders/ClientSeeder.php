<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            \DB::table('clients')->insert([
                'name' => $faker->name,
                'addresse' => $faker->address,
                'CIN' => $faker->unique()->randomNumber(9),
                'balance' => $faker->randomFloat(2, 0, 10000),
                'email' => $faker->unique()->safeEmail,
                'phoneNumber' => $faker->phoneNumber,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
