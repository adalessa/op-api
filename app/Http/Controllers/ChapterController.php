<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateChapterRequest;
use App\Http\Resources\ChapterResource;
use App\Models\Chapter;

class ChapterController extends Controller
{
    public function show(Chapter $chapter)
    {
        return new ChapterResource($chapter);
    }

    public function store(CreateChapterRequest $request)
    {
        $request->validated();
        $chapterDto = $request->getDto();
        $chapter = Chapter::fromDto($chapterDto);

        return new ChapterResource($chapter);
    }
}
