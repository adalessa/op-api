<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChapterBriefResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'number' => (int) $this->number,
            'title' => $this->title,
            'release_date' => $this->release_date->toDateString(),
            'links' => LinkResource::collection($this->links),
        ];
    }
}
