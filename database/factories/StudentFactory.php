<?php

namespace Database\Factories;

use App\Models\AcademicGroup;
use App\Models\Country;
use App\Models\DormRoom;
use App\Models\Gender;
use App\Models\Student;
use App\Models\User;
use DragonCode\Support\Facades\Helpers\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class StudentFactory extends Factory
{
    protected $model = Student::class;

    public function configure(): static
    {
        return $this->afterMaking(function (Student $student) {
            $query = DormRoom::withCount('students');
            $availableDormRooms = ($student->is_family)
                ? $query->ofFamily(true)->notOccupied()->orderBy('students_count', 'DESC')->get()
                : $query->ofGender($student->gender_id)->ofFamily(false)->notOccupied()
                    ->orderBy('students_count', 'DESC')->get();
            $student->dorm_room_id = ($availableDormRooms->count()) ? $availableDormRooms->random()->id : null;
        });
    }

    public function definition(): array
    {
        $cyrillicName = $this->faker->name();
        $latinName = Str::title(Str::slug($cyrillicName, ' '));
        return [
            'latin_name' => $latinName,
            'cyrillic_name' => $cyrillicName,
            'is_family' => $this->faker->boolean(),
            'telephone' => $this->faker->numerify('+7 (###) ###-##-##'),
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
