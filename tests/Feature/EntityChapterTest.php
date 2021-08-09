<?php

use App\Models\Chapter;
use App\Models\Entity;

use function Pest\Laravel\get;

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
