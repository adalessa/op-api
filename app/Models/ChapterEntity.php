<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ChapterEntity extends Pivot
{
    public function chapters() {
        return $this->belongsTo(Chapter::class);
    }
}
