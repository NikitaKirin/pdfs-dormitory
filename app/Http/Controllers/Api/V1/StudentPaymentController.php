<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StudentPayment\ImportStudentPaymentRequest;
use App\Imports\StudentPaymentImport;
use App\Jobs\User\NotifyUserOfCompletedStudentPaymentImport;
use Maatwebsite\Excel\Facades\Excel;

class StudentPaymentController extends Controller
{
    public function import(ImportStudentPaymentRequest $request)
    {
        Excel::queueImport(new StudentPaymentImport($request->user()), $request->validated('file'))
            ->allOnQueue('imports')
        ->chain([new NotifyUserOfCompletedStudentPaymentImport($request->user())]);
        return response()->json(['message' => __('imports.messages.file.imported') ]);
    }
}
