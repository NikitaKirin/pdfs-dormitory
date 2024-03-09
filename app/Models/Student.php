<?php

namespace App\Models;

use App\Traits\HasUser;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;
    use HasUser;
    use HasFactory;

    protected $fillable = [
        'latin_name',
        'cyrillic_name',
        'is_family',
        'telephone',
        'eisu_id',
        'comment',
        'creator_id',
        'last_update_user_id',
        'country_id',
        'academic_group_id',
        'gender_id',
        'dorm_room_id',
    ];

    /**
     * @return BelongsTo
     */
    public function gender(): BelongsTo
    {
        return $this->belongsTo(Gender::class);
    }

    /**
     * @return BelongsTo
     */
    public function academicGroup(): BelongsTo
    {
        return $this->belongsTo(AcademicGroup::class);
    }

    /**
     * @return BelongsTo
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * @return BelongsTo
     */
    public function dormRoom(): BelongsTo
    {
        return $this->belongsTo(DormRoom::class);
    }

    public function scopeOfLatinName(Builder $query, string $latinName): void
    {
        $query->where('latin_name', 'ilike', "%$latinName%");
    }

    public function scopeOfCyrillicName(Builder $query, string $cyrillicName): void
    {
        $query->where('cyrillic_name', 'ilike', "%$cyrillicName%");
    }

    public function scopeOfCountries(Builder $query, array $countries): void
    {
        $query->whereHas('country', function (Builder $query) use ($countries) {
            $query->whereIntegerInRaw('id', $countries);
        });
    }

    public function scopeOfGender(Builder $query, int $genderId): void
    {
        $query->whereHas('gender', function (Builder $query) use ($genderId) {
            $query->where('id', $genderId);
        });
    }
}
