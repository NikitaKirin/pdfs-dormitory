<?php

namespace App\Actions\Student;

use App\DTO\Student\UpdateStudentData;
use App\Models\Student;

class UpdateStudentAction
{

    /**
     * @param UpdateStudentData $data
     * @param Student $student
     * @return bool
     */
    public function run(UpdateStudentData $data, Student $student): bool
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
                'dorm_room_id' => $data->dormRoomId,
            ]
        );
    }
}
