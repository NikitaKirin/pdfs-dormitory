<?php

namespace App\DTO\Dormitory;

class CreateDormitoryData
{
    public function __construct(
        public readonly int    $number,
        public readonly string $address,
        public readonly string $comment,
        public readonly int $creatorId,
    )
    {
    }
}
