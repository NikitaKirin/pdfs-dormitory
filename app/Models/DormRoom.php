<?php

namespace App\Models;

use App\Traits\HasUser;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class DormRoom extends Model
{
    use SoftDeletes;
    use HasUser;
    use HasFactory;

    protected $fillable = [
        'number',
        'number_of_seats',
        'comment',
        'dormitory_id',
        'creator_id',
        'last_update_user_id',
    ];

    /**
     * @return HasMany
     */
    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    /**
     * @return BelongsTo
     */
    public function dormitory(): BelongsTo
    {
        return $this->belongsTo(Dormitory::class);
    }

    /**
     * @param Builder $query
     * @param int $genderId
     * @return void
     */
    public function scopeOfGender(Builder $query, int $genderId): void
    {
        $query->whereHas('students', function (Builder $builder) use ($genderId) {
            $builder->where('is_family', '=', false)->where('gender_id', $genderId);
        })->orDoesntHave('students');
    }

    /**
     * @param Builder $query
     * @return void
     */
    public function scopeOfFamily(Builder $query): void
    {
        $query->whereRelation('students', 'is_family', '=', true)
            ->orDoesntHave('students');
    }

    /**
     * @param Builder $query
     * @return void
     */
    public function scopeNotOccupied(Builder $query): void
    {
        $query->has('students', '<', DB::raw('"dorm_rooms"."number_of_seats"'));
    }

    public function scopeOfNumber(Builder $query, int $number): void
    {
        $query->where('number', 'ilike', "%$number%");
    }
}
