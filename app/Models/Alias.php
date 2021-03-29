<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Alias extends Model
{
    public function tag(): BelongsTo
    {
        return $this->belongsTo(Tag::class);
    }
}
