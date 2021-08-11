<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;

class Encounter
{
    public function __construct(
        private Collection $entities,
        private Collection $chapters,
        private int $type,
    ) {
    }

    public function getEntities(): Collection
    {
        return $this->entities;
    }

    public function getChapters(): Collection
    {
        return $this->chapters;
    }

    public function getTimes(): int
    {
        return $this->chapters->count();
    }
}
