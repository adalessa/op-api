<?php

namespace App\Http\Controllers;

use App\Http\Resources\EntityResource;
use App\Models\Entity;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Prefix;

#[Prefix('api/entity')]
class EntityController
{
    #[Get('/{entity}', name: 'entity.show')]
    public function show(Entity $entity)
    {
        return new EntityResource($entity);
    }
}
