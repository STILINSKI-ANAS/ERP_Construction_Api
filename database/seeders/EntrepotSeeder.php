<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class EntrepotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            \DB::table('entrepot')->insert([
                'name' => $faker->sentence(2),
                'Identifiant' => $faker->ean13,
                'prix_achat' => $faker->randomFloat(2, 800, 1000),
                'prix_vente' => $faker->randomFloat(2, 1000, 1200),
                'category' => $faker->word,
                'quantity' => $faker->numberBetween(75, 150),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
