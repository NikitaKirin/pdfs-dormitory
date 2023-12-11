<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Permission\PermissionResourceCollection;
use App\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        return new PermissionResourceCollection(Permission::all());
    }
}
