<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Transaction;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 20; $i++) {
            Transaction::create([
                'member_id' => $faker->randomNumber(5),
                'date_start' => $faker->date,
                'date_end' => $faker->date,
                'name' => $faker->name,
                'how_many_days' => $faker->randomNumber(2),
                'total_book' => $faker->numberBetween(1, 50),
                'total_payment' => $faker->numberBetween(1, 1000),
                'status' => $faker->randomElement(['pending', 'approved', 'rejected']),
            ]);
        }
    }
}
