<?php

namespace App\Http\Controllers;

use App\Http\Requests\EntitiesEncountersRequest;
use App\Http\Resources\EncounterResource;
use Facades\App\Services\EncounterService;

class EntitiesEncountersController
{
    public function index(EntitiesEncountersRequest $request) {

        $validated = $request->validated();

        $encounter = EncounterService::of($validated['entities'])
            ->byType($validated['type'])
            ->get();

        return new EncounterResource($encounter);
    }
}
