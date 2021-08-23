<?php

namespace App\Http\Controllers;

use App\Http\Resources\EntityResource;
use App\Models\Alias;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Prefix;

#[Prefix('api/entity/alias')]
class EntityAliasController
{
    #[Get('/{alias:name}', name: 'entity-alias.show')]
    public function show(Alias $alias)
    {
        return new EntityResource($alias->entity);
    }
}
