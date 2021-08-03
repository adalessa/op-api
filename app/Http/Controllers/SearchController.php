<?php

namespace App\Http\Controllers;

use App\Models\Entity;
use Illuminate\Http\Request;

class SearchController
{
    public function search(Entity $entity){
        return [
            "name" => $entity->name,
            "wiki" => $entity->wiki_path,
            "firstSeenIn" => $entity->fisrtSeenIn()?->id,
            "lastSeenIn" => $entity->lastSeenIn()?->id,
        ];
    }
}
