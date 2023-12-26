<?php

namespace App\DTO\DormRoom;

class CreateDormRoomData
{
    public function __construct(
        public readonly int    $number,
        public readonly int    $number_of_seats,
        public readonly int    $dormitory_id,
        public readonly int    $creator_id,
        public readonly string $comment,
    )
    {
    }
}
