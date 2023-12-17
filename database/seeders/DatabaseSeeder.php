<?php

namespace Database\Seeders;

use App\Models\AcademicGroup;
use App\Models\Country;
use App\Models\Dormitory;
use App\Models\DormRoom;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(GenderSeeder::class);
        User::factory(15)->create();
        Country::factory(30)->create();
        AcademicGroup::factory(30)->create();
        Student::factory(1000)->create();
        Dormitory::factory(3)->create();
        DormRoom::factory(500)->create();
    }
}
