<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Chapter extends Model
{
    protected $dates = ['release_date'];

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'chapter_tags')
            ->using(ChapterTags::class);
    }
}
