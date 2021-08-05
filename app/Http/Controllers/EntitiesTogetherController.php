<?php

namespace App\Http\Controllers;

use App\Models\ChapterEntity;
use App\Models\Entity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EntitiesTogetherController
{
    public function index(Request $request) {
        // search entities
        $entities = Entity::whereIn('name', $request->entities)->orderBy('name')->get();

        abort_if($entities->count() != count($request->entities), 404, "One or more entities not found");

        $type = $request->type;

        $entityChapter = ChapterEntity::whereIn('entity_id', $entities->pluck('id'))
            ->when($type, function($query) use ($type) {
                return $query->where('type', $type);
            })->select('chapter_id', DB::raw("SUM(1) as cant"))
              ->groupBy('chapter_id')
              ->having('cant', '>=', $entities->count())->get();

        return response()->json([
            "data" => [
                "entities" => $entities->map(function (Entity $entity) {
                    return [
                        "name" => $entity->name,
                        "wiki" => $entity->wiki_path,
                    ];
                }),
                "chapters" => $entityChapter->pluck('chapter_id'),
            ]
        ]);
    }
}
