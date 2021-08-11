<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EntityResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'name' => $this->aliases()->default()->first()->name,
            'wiki' => $this->wikiPath(),
        ];
    }
}
