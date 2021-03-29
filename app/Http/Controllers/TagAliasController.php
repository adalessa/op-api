<?php

namespace App\Http\Controllers;

use App\Http\Resources\Tag;
use App\Models\Alias;
use Illuminate\Contracts\Support\Responsable;

class TagAliasController extends Controller
{
    public function show(Alias $alias): Responsable
    {
        return new Tag($alias->tag);
    }
}
