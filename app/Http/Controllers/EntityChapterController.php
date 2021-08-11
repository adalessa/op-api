<?php

namespace App\Http\Controllers;

use App\Http\Resources\EntityChapterResource;
use App\Models\Alias;

class EntityChapterController
{
    public function show(Alias $alias){
        return new EntityChapterResource($alias->entity);
    }
}
