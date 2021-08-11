<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EntityChapterResource extends JsonResource
{
    public function toArray($request)
    {
        $type = $request->get("type");

        return [
            "name" => $this->aliases()->default()->first()->name,
            "wiki" => $this->wikiPath(),
            "chapters" => $this->chaptersByType($type)->get(['id'])->pluck('id'),
        ];
    }
}
