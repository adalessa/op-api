<?php

use App\Models\Chapter;
use App\Models\Entity;

use function Pest\Laravel\get;
use function Pest\Laravel\postJson;

it('returns the entity with the list of chapters', function() {
    $this->withoutExceptionHandling();

    Entity::factory()
        ->hasAttached(
            Chapter::factory()->count(5),
            ["type" => Chapter::TYPE_CHARACTERS],
        )->create([
            'name' => 'zoro',
            'wiki_path' => '/wiki/zoro'
        ]);

    get("/api/entities/chapters/zoro")
        ->assertStatus(200)
        ->assertJsonCount(5, "data.chapters")
        ->assertJsonPath("data.name", "zoro")
        ->assertJsonPath("data.wiki", "/wiki/zoro");
});

it('returns all the types if no type is provided', function() {
    $this->withoutExceptionHandling();

    Entity::factory()
        ->hasAttached(
            Chapter::factory()->count(5),
            ["type" => Chapter::TYPE_SUMMARY],
        )->create([
            'name' => 'zoro',
            'wiki_path' => '/wiki/zoro'
        ]);

    get("/api/entities/chapters/zoro")
        ->assertStatus(200)
        ->assertJsonCount(5, "data.chapters")
        ->assertJsonPath("data.name", "zoro")
        ->assertJsonPath("data.wiki", "/wiki/zoro");
});

it('returns the any relationship if none is provided', function() {
    $this->withoutExceptionHandling();

    Entity::factory()
        ->hasAttached(
            Chapter::factory()->count(5),
            ["type" => Chapter::TYPE_SUMMARY],
        )->create([
            'name' => 'zoro',
            'wiki_path' => '/wiki/zoro'
        ]);

    get("/api/entities/chapters/zoro")
        ->assertStatus(200)
        ->assertJsonCount(5, "data.chapters")
        ->assertJsonPath("data.name", "zoro")
        ->assertJsonPath("data.wiki", "/wiki/zoro");
});

it('returns the given relationship on the request', function() {
    $this->withoutExceptionHandling();

    Entity::factory()
        ->hasAttached(
            Chapter::factory()->count(5),
            ["type" => Chapter::TYPE_SUMMARY],
        )->create([
            'name' => 'zoro',
            'wiki_path' => '/wiki/zoro'
        ]);

    get("/api/entities/chapters/zoro?type=3")
        ->assertStatus(200)
        ->assertJsonCount(5, "data.chapters")
        ->assertJsonPath("data.name", "zoro")
        ->assertJsonPath("data.wiki", "/wiki/zoro");
});

it('returns the chapter where 2 or more entities appears', function () {
    $this->withoutExceptionHandling();

    $chapters = Chapter::factory()->count(3)->create();

    $zoro = Entity::factory()->create([
        'name' => 'zoro',
        'wiki_path' => '/wiki/zoro'
    ]);
    $chapters[0]->entities()->attach($zoro->id, ["type" => Chapter::TYPE_CHARACTERS]);
    $chapters[1]->entities()->attach($zoro->id, ["type" => Chapter::TYPE_CHARACTERS]);

    $sanji = Entity::factory()->create([
        'name' => 'sanji',
        'wiki_path' => '/wiki/sanji'
    ]);

    $chapters[1]->entities()->attach($sanji->id, ["type" => Chapter::TYPE_CHARACTERS]);
    $chapters[2]->entities()->attach($sanji->id, ["type" => Chapter::TYPE_CHARACTERS]);

    postJson(
        "/api/entities/together",
        ["entities" => ["zoro", "sanji"], "type" => Chapter::TYPE_CHARACTERS]
    )->assertJson([
        "data" => [
            "entities" => [
                [
                    "name" => "sanji",
                    "wiki" => "/wiki/sanji",
                ],
                [
                    "name" => "zoro",
                    "wiki" => "/wiki/zoro",
                ],
            ],
            "chapters" => [
                $chapters[1]->id,
            ]
        ]
    ]);
});
