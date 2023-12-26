<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Gender\GenderResourceCollection;
use App\Models\Gender;

class GenderController extends Controller
{
    public function index()
    {
        return new GenderResourceCollection(Gender::all());
    }
}
