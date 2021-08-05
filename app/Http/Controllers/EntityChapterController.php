<?php

namespace App\Http\Controllers;

use App\Http\Resources\EntityChapterResource;
use App\Models\Entity;

class EntityChapterController
{
    public function show(Entity $entity){
        return new EntityChapterResource($entity);
    }
}
