<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\DormRoom\CreateDormRoomAction;
use App\Actions\DormRoom\UpdateDormRoomAction;
use App\DTO\DormRoom\CreateDormRoomData;
use App\DTO\DormRoom\UpdateDormRoomData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\DormRoom\IndexDormRoomRequest;
use App\Http\Requests\Api\V1\DormRoom\StoreDormRoomRequest;
use App\Http\Requests\Api\V1\DormRoom\UpdateDormRoomRequest;
use App\Http\Resources\V1\DormRoom\DormRoomResource;
use App\Http\Resources\V1\DormRoom\DormRoomResourceCollection;
use App\Models\Dormitory;
use App\Models\DormRoom;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class DormRoomController extends Controller
{

    /**
     * @param IndexDormRoomRequest $request
     * @param Dormitory $dormitory
     * @return DormRoomResourceCollection
     */
    public function index(IndexDormRoomRequest $request, Dormitory $dormitory)
    {
        $query = DormRoom::where('dormitory_id', $dormitory->id)
            ->ofFamily($request->boolean('is_family'))
            ->withCount('students');
        if ($genderId = $request->validated('gender_id')) {
            $query->ofGender($genderId);
        }
        if ($request->validated('only_available_dorm_rooms')) {
            $query->notOccupied();
        }
        if ($request->validated('with_user_info')) {
            $query->with(['creator', 'lastUpdateUser']);
        }
        if ($request->validated('with_students')) {
            $query->with([
                'students' => ['academicGroup', 'country', 'gender']
            ]);
        }
        if ($number = $request->get('number')) {
            $query->ofNumber($number);
        }
        if ($sortBy = $request->get('sort_by')) {
            $query->orderBy($sortBy['column'], $sortBy['direction']);
        }
        return new DormRoomResourceCollection($query->paginate($request->validated('per_page', 15)));
    }

    /**
     * @param StoreDormRoomRequest $request
     * @param Dormitory $dormitory
     * @return DormRoomResource
     */
    public function store(StoreDormRoomRequest $request, Dormitory $dormitory)
    {
        $data = new CreateDormRoomData(
            $request->validated('number'),
            $request->validated('number_of_seats'),
            $dormitory->id,
            Auth::id(),
            $request->validated('comment'),
        );
        $dormitory = (new CreateDormRoomAction())->run($data);
        return DormRoomResource::make($dormitory)->additional(['message' => __('crud.messages.create.success')]);
    }

    /**
     * @param UpdateDormRoomRequest $request
     * @param DormRoom $dormRoom
     * @return DormRoomResource|JsonResponse
     */
    public function update(UpdateDormRoomRequest $request, DormRoom $dormRoom)
    {
        $data = new UpdateDormRoomData(
            $request->validated('number'),
            $request->validated('number_of_seats'),
            $request->validated('dormitory_id'),
            Auth::id(),
            $request->validated('comment'),
        );
        if ((new UpdateDormRoomAction())->run($data, $dormRoom)) {
            return DormRoomResource::make($dormRoom)->additional(['message' => __('crud.messages.update.success')]);
        }
        return response()->json(['message' => __('crud.messages.update.fail')], 501);
    }

    /**
     * @param DormRoom $dormRoom
     * @return Response
     */
    public function delete(DormRoom $dormRoom)
    {
        if ($dormRoom->delete()) {
            return response(['message' => __('crud.messages.delete.success'),]);
        }
        return response(['message' => __('crud.messages.delete.fail')], 409);
    }

    /**
     * @param Request $request
     * @param DormRoom $dormRoom
     * @return Response
     */
    public function destroy(Request $request, DormRoom $dormRoom)
    {
        if ($dormRoom->forceDelete()) {
            return response(['message' => __('crud.messages.delete.success'),]);
        }
        return response(['message' => __('crud.messages.delete.fail')], 409);
    }
}
