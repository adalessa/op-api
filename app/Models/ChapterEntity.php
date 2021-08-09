<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ChapterEntity extends Pivot
{
    public function chapters(): BelongsTo {
        return $this->belongsTo(Chapter::class);
    }

    public function entities(): BelongsTo {
        return $this->belongsTo(Entity::class, 'entity_id');
    }
}
