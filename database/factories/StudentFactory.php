<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Student;
use App\Models\Department;
use Ramsey\Uuid\Uuid;
use Faker\Factory as Faker;

class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $departments = Department::get();
        $faker = Faker::create();
        static $id = 1;
        $student_id = 'sid-'.$id++;
            return [
                'first_name' => $faker->firstName(),
                'last_name' => $faker->lastName(),
                'student_id' => $student_id,
                'age' => $faker->numberBetween(18, 30),
                'department_id' => $departments[rand(0, (sizeof($departments)-1))]->id,
            ];
    }
}
