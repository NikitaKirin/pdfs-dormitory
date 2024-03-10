<?php

namespace App\Listeners\Student;

use App\DTO\SettlementHistory\SettlementHistoryData;
use App\Events\Student\StudentEvicted;
use App\Events\Student\StudentSettled;
use App\Models\SettlementStatus;
use App\Services\SettlementHistoryService;
use Auth;
use Carbon\Carbon;
use Illuminate\Events\Dispatcher;

class StudentEventSubscriber
{

    public function __construct(
        public readonly SettlementHistoryService $settlementHistoryService,
    ) {}

    public function handleStudentSettled(StudentSettled $event): void
    {
        $data = new SettlementHistoryData(
            $event->student->id,
            $event->dormRoom->id,
            SettlementStatus::where('title', 'ilike', SettlementStatus::CHECK_IN)->first()->id,
            Auth::id(),
            Carbon::now(),
        );
        $this->settlementHistoryService->addNewRecord($data);
    }

    public function handleStudentEvicted(StudentEvicted $event): void
    {
        $data = new SettlementHistoryData(
            $event->student->id,
            $event->dormRoom->id,
            SettlementStatus::where('title', 'ilike', SettlementStatus::CHECK_OUT)->first()->id,
            Auth::user()->id,
            Carbon::now(),
        );
        $this->settlementHistoryService->addNewRecord($data);
    }

    public function subscribe(Dispatcher $events): array
    {

        return [
            StudentSettled::class => 'handleStudentSettled',
            StudentEvicted::class => 'handleStudentEvicted'
        ];
    }
}
