<?php

namespace App\Actions\Dormitory;

use App\DTO\Dormitory\UpdateDormitoryData;
use App\Models\Dormitory;

class UpdateDormitoryAction
{
    public function run(UpdateDormitoryData $data, Dormitory $dormitory)
    {
        return $dormitory->update([
            'number' => $data->number,
            'address' => $data->address,
            'comment' => $data->comment,
            'last_update_user_id' => $data->lastUpdateUserId,
        ]);
    }
}
