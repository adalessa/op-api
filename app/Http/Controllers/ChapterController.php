<?php

namespace App\Http\Controllers;

use App\Http\Resources\ChapterResource;
use App\Models\Chapter;
use App\Models\Entity;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    public function show(Chapter $chapter)
    {
        return new ChapterResource($chapter);
    }

    public function store(Request $request)
    {
        /** @var Chapter $chapter */
        $chapter = Chapter::firstOrCreate([
            'number' => $request->number,
        ],[
            'title' => $request->title,
            'release_date' => $request->release_date,
        ]);

        $chapter->entities()->sync([]);

        if ($request->has('cover')) {
            $chapter->cover()->create([
                'text' => $request->cover['text'],
                'image' => $request->cover['image'],
            ]);
            $this->addEntities($chapter, $request->cover['references'], Chapter::TYPE_COVER);
        }

        if ($request->has('summary')) {
            $chapter->summary()->create([
                'text' => $request->summary['text'],
            ]);
            $this->addEntities($chapter, $request->summary['references'], Chapter::TYPE_SUMMARY);
        }

        if ($request->has('short_summary')) {
            $chapter->shortSummary()->create([
                'text' => $request->short_summary['text'],
            ]);
            $this->addEntities($chapter, $request->short_summary['references'], Chapter::TYPE_SHORT_SUMMARY);
        }

        $this->addEntities($chapter, $request->characters, Chapter::TYPE_CHARACTERS);

        foreach ($request->links as $site => $link) {
            $chapter->addLink($site, $link);
        }

        return new ChapterResource($chapter);
    }

    private function addEntities($chapter, $references, $type): void
    {
        collect($references)
            ->map(function ($ref) {
                /** @var Entity $entity **/
                $entity = Entity::firstOrCreate(['wiki_path' => $ref['wiki']]);

                $entity->aliases()->firstOrCreate(['name' => $ref['name'], 'default' => $entity->wasRecentlyCreated]);

                return $entity;
            })
            ->each(fn (Entity $entity) => $chapter->entities()->attach($entity->id, ["type" => $type]));
    }
}
