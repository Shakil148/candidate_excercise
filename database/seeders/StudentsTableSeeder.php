<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use DB;
use App\Jobs\ProcessJob;
use App\Models\Department;
use App\Models\Student;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $total_records = 1000000;
        $per_batch = 1000;
        $batches = ceil($total_records / $per_batch);

        for ($i = 0; $i < $batches; $i++) {
            $students = Student::factory()->count($per_batch)->make()->toArray();
            Student::insert($students);
        }
    }
}
