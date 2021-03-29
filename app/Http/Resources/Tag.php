<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Tag extends JsonResource
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
            'id' => $this->id,
            'wiki' => 'https://onepiece.fandom.com/'. $this->url,
            'total_chapters' => $this->chapters()->count(),
            'aliases' => Alias::collection($this->aliases),
            'total_aliases' => $this->aliases->count(),
            'total_cover' => $this->chapters()->wherePivot('section', 'cover')->count(),
            'total_short' => $this->chapters()->wherePivot('section', 'short')->count(),
            'total_long' => $this->chapters()->wherePivot('section', 'long')->count(),
            'total_character' => $this->chapters()->wherePivot('section', 'characters')->count(),
        ];
    }
}
