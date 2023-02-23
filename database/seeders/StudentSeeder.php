<?php

namespace Database\Seeders;

use App\Models\student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as faker;
class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = faker::create();
        foreach (range(1,100) as $key => $value) {
            # code...
            $stu = new student();
            $stu->name = $faker->name('male');
            $stu->email = $faker->unique()->email();
            $stu->save();
        }
    }
}
