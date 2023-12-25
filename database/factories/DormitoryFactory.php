<?php

namespace Database\Factories;

use App\Models\Dormitory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class DormitoryFactory extends Factory
{
    protected $model = Dormitory::class;


    public function definition(): array
    {
        return [
            'number' => $this->faker->unique()->randomDigit(),
            'address' => $this->faker->address(),
            'comment' => $this->faker->word(),
            'creator_id' => User::all()->random()->id,
            'last_update_user_id' => User::all()->random()->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
