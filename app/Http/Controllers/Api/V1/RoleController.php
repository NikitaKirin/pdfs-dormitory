<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Actions\Role\CreateRoleAction;
use App\Actions\Role\UpdateRoleAction;
use App\DTO\Role\CreateRoleData;
use App\DTO\Role\UpdateRoleData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Role\StoreRoleRequest;
use App\Http\Requests\Api\V1\Role\UpdateRoleRequest;
use App\Http\Resources\V1\Role\RoleResource;
use App\Http\Resources\V1\Role\RoleResourceCollection;
use App\Models\Role;
use Illuminate\Http\Response;
use Request;

class RoleController extends Controller
{
    /**
     * @return RoleResourceCollection
     */
    public function index()
    {
        return new RoleResourceCollection(Role::with(['permissions'])->get());
    }

    /**
     * @param StoreRoleRequest $request
     * @return RoleResource
     */
    public function store(StoreRoleRequest $request)
    {
        $validated = $request->validated();
        $data = new CreateRoleData($validated['title'], $validated['permissions'] ?? []);
        $role = (new CreateRoleAction())->run($data);
        return RoleResource::make($role)->additional(['message' => __('crud.messages.create.success')]);
    }

    /**
     * @param UpdateRoleRequest $request
     * @param Role $role
     * @return RoleResource
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $validated = $request->validated();
        $data = new UpdateRoleData($validated['title'], $validated['permissions'] ?? []);
        (new UpdateRoleAction())->run($role, $data);
        return RoleResource::make($role)->additional(['message' => __('crud.messages.update.success')]);
    }


    /**
     * @param Role $role
     * @return Response
     */
    public function delete(Role $role)
    {
        if ($role->delete()) {
            return response(['message' => __('crud.messages.delete.success'),]);
        }
        return response(['message' => __('crud.messages.delete.fail')], 409);
    }

    /**
     * @param Request $request
     * @param Role $role
     * @return Response
     */
    public function destroy(Request $request, Role $role)
    {
        if ($role->forceDelete()) {
            return response(['message' => __('crud.messages.delete.success'),]);
        }
        return response(['message' => __('crud.messages.delete.fail')], 409);
    }
}
