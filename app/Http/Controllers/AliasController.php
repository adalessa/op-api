<?php

namespace App\Http\Controllers;

use App\Http\Resources\Alias as ResourcesAlias;
use App\Models\Alias;
use Illuminate\Contracts\Support\Responsable;

class AliasController extends Controller
{
    public function index($alias): Responsable
    {
        $aliases = Alias::where('name', 'like', '%'.$alias.'%')->get();

        return ResourcesAlias::collection($aliases);
    }
}
