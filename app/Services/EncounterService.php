<?php

namespace App\Services;

use App\EntityTypesEnum;
use App\Models\Chapter;
use App\Models\Entity;

class EncounterService
{
    private array $aliases;
    private int $typeId;
    private string $type;

    public function of(array $aliases): self
    {
        $this->aliases = $aliases;

        return $this;
    }

    public function byType(string $type): self
    {
        $this->type = $type;
        $this->typeId = EntityTypesEnum::map[$type];

        return $this;
    }

    public function get(): Encounter
    {
        $entities = Entity::whereHas('aliases', function($query) {
            return $query->whereIn('name', $this->aliases);
        })->get();

        $chapters = Chapter::encounters($entities->pluck('id')->all(), $this->typeId)->get();

        return (new Encounter($entities, $chapters, $this->type));
    }
}
