<?php

namespace App\Services;

use App\Models\Chapter;
use App\Models\Entity;

class EncounterService
{
    private array $entitiesNames;
    private int $type;

    public function of(array $entitiesNames): self
    {
        $this->entitiesNames = $entitiesNames;

        return $this;
    }

    public function byType(int $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function get(): Encounter
    {
        $entities = Entity::whereIn('name', $this->entitiesNames)->get();

        $chapters = Chapter::encounters($entities->pluck('id')->all(), $this->type)->get();

        return (new Encounter($entities, $chapters, $this->type));
    }
}
