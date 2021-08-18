<?php

declare(strict_types=1);

namespace App\DTO;

use Carbon\Carbon;

class Chapter
{
    private int $number;

    private string $title;

    private Carbon $releaseDate;

    private Cover $cover;

    private Summary $summary;

    private Summary $shortSummary;

    /** @var Link[] */
    private array $links;

    /** @var Reference[] */
    private array $characters;

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getReleaseDate(): Carbon
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(Carbon $releaseDate): self
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    public function getCover(): Cover
    {
        return $this->cover;
    }

    public function setCover(Cover $cover): self
    {
        $this->cover = $cover;

        return $this;
    }

    public function getSummary(): Summary
    {
        return $this->summary;
    }

    public function setSummary(Summary $summary): self
    {
        $this->summary = $summary;

        return $this;
    }

    public function getShortSummary(): Summary
    {
        return $this->shortSummary;
    }

    public function setShortSummary(Summary $shortSummary): self
    {
        $this->shortSummary = $shortSummary;

        return $this;
    }

    /**
     * @return Link[]
     */
    public function getLinks(): array
    {
        return $this->links;
    }

    /**
     * @param Link[] $links
     */
    public function setLinks(array $links): self
    {
        $this->links = $links;

        return $this;
    }

    /**
     * @return Reference[]
     */
    public function getCharacters(): array
    {
        return $this->characters;
    }

    /**
     * @param Reference[] $characters
     */
    public function setCharacters(array $characters): self
    {
        $this->characters = $characters;

        return $this;
    }
}
