<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StudentPayment\ImportStudentPaymentRequest;
use App\Imports\StudentPaymentImport;
use Maatwebsite\Excel\Facades\Excel;

class StudentPaymentController extends Controller
{
    public function import(ImportStudentPaymentRequest $request)
    {
        Excel::queueImport(new StudentPaymentImport(), $request->validated('file'))->allOnQueue('imports');
        return response()->json(['message' => __('imports.messages.file.imported') ]);
    }
}
