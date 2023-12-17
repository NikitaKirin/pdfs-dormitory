<?php

namespace Database\Factories;

use App\Models\AcademicGroup;
use App\Models\Country;
use App\Models\Gender;
use App\Models\Student;
use App\Models\User;
use DragonCode\Support\Facades\Helpers\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class StudentFactory extends Factory
{
    protected $model = Student::class;

    public function definition(): array
    {
        $cyrillicName = $this->faker->name();
        $latinName = Str::title(Str::slug($cyrillicName, ' '));
        return [
            'latin_name' => $latinName,
            'cyrillic_name' => $cyrillicName,
            'is_family' => $this->faker->boolean(),
            'telephone' => $this->faker->numerify('+7 (###)-###-##'),
            'eisu_id' => Str::random(20),
            'comment' => $this->faker->realTextBetween(10, 40),
            'gender_id' => Gender::all()->random()->id,
            'creator_id' => User::all()->random()->id,
            'last_update_user_id' => User::all()->random()->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'country_id' => Country::all()->random()->id,
            'academic_group_id' => AcademicGroup::all()->random()->id,
        ];
    }
}
