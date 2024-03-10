<?php

namespace App\Http\Controllers\Api\V1;

use App\DTO\SettlementHistory\SettlementHistoryData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\SettlementHistory\IndexSettlementHistoryRequest;
use App\Http\Requests\Api\V1\SettlementHistory\StoreSettlementHistoryRequest;
use App\Http\Resources\V1\SettlementHistory\SettlementHistoryResource;
use App\Http\Resources\V1\SettlementHistory\SettlementHistoryResourceCollection;
use App\Http\Resources\V1\SettlementStatus\SettlementStatusResourceCollection;
use App\Models\SettlementHistory;
use App\Models\SettlementStatus;
use App\Services\SettlementHistoryService;
use Illuminate\Http\Request;

class SettlementHistoryController extends Controller
{
    public function __construct(
        public readonly SettlementHistoryService $settlementHistoryService
    ) {}

    public function index(IndexSettlementHistoryRequest $request)
    {
        $query = SettlementHistory::query()->with([
            'student:id,latin_name,cyrillic_name',
            'dormRoom:id,number',
            'settlementStatus:id,title',
            'user:id,name',
        ]);
        if ($studentId = $request->integer('student_id', false)) {
            $query->ofStudent($studentId);
        }
        if ($dormRoomId = $request->integer('dorm_room_id', false)) {
            $query->ofDormRoom($dormRoomId);
        }
        if ($settlementStatusId = $request->integer('settlement_status_id', false)) {
            $query->ofSettlementStatus($settlementStatusId);
        }
        $query->orderBy('created_at');
        return new SettlementHistoryResourceCollection($query->paginate($request->integer('per_page', 15)));
    }

    public function indexSettlementStatuses(Request $request)
    {
        return new SettlementStatusResourceCollection(SettlementStatus::all());
    }

    public function store(StoreSettlementHistoryRequest $request)
    {
        $validated = $request->validated();
        $data = new SettlementHistoryData(
            $validated['student_id'],
            $validated['dorm_room_id'],
            $validated['settlement_status_id'],
            $validated['user_id'],
            $validated['created_at'],
        );
        $record = $this->settlementHistoryService->addNewRecord($data);
        return SettlementHistoryResource::make($record->load([
            'student:id,latin_name,cyrillic_name',
            'dormRoom:id,number',
            'settlementStatus:id,title',
            'user:id,name',
        ]))->additional(['message' => __('crud.messages.create.success')]);
    }

    public function update(StoreSettlementHistoryRequest $request, SettlementHistory $settlementHistory)
    {
        $validated = $request->validated();
        $data = new SettlementHistoryData(
            $validated['student_id'],
            $validated['dorm_room_id'],
            $validated['settlement_status_id'],
            $validated['user_id'],
            $validated['created_at'],
        );
        if ($this->settlementHistoryService->updateRecord($data, $settlementHistory)) {
            return SettlementHistoryResource::make($settlementHistory->load([
                'student:id,latin_name,cyrillic_name',
                'dormRoom:id,number',
                'settlementStatus:id,title',
                'user:id,name',
            ]))->additional(['message' => __('crud.messages.update.success')]);
        }
        return response()->json(['message' => __('crud.messages.update.fail')], 501);
    }

    public function delete(SettlementHistory $settlementHistory)
    {
        if ($settlementHistory->delete()) {
            return response(['message' => __('crud.messages.delete.success'),]);
        }
        return response(['message' => __('crud.messages.delete.fail')], 409);
    }

    public function destroy(SettlementHistory $settlementHistory)
    {
        if ($settlementHistory->forceDelete()) {
            return response(['message' => __('crud.messages.delete.success'),]);
        }
        return response(['message' => __('crud.messages.delete.fail')], 409);
    }
}
