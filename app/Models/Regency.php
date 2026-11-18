<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Regency extends Model
{
    protected $table = 'regencies';

    public $incrementing = false;

    protected $keyType = 'int';

    protected $fillable = ['id', 'province_id', 'name'];

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class, 'province_id');
    }
}