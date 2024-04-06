<?php

declare(strict_types=1);

namespace App\Http\Resources\V1\User;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UserNotificationResourceCollection extends ResourceCollection
{
    public static $wrap = 'notifications';

    public function toArray($request): array
    {
        return [
            'notifications' => $this->collection,
        ];
    }
}
