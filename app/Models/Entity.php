<?php

namespace App\Models;

use App\EntityTypesEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Entity extends Model
{
    use HasFactory;

    public $guarded = [];

    public function chapters(): BelongsToMany {
        return $this->belongsToMany(Chapter::class)
            ->orderBy('number');
    }

    public function aliases(): HasMany
    {
        return $this->hasMany(Alias::class);
    }

    public function wikiPath(): string
    {
        return sprintf("%s%s",  config('app.wikibase'), $this->wiki_path);
    }

    public function path(): string
    {
        return route('entity.show', $this->id);
    }

    public function chaptersByType(?string $type): BelongsToMany {
        // TODO refactor with when maybe, it failed when try to use it
        if (!$type) {
            return $this->chapters();
        }

        return $this->chapters()->wherePivot('type', EntityTypesEnum::map[$type]);
    }
}
