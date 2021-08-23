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
        )
        ->hasAliases(1, ['name' => 'zoro', 'default' => true])
        ->create([
            'wiki_path' => '/wiki/zoro'
        ]);

    get(route('entity-chapter.show', 'zoro'))
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
        )
        ->hasAliases(1, ['name' => 'zoro', 'default' => true])
        ->create([
            'wiki_path' => '/wiki/zoro'
        ]);

    get(route('entity-chapter.show', 'zoro'))
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
        )
        ->hasAliases(1, ['name' => 'zoro', 'default' => true])
        ->create([
            'wiki_path' => '/wiki/zoro'
        ]);

    get(route('entity-chapter.show', 'zoro'))
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
        )
        ->hasAliases(1, ['name' => 'zoro', 'default' => true])
        ->create([
            'wiki_path' => '/wiki/zoro'
        ]);

    get(route('entity-chapter.show', ['alias' => 'zoro', 'type' => 3]))
        ->assertStatus(200)
        ->assertJsonCount(5, "data.chapters")
        ->assertJsonPath("data.name", "zoro")
        ->assertJsonPath("data.wiki", "/wiki/zoro");
});

it('returns the entity with the list of chapters looking for an alias', function() {
    $this->withoutExceptionHandling();

    Entity::factory()
        ->hasAttached(
            Chapter::factory()->count(5),
            ["type" => Chapter::TYPE_CHARACTERS],
        )->hasAliases(1, [
            'name' => 'Roronoa',
            'default' => false,
        ])->hasAliases(1, [
            'name' => 'zoro',
            'default' => true,
        ])->create([
            'wiki_path' => '/wiki/zoro'
        ]);

    get(route('entity-chapter.show', 'zoro'))
        ->assertStatus(200)
        ->assertJsonCount(5, "data.chapters")
        ->assertJsonPath("data.name", "zoro")
        ->assertJsonPath("data.wiki", "/wiki/zoro");
});
