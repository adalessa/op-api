<?php

namespace App\Http\Controllers;

use App\Http\Resources\ChapterSmall;
use App\Models\Tag;
use Illuminate\Contracts\Support\Responsable;

class ChapterTagController extends Controller
{
    public function index(Tag $tag): Responsable
    {
        return ChapterSmall::collection($tag->chapters);
    }
}
