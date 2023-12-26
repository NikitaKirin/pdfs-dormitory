<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\Student\CreateStudentAction;
use App\Actions\Student\UpdateStudentAction;
use App\DTO\Student\CreateStudentData;
use App\DTO\Student\UpdateStudentData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Student\IndexStudentRequest;
use App\Http\Requests\Api\V1\Student\StoreStudentRequest;
use App\Http\Requests\Api\V1\Student\UpdateStudentRequest;
use App\Http\Resources\V1\Student\StudentResource;
use App\Http\Resources\V1\Student\StudentResourceCollection;
use App\Models\Student;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    /**
     * @param IndexStudentRequest $request
     * @return StudentResourceCollection
     */
    public function index(IndexStudentRequest $request)
    {
        $builder = Student::with(['country', 'academicGroup', 'creator', 'lastUpdateUser', 'gender']);
        if ($request->get('with_dormitory')) {
            $builder->with('dormRooms.dormitory');
        }
        return new StudentResourceCollection($builder->paginate(
            $request->validated('per_page') ?? 15
        ));
    }

    /**
     * @param StoreStudentRequest $request
     * @return StudentResource
     */
    public function store(StoreStudentRequest $request)
    {
        $data = new CreateStudentData(
            $request->validated('latin_name'),
            $request->validated('cyrillic_name'),
            $request->validated('is_family'),
            $request->validated('telephone'),
            $request->validated('eisu_id'),
            $request->validated('comment'),
            $request->validated('country_id'),
            $request->validated('gender_id'),
            $request->validated('academic_group_id'),
            Auth::id(),
            $request->validated('dorm_room_id'),
        );
        $student = (new CreateStudentAction())->run($data);
        return StudentResource::make($student->load(['gender', 'country', 'academicGroup', 'dormRoom']))
            ->additional(['message' => __('crud.messages.create.success')]);
    }

    /**
     * @param UpdateStudentRequest $request
     * @param Student $student
     * @return StudentResource|JsonResponse
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        $data = new UpdateStudentData(
            $request->validated('latin_name'),
            $request->validated('cyrillic_name'),
            $request->validated('is_family'),
            $request->validated('telephone'),
            $request->validated('eisu_id'),
            $request->validated('comment'),
            $request->validated('country_id'),
            $request->validated('gender_id'),
            $request->validated('academic_group_id'),
            Auth::id(),
            $request->validated('dorm_room_id'),
        );
        if ((new UpdateStudentAction())->run($data, $student)) {
            return StudentResource::make($student->load(['gender', 'country', 'academicGroup', 'dormRoom']))
                ->additional(['message' => __('crud.messages.update.success')]);
        }
        return response()->json(['message' => __('crud.messages.update.fail')], 501);
    }

    /**
     * @param Student $student
     * @return Response
     */
    public function delete(Student $student): Response
    {
        if ($student->delete()) {
            return response(['message' => __('crud.messages.delete.success'),]);
        }
        return response(['message' => __('crud.messages.delete.fail')], 409);
    }

    /**
     * @param Student $student
     * @return Response
     */
    public function destroy(Student $student): Response
    {
        if ($student->forceDelete()) {
            return response(['message' => __('crud.messages.delete.success'),]);
        }
        return response(['message' => __('crud.messages.delete.fail')], 409);
    }
}
