<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Entity extends Model
{
    use HasFactory;

    public $guarded = [];

    public function chapters(): BelongsToMany {
        return $this->belongsToMany(Chapter::class)
            ->orderBy('number');
    }

    public function chaptersByType(?int $type): BelongsToMany {
        // TODO refactor with when maybe, it failed when try to use it
        if (!$type) {
            return $this->chapters();
        }

        return $this->chapters()->wherePivot('type', $type);
    }
}
