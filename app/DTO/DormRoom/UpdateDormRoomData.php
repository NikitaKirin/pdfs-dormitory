<?php

namespace App\DTO\DormRoom;

class UpdateDormRoomData
{
    public function __construct(
        public readonly int    $number,
        public readonly int    $number_of_seats,
        public readonly int    $dormitory_id,
        public readonly int    $last_update_user_id,
        public readonly string $comment,
    )
    {
    }
}
