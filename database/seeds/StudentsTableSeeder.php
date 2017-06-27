<?php

use Illuminate\Database\Seeder;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lstGender = array('M','F',);

        // Use Faker library to generate test data
        $faker = Faker\Factory::create();
        $limit = 10;
        for($i = 0; $i < $limit; $i++) {
            DB::table('students')->insert([
                'tutor_id' => 1,
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'gender' => array_rand($lstGender),
                'date_of_birth' => $faker->date(),
                'grade' => rand(1,12),
                'parent_fname' => $faker->firstName,
                'parent_lname' => $faker->lastName,
                'parent_phone_number' => $faker->phoneNumber,
                'parent_email' => $faker->email
            ]);
        }

    }
}
