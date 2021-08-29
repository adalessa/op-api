<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateChapterRequest;
use App\Http\Resources\ChapterResource;
use App\Models\Chapter;
use Spatie\RouteAttributes\Attributes\Prefix;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Post;

#[Prefix('/api/chapters')]
class ChapterController extends Controller
{
    #[Get('/{chapter:number}', name: 'chapters.show')]
    public function show(Chapter $chapter)
    {
        return new ChapterResource($chapter);
    }

    #[Post('/', name: 'chapters.create')]
    public function store(CreateChapterRequest $request)
    {
        $request->validated();
        $chapterDto = $request->getDto();
        $chapter = Chapter::fromDto($chapterDto);

        return new ChapterResource($chapter);
    }
}
