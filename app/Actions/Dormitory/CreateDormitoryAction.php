<?php

namespace App\Actions\Dormitory;

use App\DTO\Dormitory\CreateDormitoryData;
use App\Models\Dormitory;

class CreateDormitoryAction
{
    public function run(CreateDormitoryData $data)
    {
        return Dormitory::create([
            'number' => $data->number,
            'address' => $data->address,
            'comment' => $data->comment,
            'creator_id' => $data->creator_id,
            'last_update_user_id' => $data->creator_id,
        ]);
    }
}
