<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vacancy extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'department',
        'employment_type',
        'location',
        'description',
        'requirements',
        'responsibilities',
        'quota',
        'published_at',
        'closing_date',
        'status',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'quota' => 'integer',
            'published_at' => 'date',
            'closing_date' => 'date',
        ];
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }

    public function scopePublished($query)
    {
        return $query
            ->where('status', 'published')
            ->where(function ($query) {
                $query->whereNull('closing_date')
                    ->orWhereDate('closing_date', '>=', now()->toDateString());
            });
    }
}
