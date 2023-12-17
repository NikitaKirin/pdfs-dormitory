<?php

namespace Database\Factories;

use App\Models\Dormitory;
use App\Models\DormRoom;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class DormRoomFactory extends Factory
{
    protected $model = DormRoom::class;

    public function definition(): array
    {
        return [
            'number' => rand(100, 999),
            'number_of_seats' => rand(2, 6),
            'comment' => $this->faker->word(),
            'dormitory_id' => Dormitory::all()->random()->id,
            'creator_id' => User::all()->random()->id,
            'last_update_user_id' => User::all()->random()->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
