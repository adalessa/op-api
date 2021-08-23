<?php

namespace App\Http\Controllers;

use App\Http\Requests\EntitiesEncountersRequest;
use App\Http\Resources\EncounterResource;
use Facades\App\Services\EncounterService;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Prefix;

#[Prefix('api/entities/encounters')]
class EntitiesEncountersController
{
    #[Post('/search', name:'entities-encounters.search')]
    public function search(EntitiesEncountersRequest $request) {

        $validated = $request->validated();

        $encounter = EncounterService::of($validated['entities'])
            ->byType($validated['type'])
            ->get();

        return new EncounterResource($encounter);
    }
}
