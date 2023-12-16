<?php

namespace Database\Seeders;

use App\Models\Gender;
use Illuminate\Database\Seeder;

class GenderSeeder extends Seeder
{
    private array $genders = [
        'Male',
        'Female',
    ];

    public function run(): void
    {
        foreach ($this->genders as $gender) {
            Gender::create([
                'title' => $gender,
            ]);
        }
    }
}
