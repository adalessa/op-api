<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Chapter extends Model
{

    public const TYPE_COVER = 1;
    public const TYPE_SHORT_SUMMARY = 2;
    public const TYPE_SUMMARY = 3;
    public const TYPE_CHARACTERS = 4;

    use HasFactory;

    public $guarded = [];

    protected $dates = ['release_date'];

    public function shortSummary(): HasOne
    {
        return $this->hasOne(ShortSummary::class);
    }

    public function summary(): HasOne
    {
        return $this->hasOne(Summary::class);
    }

    public function cover(): HasOne
    {
        return $this->hasOne(Cover::class);
    }

    public function entities(): BelongsToMany {
        return $this->belongsToMany(Entity::class);
    }

    public function characters(): BelongsToMany {
        return $this->entities()->wherePivot('type' , self::TYPE_CHARACTERS);
    }
    public function shortSummaryReferences(): BelongsToMany {
        return $this->entities()->wherePivot('type' , self::TYPE_SHORT_SUMMARY);
    }
    public function summaryReferences(): BelongsToMany {
        return $this->entities()->wherePivot('type' , self::TYPE_SUMMARY);
    }
    public function coverReferences(): BelongsToMany {
        return $this->entities()->wherePivot('type' , self::TYPE_COVER);
    }

    public function links(): HasMany
    {
        return $this->hasMany(Link::class);
    }

    public function addLink(string $site, string $url): static
    {
        $this->links()->create([
            'site' => $site,
            'url' => $url,
        ]);

        return $this;
    }
}
