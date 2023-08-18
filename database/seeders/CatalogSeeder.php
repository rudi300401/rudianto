<?php

namespace Database\Seeders;

use App\Models\catalog;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class CatalogSeeder extends Seeder
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
            $catalog = new Catalog();

            $catalog->nama = $faker->name;

            $catalog->save();
        }
    }
}