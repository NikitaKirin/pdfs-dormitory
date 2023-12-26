<?php

namespace App\Actions\DormRoom;

use App\DTO\DormRoom\UpdateDormRoomData;
use App\Models\DormRoom;

class UpdateDormRoomAction
{

    /**
     * @param UpdateDormRoomData $data
     * @param DormRoom $dormRoom
     * @return bool
     */
    public function run(UpdateDormRoomData $data, DormRoom $dormRoom): bool
    {
        return $dormRoom->update([
            'number' => $data->number,
            'number_of_seats' => $data->number_of_seats,
            'dormitory_id' => $data->dormitory_id,
            'last_update_user_id' => $data->last_update_user_id,
            'comment' => $data->comment,
        ]);
    }
}
