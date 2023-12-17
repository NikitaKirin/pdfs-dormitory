<?php

namespace Database\Factories;

use App\Models\AcademicGroup;
use DragonCode\Support\Facades\Helpers\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class AcademicGroupFactory extends Factory
{
    protected $model = AcademicGroup::class;

    public function definition(): array
    {
        return [
            'title' => Str::upper(Str::random(2)) . '-' . rand(100000, 999999),
        ];
    }
}
