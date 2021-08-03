<?php

namespace App\Http\Controllers;

use App\Http\Resources\Chapter as ResourcesChapter;
use App\Models\Cover;
use App\Models\Chapter;
use App\Models\Entity;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    public function show(Chapter $chapter)
    {
        return new ResourcesChapter($chapter);
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
            collect($request->cover['references'])
                ->map(fn ($ref) => Entity::firstOrCreate(['name' => $ref['name'], 'wiki_path' => $ref['wiki']]))
                ->each(fn (Entity $entity) => $chapter->entities()->attach($entity->id, ["type" => Chapter::TYPE_COVER]));
        }

        if ($request->has('summary')) {
            $chapter->summary()->create([
                'text' => $request->summary['text'],
            ]);
            collect($request->summary['references'])
                ->map(fn ($ref) => Entity::firstOrCreate(['name' => $ref['name'], 'wiki_path' => $ref['wiki']]))
                ->each(fn (Entity $entity) => $chapter->entities()->attach($entity->id, ["type" => Chapter::TYPE_SUMMARY]));
        }

        if ($request->has('short_summary')) {
            $chapter->shortSummary()->create([
                'text' => $request->short_summary['text'],
            ]);
            collect($request->short_summary['references'])
                ->map(fn ($ref) => Entity::firstOrCreate(['name' => $ref['name'], 'wiki_path' => $ref['wiki']]))
                ->each(fn (Entity $entity) => $chapter->entities()->attach($entity->id, ["type" => Chapter::TYPE_SHORT_SUMMARY]));
        }

        collect($request->characters)
            ->map(fn ($ref) => Entity::firstOrCreate(['name' => $ref['name'], 'wiki_path' => $ref['wiki']]))
            ->each(fn (Entity $entity) => $chapter->entities()->attach($entity->id, ["type" => Chapter::TYPE_CHARACTERS]));

        foreach ($request->links as $site => $link) {
            $chapter->addLink($site, $link);
        }

        return new ResourcesChapter($chapter);
    }
}
