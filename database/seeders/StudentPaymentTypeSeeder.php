<?php

namespace Database\Seeders;

use App\Models\StudentPaymentType;
use Illuminate\Database\Seeder;

class StudentPaymentTypeSeeder extends Seeder
{

    private array $types = [
        ['title' => \App\Enums\StudentPaymentTypeEnum::Educational->value],
        ['title' => \App\Enums\StudentPaymentTypeEnum::Communal->value],
        ['title' => \App\Enums\StudentPaymentTypeEnum::SecurityDeposit->value]
    ];

    public function run(): void
    {
        foreach ($this->types as $type) {
            StudentPaymentType::updateOrCreate($type);
        }
    }
}
