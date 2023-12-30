<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\Dormitory\CreateDormitoryAction;
use App\Actions\Dormitory\UpdateDormitoryAction;
use App\DTO\Dormitory\CreateDormitoryData;
use App\DTO\Dormitory\UpdateDormitoryData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Dormitory\IndexDormitoryRequest;
use App\Http\Requests\Api\V1\Dormitory\StoreDormitoryRequest;
use App\Http\Requests\Api\V1\Dormitory\UpdateDormitoryRequest;
use App\Http\Resources\V1\Dormitory\DormitoryResource;
use App\Http\Resources\V1\Dormitory\DormitoryResourceCollection;
use App\Models\Dormitory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class DormitoryController extends Controller
{
    /**
     * @param IndexDormitoryRequest $request
     * @return DormitoryResourceCollection
     */
    public function index(IndexDormitoryRequest $request)
    {
        $query = Dormitory::query();
        if ($request->validated('with_user_info')) {
            $query->with(['creator', 'lastUpdateUser']);
        }
        return new DormitoryResourceCollection($query->paginate($request->validated('per_page') ?? 15));
    }

    /**
     * @param StoreDormitoryRequest $request
     * @return DormitoryResource
     */
    public function store(StoreDormitoryRequest $request)
    {
        $data = new CreateDormitoryData(
            $request->validated('number'),
            $request->validated('address'),
            $request->validated('comment'),
            creatorId: Auth::id(),
        );
        $dormitory = (new CreateDormitoryAction())->run($data);
        return DormitoryResource::make($dormitory)->additional(['message' => __('crud.messages.create.success')]);
    }

    /**
     * @param UpdateDormitoryRequest $request
     * @param Dormitory $dormitory
     * @return DormitoryResource
     */
    public function update(UpdateDormitoryRequest $request, Dormitory $dormitory)
    {
        $data = new UpdateDormitoryData(
            $request->validated('number'),
            $request->validated('address'),
            $request->validated('comment'),
            lastUpdateUserId: Auth::user()->id,
        );
        (new UpdateDormitoryAction())->run($data, $dormitory);
        return DormitoryResource::make($dormitory)->additional(['message' => __('crud.messages.update.success')]);
    }

    /**
     * @param Dormitory $dormitory
     * @return Response
     */
    public function delete(Dormitory $dormitory)
    {
        if ($dormitory->delete()) {
            return response(['message' => __('crud.messages.delete.success'),]);
        }
        return response(['message' => __('crud.messages.delete.fail')], 409);
    }

    /**
     * @param Request $request
     * @param Dormitory $dormitory
     * @return Response
     */
    public function destroy(Request $request, Dormitory $dormitory)
    {
        if ($dormitory->forceDelete()) {
            return response(['message' => __('crud.messages.delete.success'),]);
        }
        return response(['message' => __('crud.messages.delete.fail')], 409);
    }
}
