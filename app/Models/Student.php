<?php

namespace App\Models;

use App\Traits\HasUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;
    use HasUser;

    protected $fillable = [
        'latin_name',
        'cyrillic_name',
        'is_family',
        'telephone',
        'eisu_id',
        'comment',
    ];

    /**
     * @return BelongsTo
     */
    public function gender(): BelongsTo
    {
        return $this->belongTo(Gender::class);
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
}
