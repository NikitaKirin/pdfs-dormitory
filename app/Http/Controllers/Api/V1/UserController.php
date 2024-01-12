<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Actions\User\CreateUserAction;
use App\Actions\User\UpdateUserAction;
use App\DTO\User\CreateUserData;
use App\DTO\User\UpdateUserData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\User\IndexUserRequest;
use App\Http\Requests\Api\V1\User\StoreUserRequest;
use App\Http\Requests\Api\V1\User\UpdateUserRequest;
use App\Http\Resources\V1\User\UserResource;
use App\Http\Resources\V1\User\UserResourceCollection;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * @param IndexUserRequest $request
     * @return UserResourceCollection
     */
    public function index(IndexUserRequest $request)
    {
        $validated = $request->validated();
        return new UserResourceCollection(User::with(['roles.permissions', 'permissions'])
            ->paginate($validated['per_page'] ?? 15));
    }

    /**
     * @param StoreUserRequest $request
     * @return UserResource|Response
     */
    public function store(StoreUserRequest $request): UserResource|Response
    {
        $validated = $request->validated();
        $data = new CreateUserData(
            $validated['name'],
            $validated['email'],
            $validated['password'],
            boolval($validated['is_admin']),
            $validated['roles'] ?? [],
            $validated['permissions'] ?? []);
        $user = (new CreateUserAction())->run($data);
        $user->load(['roles.permissions', 'permissions']);
        return UserResource::make($user)->additional(['message' => __('crud.messages.create.success')]);
    }

    /**
     * @param UpdateUserRequest $request
     * @param User $user
     * @return UserResource|Response
     */
    public function update(UpdateUserRequest $request, User $user): UserResource|Response
    {
        $validated = $request->validated();
        $data = new UpdateUserData(
            $validated['name'],
            $validated['email'],
            boolval($validated['is_admin']),
            $validated['roles'] ?? [],
            $validated['permissions'] ?? [],
        );
        (new UpdateUserAction())->run($user, $data);
        $user->load(['roles.permissions', 'permissions']);
        return UserResource::make($user)->additional(['message' => __('crud.messages.update.success')]);
    }

    /**
     * @param Request $request
     * @param User $user
     * @return Response
     */
    public function delete(Request $request, User $user)
    {
        if ($user->delete()) {
            return response(['message' => __('crud.messages.delete.success'),]);
        }
        return response(['message' => __('crud.messages.delete.fail')], 409);
    }

    public function destroy(Request $request, User $user)
    {
        if ($user->forceDelete()) {
            return response(['message' => __('crud.messages.delete.success'),]);
        }
        return response(['message' => __('crud.messages.delete.fail')], 409);
    }

}
