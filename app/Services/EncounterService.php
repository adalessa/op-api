<?php

namespace App\Services;

use App\Models\Alias;
use App\Models\Chapter;
use App\Models\Entity;

class EncounterService
{
    private array $aliases;
    private int $type;

    public function of(array $aliases): self
    {
        $this->aliases = $aliases;

        return $this;
    }

    public function byType(int $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function get(): Encounter
    {
        $entities = Entity::whereHas('aliases', function($query) {
            return $query->whereIn('name', $this->aliases);
        })->get();

        $chapters = Chapter::encounters($entities->pluck('id')->all(), $this->type)->get();

        return (new Encounter($entities, $chapters, $this->type));
    }
}
