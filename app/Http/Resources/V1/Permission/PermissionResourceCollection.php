<?php

namespace App\Http\Resources\V1\Permission;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Resources\MissingValue;
use Illuminate\Support\Collection;

/** @see Permission */
class PermissionResourceCollection extends ResourceCollection
{
    public static $wrap = 'permissions';
    public function toArray(Request $request): array
    {
        return [
            'permissions' => self::getStructuredPermissionData($this->collection->groupBy('model')),
        ];
    }

    public static function getStructuredPermissionData(Collection|MissingValue $collection): array|MissingValue
    {
        if ($collection instanceof MissingValue) {
            return $collection;
        }
        return $collection
            ->mapWithKeys(function (Collection $permissions, string $modelName) {
                return [
                    __('model.' . $modelName) => $permissions->map(function (Permission|PermissionResource $permission) {
                        return new PermissionResource($permission);
                    }),
                ];
            })->toArray();
    }

}
