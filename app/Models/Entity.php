<?php

namespace App\Models;

use App\EntityTypesEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Entity
 *
 * @property int $id
 * @property string $wiki_path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Alias[] $aliases
 * @property-read int|null $aliases_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Chapter[] $chapters
 * @property-read int|null $chapters_count
 * @method static \Database\Factories\EntityFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Entity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Entity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Entity query()
 * @method static \Illuminate\Database\Eloquent\Builder|Entity whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entity whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entity whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entity whereWikiPath($value)
 * @mixin \Eloquent
 */
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
