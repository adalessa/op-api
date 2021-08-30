<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\ChapterEntity
 *
 * @property int $chapter_id
 * @property int $entity_id
 * @property int $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Chapter $chapters
 * @property-read \App\Models\Entity $entities
 * @method static \Illuminate\Database\Eloquent\Builder|ChapterEntity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChapterEntity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChapterEntity query()
 * @method static \Illuminate\Database\Eloquent\Builder|ChapterEntity whereChapterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChapterEntity whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChapterEntity whereEntityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChapterEntity whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChapterEntity whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ChapterEntity extends Pivot
{
    public function chapters(): BelongsTo {
        return $this->belongsTo(Chapter::class);
    }

    public function entities(): BelongsTo {
        return $this->belongsTo(Entity::class, 'entity_id');
    }
}
