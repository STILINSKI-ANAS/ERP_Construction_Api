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
        // \App\Models\client::factory(10)->create();

        // \App\Models\client::factory()->create([
        //     'name' => 'John Doe',
        //     'adress' => '123 Main St',
        //     'CIN' => '1234567890',
        //     'balance' => 1000.00,
        //     'email' => 'john@example.com',
        //     'phoneNumber' => '555-555-1212',
        // ],);

        // \DB::table('clients')->insert([
        //     [
        //         'name' => 'John Doe',
        //         'adress' => '123 Main St',
        //         'CIN' => '1234567890',
        //         'balance' => 1000.00,
        //         'email' => 'john@example.com',
        //         'phoneNumber' => '555-555-1212',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'name' => 'Jane Doe',
        //         'adress' => '456 Main St',
        //         'CIN' => '0987654321',
        //         'balance' => 2000.00,
        //         'email' => 'jane@example.com',
        //         'phoneNumber' => '555-555-1212',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        // ]);

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
