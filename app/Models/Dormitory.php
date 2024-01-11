<?php

namespace App\Models;

use App\Traits\HasUser;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dormitory extends Model
{
    use SoftDeletes;
    use HasUser;
    use HasFactory;

    protected $fillable = [
        'number',
        'address',
        'comment',
        'creator_id',
        'last_update_user_id',
    ];

    /**
     * @return HasMany
     */
    public function dormRooms(): HasMany
    {
        return $this->hasMany(DormRoom::class);
    }

    public function scopeOfNumber(Builder $query, int $number): void
    {
        $query->where('number', 'ilike', "%$number%");
    }

    public function scopeOfAddress(Builder $query, string $address): void
    {
        $query->where('address', 'ilike', "%$address%");
    }
}
