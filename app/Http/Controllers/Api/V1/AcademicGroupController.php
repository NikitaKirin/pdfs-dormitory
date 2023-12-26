<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\AcademicGroup\AcademicGroupResourceCollection;
use App\Models\AcademicGroup;

class AcademicGroupController extends Controller
{
    public function index()
    {
        return new AcademicGroupResourceCollection(AcademicGroup::all());
    }
}
