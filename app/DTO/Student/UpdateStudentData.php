<?php

namespace App\DTO\Student;

class UpdateStudentData
{
    /**
     * @param string $latinName
     * @param string $cyrillicName
     * @param bool $isFamily
     * @param string|null $telephone
     * @param string|null $eisuId
     * @param string|null $comment
     * @param int|null $countryId
     * @param int|null $genderId
     * @param int|null $academicGroupId
     * @param int $lastUpdateUserId
     * @param int|null $dormRoomId
     */
    public function __construct(
        public readonly string  $latinName,
        public readonly string  $cyrillicName,
        public readonly bool    $isFamily,
        public readonly ?string $telephone,
        public readonly ?string $eisuId,
        public readonly ?string $comment,
        public readonly ?int    $countryId,
        public readonly ?int    $genderId,
        public readonly ?int    $academicGroupId,
        public readonly int     $lastUpdateUserId,
        public readonly ?int    $dormRoomId,
    )
    {
    }
}
