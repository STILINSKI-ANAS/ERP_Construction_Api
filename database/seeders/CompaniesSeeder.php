<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class CompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            \DB::table('companies')->insert([
                'name' => $faker->name,
                'addresse' => $faker->address,
                'capital' => $faker->randomFloat(2, 0, 10000),
                'RC' => $faker->unique()->randomNumber(9),
                'ICE' => $faker->unique()->randomNumber(9),
                'description' => $faker->paragraphs(2, true),
                'email' => $faker->unique()->safeEmail,
                'phoneNumber' => $faker->phoneNumber,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
