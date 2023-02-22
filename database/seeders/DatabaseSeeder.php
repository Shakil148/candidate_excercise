<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    protected $seeders = [
        DepartmentsTableSeeder::class,
        StudentsTableSeeder::class,
        SubjectsTableSeeder::class,
    ];
    public function run()
    {
        foreach ($this->seeders as $seeder) {
            $this->call($seeder);
        }
    }
}
