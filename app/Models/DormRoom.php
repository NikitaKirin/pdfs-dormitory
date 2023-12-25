<?php

namespace App\Models;

use App\Traits\HasUser;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class DormRoom extends Model
{
    use SoftDeletes;
    use HasUser;
    use HasFactory;

    protected $fillable = [
        'number',
        'number_of_seats',
        'comment',
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
            $builder->where('is_family', false)->where('gender_id', $genderId);
        })->orDoesntHave('students');
    }

    /**
     * @param Builder $query
     * @return void
     */
    public function scopeOfFamily(Builder $query): void
    {
        $query->whereRelation('students', 'is_family',true)->orDoesntHave('students');
    }
}
