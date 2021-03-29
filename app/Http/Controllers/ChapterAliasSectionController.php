<?php

namespace App\Http\Controllers;

use App\Http\Resources\ChapterSmall;
use App\Models\Alias;
use Illuminate\Contracts\Support\Responsable;

class ChapterAliasSectionController extends Controller
{
    public function index(Alias $alias, $section): Responsable
    {
        $chapters = $alias->tag->chapters()->wherePivot('section', $section)->get();

        return ChapterSmall::collection($chapters);
    }
}
