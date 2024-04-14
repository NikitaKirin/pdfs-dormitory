<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\DTO\Student\CreateStudentPaymentData;
use App\DTO\Student\UpdateStudentPaymentData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StudentPayment\ImportStudentPaymentRequest;
use App\Http\Requests\Api\V1\StudentPayment\StoreStudentPaymentRequest;
use App\Http\Requests\Api\V1\StudentPayment\UpdateStudentPaymentRequest;
use App\Http\Requests\Api\V1\StudentPaymentType\IndexStudentPaymentTypeRequest;
use App\Http\Resources\V1\Student\StudentPaymentResource;
use App\Http\Resources\V1\Student\StudentPaymentResourceCollection;
use App\Http\Resources\V1\StudentPaymentType\StudentPaymentTypeResourceCollection;
use App\Imports\StudentPaymentImport;
use App\Jobs\User\NotifyUserOfCompletedStudentPaymentImport;
use App\Models\Student;
use App\Models\StudentPayment;
use App\Models\StudentPaymentType;
use App\Services\StudentPaymentService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class StudentPaymentController extends Controller
{
    public function __construct(
        private readonly StudentPaymentService $studentPaymentService
    ) {
    }

    public function index(Request $request, Student $student)
    {
        return new StudentPaymentResourceCollection($student->payments->load('studentPaymentType'));
    }

    public function store(StoreStudentPaymentRequest $request)
    {
        $data = new CreateStudentPaymentData(
            $request->validated('student_id'),
            $request->validated('student_payment_type_id'),
            $request->validated('value'),
            $request->validated('comment'),
        );

        $payment = $this->studentPaymentService->create($data);

        return StudentPaymentResource::make($payment->load('studentPaymentType'))
            ->additional(['message' => __('crud.messages.create.success')]);
    }

    public function update(UpdateStudentPaymentRequest $request, StudentPayment $payment)
    {
        $data = new UpdateStudentPaymentData(
            $request->validated('student_id'),
            $request->validated('student_payment_type_id'),
            $request->validated('value'),
            $request->validated('comment'),
        );

        if ($this->studentPaymentService->update($data, $payment)) {
            return StudentPaymentResource::make($payment->load('studentPaymentType'))
                ->additional(['message' => __('crud.messages.update.success')]);
        }

        return response()->json(['message' => __('crud.messages.update.fail')], 501);
    }

    public function destroy(StudentPayment $payment)
    {
        if ($payment->delete()) {
            return response(['message' => __('crud.messages.delete.success'),]);
        }
        return response(['message' => __('crud.messages.delete.fail')], 409);
    }

    public function import(ImportStudentPaymentRequest $request)
    {
        Excel::queueImport(new StudentPaymentImport($request->user()), $request->validated('file'))
            ->allOnQueue('imports')
            ->chain([new NotifyUserOfCompletedStudentPaymentImport($request->user())]);
        return response()->json(['message' => __('imports.messages.file.imported') ]);
    }

    public function indexPaymentType(IndexStudentPaymentTypeRequest $request)
    {
        return new StudentPaymentTypeResourceCollection(
            StudentPaymentType::paginate($request->integer('per_page', 15))
        );
    }
}
