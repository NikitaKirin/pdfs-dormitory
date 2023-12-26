<?php

namespace App\Actions\Student;

use App\DTO\Student\CreateStudentData;
use App\Models\Student;

class CreateStudentAction
{
    /**
     * @param CreateStudentData $data
     * @return Student
     */
    public function run(CreateStudentData $data): Student
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
                'dorm_room_id' => $data->dormRoomId,
            ]
        );
    }
}
