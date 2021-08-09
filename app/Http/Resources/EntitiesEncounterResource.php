<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EntitiesEncounterResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'chapter_id' => $this->chapter_id,
        ];
    }
}
