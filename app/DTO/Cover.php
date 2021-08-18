<?php

declare(strict_types=1);

namespace App\DTO;

class Cover
{
    private string $text;

    private string $image;

    /** @var Reference[] */
    private array $references;

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Reference[]
     */
    public function getReferences(): array
    {
        return $this->references;
    }

    /**
     * @param Reference[] $references
     */
    public function setReferences(array $references): self
    {
        $this->references = $references;

        return $this;
    }
}
