<?php

declare(strict_types=1);

namespace App\Services;

use App\DTO\Student\CreateStudentData;
use App\DTO\Student\CreateStudentPaymentData;
use App\DTO\Student\UpdateStudentData;
use App\DTO\Student\UpdateStudentPaymentData;
use App\Models\Student;
use App\Models\StudentPayment;

class StudentService
{
    public function create(CreateStudentData $data): Student
    {
        return Student::create(
            [
                'latin_name' => $data->latinName,
                'cyrillic_name' => $data->cyrillicName,
                'is_family' => $data->isFamily,
                'telephone' => $data->telephone,
                'eisu_id' => $data->eisuId,
                'comment' => $data->comment,
                'country_id' => $data->countryId,
                'gender_id' => $data->genderId,
                'academic_group_id' => $data->academicGroupId,
                'creator_id' => $data->creator_id,
                'last_update_user_id' => $data->creator_id,
            ]
        );
    }

    public function update(UpdateStudentData $data, Student $student): bool
    {
        return $student->update(
            [
                'latin_name' => $data->latinName,
                'cyrillic_name' => $data->cyrillicName,
                'is_family' => $data->isFamily,
                'telephone' => $data->telephone,
                'eisu_id' => $data->eisuId,
                'comment' => $data->comment,
                'country_id' => $data->countryId,
                'gender_id' => $data->genderId,
                'academic_group_id' => $data->academicGroupId,
                'last_update_user_id' => $data->lastUpdateUserId,
            ]
        );
    }

    public function settle(Student $student, int $dormRoomId): bool
    {
        return $student->dormRoom()->associate($dormRoomId)->save();
    }

    public function evict(Student $student): bool
    {
        return $student->dormRoom()->dissociate()->save();
    }
}
