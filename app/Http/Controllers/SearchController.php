<?php

namespace App\Http\Controllers;

use App\Http\Resources\ChapterResource;
use App\Models\Chapter;
use Illuminate\Http\Request;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Prefix;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

#[Prefix('/api/search')]
class SearchController
{
    #[Get('/', name: 'search.index')]
    public function index(Request $request)
    {
        $q = $request->get('q');
        throw_if(is_null($q), BadRequestException::class);

        $chapters = Chapter::search($q)->get();

        return ChapterResource::collection($chapters);
    }
}
