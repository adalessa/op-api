<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Alias extends Model
{
    use HasFactory;

    public $guarded = [];

    public function entity(): BelongsTo
    {
        return $this->belongsTo(Entity::class);
    }

    public function scopeDefault($query)
    {
        return $query->whereDefault(true);
    }
}
