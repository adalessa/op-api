<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Entity extends Model
{
    use HasFactory;

    public $guarded = [];

    public function chapters(): BelongsToMany {
        return $this->belongsToMany(Chapter::class);
    }

    public function fisrtSeenIn(): ?Chapter {
        return $this->chapters()->orderBy("number")->first();
    }

    public function lastSeenIn(): ?Chapter {
        return $this->chapters()->orderBy("number", "desc")->first();
    }
}
