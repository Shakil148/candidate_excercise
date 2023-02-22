<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use DB;
class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $records = [];

        // Generate the records
        for ($i = 1; $i <= 10; $i++) {
            $records[] = [
                'name' => $faker->unique()->name,
            ];

        }
        DB::table('subjects')->insert($records);
    }
}
