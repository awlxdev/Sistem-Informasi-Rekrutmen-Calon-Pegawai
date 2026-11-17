<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Applicant extends Model
{
    protected $fillable = [
        'user_id',
        'nik',
        'full_name',
        'place_of_birth',
        'date_of_birth',
        'gender',
        'phone',
        'address',
        'education_level',
        'institution',
        'major',
        'graduation_year',
        'cv_path',
        'photo_path',
    ];

    protected function casts(): array
    {
        return [
            'date_of_birth' => 'date',
            'graduation_year' => 'integer',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }
}
