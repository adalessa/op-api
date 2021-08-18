<?php

declare(strict_types=1);

namespace App\DTO;

class Reference
{
    private string $name;

    private string $wiki;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getWiki(): string
    {
        return $this->wiki;
    }

    public function setWiki(string $wiki): self
    {
        $this->wiki = $wiki;

        return $this;
    }
}
