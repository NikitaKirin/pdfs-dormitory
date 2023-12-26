<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Country\CountryResourceCollection;
use App\Models\Country;

class CountryController extends Controller
{
    public function index()
    {
        return new CountryResourceCollection(Country::all());
    }
}
