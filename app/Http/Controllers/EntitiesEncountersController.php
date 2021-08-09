<?php

namespace App\Http\Controllers;

use App\Http\Requests\EntitiesEncountersRequest;
use App\Http\Resources\EntitiesEncountersCollection;
use App\Models\Chapter;

class EntitiesEncountersController
{
    public function index(EntitiesEncountersRequest $request) {

        $validated = $request->validated();

        $encounters = Chapter::encounters($validated['entities'], $validated['type'])->get();

        return new EntitiesEncountersCollection($encounters);
    }
}
