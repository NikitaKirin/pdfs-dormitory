<?php

namespace App\Actions\DormRoom;

use App\DTO\DormRoom\CreateDormRoomData;
use App\Models\DormRoom;

class CreateDormRoomAction
{

    /**
     * @param CreateDormRoomData $data
     * @return DormRoom
     */
    public function run(CreateDormRoomData $data): DormRoom
    {
        return DormRoom::create([
            'number' => $data->number,
            'number_of_seats' => $data->number_of_seats,
            'dormitory_id' => $data->dormitory_id,
            'creator_id' => $data->creator_id,
            'last_update_user_id' => $data->creator_id,
            'comment' => $data->comment,
        ]);
    }
}
