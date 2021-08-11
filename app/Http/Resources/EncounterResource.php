<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EncounterResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'times' => $this->getTimes(),
            'entities' => EntityResource::collection($this->getEntities()),
            'chapters' => ChapterResource::collection($this->getChapters()),
        ];
    }
}
