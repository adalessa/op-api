<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChapterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'number' => $this->number,
            'release_date' => $this->release_date->toDateString(),
            'title' => $this->title,
            'cover' => [
                'image' => $this->cover?->image,
                'text' => $this->cover?->text,
            ],
            'short_summary' => $this->short_summary?->text,
            'summary' => $this->summary?->text,
        ];
    }
}
