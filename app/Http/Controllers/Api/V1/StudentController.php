<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Student\IndexStudentRequest;
use App\Http\Resources\V1\Student\StudentResourceCollection;
use App\Models\Student;

class StudentController extends Controller
{
    public function index(IndexStudentRequest $request, bool $with_dormitory = false)
    {
        $validated = $request->validated();
        $builder = Student::with(['country', 'academicGroup', 'creator', 'lastUpdateUser', 'gender']);
        if ($request->get('with_dormitory')) {
            $builder->with('dormRooms.dormitory');
        }
        return new StudentResourceCollection($builder->paginate(
            $validated['per_page'] ?? 15
        ));
    }
}
