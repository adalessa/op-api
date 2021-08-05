<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EntityChapterResource extends JsonResource
{
    public function toArray($request)
    {
        $type = $request->get("type");

        return [
            "name" => $this->name,
            "wiki" => $this->wiki_path,
            "chapters" => $this->chaptersByType($type)->get(['id'])->pluck('id'),
        ];
    }
}
