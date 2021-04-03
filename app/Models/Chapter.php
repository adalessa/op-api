<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Chapter extends Model
{
    use HasFactory;
    use HasReferences;

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

    public function characters()
    {
        return $this->references();
    }

    public function addCharacters(array $characters)
    {
        return $this->addReference($characters);
    }

    public function links(): HasMany
    {
        return $this->hasMany(Link::class);
    }

    public function addLink($site, $url): static
    {
        $this->links()->create([
            'site' => $site,
            'url' => $url,
        ]);

        return $this;
    }
}
