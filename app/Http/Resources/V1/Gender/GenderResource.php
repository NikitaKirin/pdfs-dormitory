<?php

namespace App\Http\Resources\V1\Gender;

use App\Models\Gender;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Gender */
class GenderResource extends JsonResource
{
    public static $wrap = 'gender';

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => __('gender.' . $this->title),
        ];
    }
}
