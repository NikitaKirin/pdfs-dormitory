<?php

declare(strict_types=1);

namespace App\Http\Resources\V1\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Notifications\DatabaseNotification;

/** @mixin DatabaseNotification */
class UserNotificationResource extends JsonResource
{
    public static $wrap = 'notification';

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => __('notifications.types.'. $this->type),
            'data' => $this->data,
            'read_at' => $this->read_at,
            'created_at' => $this->created_at,
        ];
    }
}
