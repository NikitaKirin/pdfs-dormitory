<?php

namespace Database\Seeders;

use App\Models\SettlementStatus;
use Illuminate\Database\Seeder;

class SettlementStatusSeeder extends Seeder
{
    protected array $statuses = [
        ['title' => 'check-in'],
        ['title' => 'check-out'],
    ];

    public function run(): void
    {
        foreach ($this->statuses as $status) {
            SettlementStatus::query()->updateOrCreate($status);
        }
    }
}
