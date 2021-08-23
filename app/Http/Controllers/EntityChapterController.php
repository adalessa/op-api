<?php

namespace App\Http\Controllers;

use App\Http\Resources\EntityChapterResource;
use App\Models\Alias;
use Spatie\RouteAttributes\Attributes\Prefix;
use Spatie\RouteAttributes\Attributes\Get;

#[Prefix('api/entities/chapters')]
class EntityChapterController
{
    #[Get('/{alias:name}', name:'entity-chapter.show')]
    public function show(Alias $alias){
        return new EntityChapterResource($alias->entity);
    }
}
