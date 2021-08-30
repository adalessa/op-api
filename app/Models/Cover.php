<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Cover
 *
 * @property int $id
 * @property int $chapter_id
 * @property string $text
 * @property string $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Cover newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cover newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cover query()
 * @method static \Illuminate\Database\Eloquent\Builder|Cover whereChapterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cover whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cover whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cover whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cover whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cover whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Cover extends Model
{
    use HasFactory;

    public $guarded = [];
}
