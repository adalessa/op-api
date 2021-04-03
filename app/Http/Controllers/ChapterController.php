<?php

namespace App\Http\Controllers;

use App\Http\Resources\Chapter as ResourcesChapter;
use App\Models\Chapter;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    public function show(Chapter $chapter)
    {
        return new ResourcesChapter($chapter);
    }

    public function store(Request $request)
    {
        $chapter = Chapter::create([
            'number' => $request->number,
            'title' => $request->title,
            'release_date' => $request->release_date,
        ]);

        if ($request->has('cover')) {
            $cover = $chapter->cover()->create([
                'text' => $request->cover['text'],
                'image' => $request->cover['image'],
            ]);
            $cover->addReference($request->cover['references']);
        }

        if ($request->has('summary')) {
            $summary = $chapter->summary()->create([
                'text' => $request->summary['text'],
            ]);
            $summary->addReference($request->summary['references']);
        }

        if ($request->has('short_summary')) {
            $summary = $chapter->shortSummary()->create([
                'text' => $request->short_summary['text'],
            ]);
            $summary->addReference($request->short_summary['references']);
        }

        $chapter->addCharacters($request->characters);

        foreach ($request->links as $site => $link) {
            $chapter->addLink($site, $link);
        }

        return new ResourcesChapter($chapter);
    }
}
