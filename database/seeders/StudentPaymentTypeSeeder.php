<?php

namespace Database\Seeders;

use App\Models\StudentPaymentType;
use Illuminate\Database\Seeder;

class StudentPaymentTypeSeeder extends Seeder
{

    private array $types = [
        ['title' => 'Education'],
        ['title' => 'Communal'],
        ['title' => 'Security deposit']
    ];

    public function run(): void
    {
        foreach ($this->types as $type) {
            StudentPaymentType::updateOrCreate($type);
        }
    }
}
