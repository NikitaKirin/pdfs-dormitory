<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\Student\CreateStudentAction;
use App\Actions\Student\UpdateStudentAction;
use App\DTO\Student\CreateStudentData;
use App\DTO\Student\UpdateStudentData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Student\IndexStudentRequest;
use App\Http\Requests\Api\V1\Student\SettleStudentRequest;
use App\Http\Requests\Api\V1\Student\StoreStudentRequest;
use App\Http\Requests\Api\V1\Student\UpdateStudentRequest;
use App\Http\Resources\V1\Student\StudentResource;
use App\Http\Resources\V1\Student\StudentResourceCollection;
use App\Models\Student;
use App\Services\StudentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{

    public function __construct(
        protected readonly StudentService $studentService
    ) {}

    /**
     * @param IndexStudentRequest $request
     * @return StudentResourceCollection
     */
    public function index(IndexStudentRequest $request)
    {
        $builder = Student::with(['country', 'academicGroup', 'creator', 'lastUpdateUser', 'gender']);
        if ($request->get('with_dormitory')) {
            $builder->with('dormRoom.dormitory');
        }
        $builder->ofLatinName($request->get('latin_name', ''));
        $builder->ofCyrillicName($request->get('cyrillic_name', ''));
        if ($genderId = $request->get('gender_id')) {
            $builder->ofGender($genderId);
        }
        if ($countries = $request->get('countries')) {
            $builder->ofCountries($countries);
        }
        if ($sortBy = $request->get('sort_by')) {
            $builder->orderBy($sortBy['column'], $sortBy['direction']);
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
        );
        $student = $this->studentService->create($data);
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
        );
        if ($this->studentService->update($data, $student)) {
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

    public function settle(SettleStudentRequest $request, Student $student)
    {
        if ($this->studentService->settle($student, $request->integer('dorm_room_id'))) {
            return response(['message' => __('student.messages.settle.success')]);
        };
        return response(['message' => __('student.messages.settle.fail')], 304);
    }

    public function evict(Request $request, Student $student)
    {
        if ($this->studentService->evict($student)) {
            return response(['message' => __('student.messages.evict.success')]);
        };
        return response(['message' => __('student.messages.evict.fail')], 304);
    }
}
