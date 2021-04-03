<?php

use App\Http\Controllers\AliasController;
use App\Http\Controllers\ChapterAliasSectionController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\ChapterTagController;
use App\Http\Controllers\TagAliasController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/chapters/{chapter}', [ChapterController::class, 'show']);
Route::post('/chapters', [ChapterController::class, 'store']);

Route::get('/chapters/tag/{tag}', [ChapterTagController::class, 'index']);

Route::get('/tags/alias/{alias:name}', [TagAliasController::class, 'show']);

Route::get('/aliases/{alias}', [AliasController::class, 'index']);

Route::get('/chapters/{alias:name}/{section}', [ChapterAliasSectionController::class, 'index']);
