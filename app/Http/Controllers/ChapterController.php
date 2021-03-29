<?php

namespace App\Http\Controllers;

use App\Http\Resources\Chapter as ResourcesChapter;
use App\Models\Chapter;
use Illuminate\Contracts\Support\Responsable;

class ChapterController extends Controller
{
    public function show(Chapter $chapter): Responsable
    {
        return new ResourcesChapter($chapter);
    }
}
