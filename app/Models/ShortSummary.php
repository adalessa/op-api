<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ShortSummary
 *
 * @property int $id
 * @property int $chapter_id
 * @property string $text
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ShortSummary newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ShortSummary newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ShortSummary query()
 * @method static \Illuminate\Database\Eloquent\Builder|ShortSummary whereChapterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShortSummary whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShortSummary whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShortSummary whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShortSummary whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ShortSummary extends Model
{
    use HasFactory;

    public $guarded = [];
}
