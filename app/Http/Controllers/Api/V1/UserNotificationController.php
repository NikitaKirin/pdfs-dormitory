<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\User\UserNotificationResourceCollection;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class UserNotificationController extends Controller
{
    public function index(Request $request)
    {
        return new UserNotificationResourceCollection(
            $request->user()
                ->notifications()
                ->paginate($request->integer('per_page', 15))
        );
    }

    public function makeRead(DatabaseNotification $notification)
    {
        $notification->markAsRead();
        return response(null, 204);
    }

    public function destroy(DatabaseNotification $notification)
    {
        if ($notification->delete()) {
            return response(['message' => __('crud.messages.delete.success'),]);
        }
        return response(['message' => __('crud.messages.delete.fail')], 409);
    }
}
