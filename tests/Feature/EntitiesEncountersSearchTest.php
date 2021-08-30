<?php

use App\EntityTypesEnum;
use App\Models\Chapter;
use App\Models\Entity;

use function Pest\Laravel\postJson;

it('returns the chapter where 2 or more entities appears', function () {
    $this->withoutExceptionHandling();

    $chapters = Chapter::factory()->count(3)->create();

    $zoro = Entity::factory()
        ->hasAliases(1, ['name' => 'zoro', 'default' => true])
        ->create([
        'wiki_path' => '/wiki/zoro'
    ]);
    $chapters[0]->entities()->attach($zoro->id, ["type" => EntityTypesEnum::map[EntityTypesEnum::TYPE_CHARACTERS]]);
    $chapters[1]->entities()->attach($zoro->id, ["type" => EntityTypesEnum::map[EntityTypesEnum::TYPE_CHARACTERS]]);

    $sanji = Entity::factory()
        ->hasAliases(1, ['name' => 'sanji', 'default' => true])
        ->create([
        'wiki_path' => '/wiki/sanji'
    ]);

    $chapters[1]->entities()->attach($sanji->id, ["type" => EntityTypesEnum::map[EntityTypesEnum::TYPE_CHARACTERS]]);
    $chapters[2]->entities()->attach($sanji->id, ["type" => EntityTypesEnum::map[EntityTypesEnum::TYPE_CHARACTERS]]);

    postJson(
        route('entities-encounters.search'),
        ["entities" => ["zoro", "sanji"], "type" => EntityTypesEnum::TYPE_CHARACTERS]
    )->assertJsonPath('data.chapters.0.number', $chapters[1]->number)
     ->assertJsonCount(2, 'data.entities')
     ->assertJsonPath('data.times', 1);
});

it('return a validation error if one of the entities does not exists', function() {
    $chapters = Chapter::factory()->count(3)->create();

    $zoro = Entity::factory()
        ->hasAliases(1, ['name' => 'zoro', 'default' => true])
        ->create([
        'wiki_path' => '/wiki/zoro'
    ]);
    $chapters[0]->entities()->attach($zoro->id, ["type" => EntityTypesEnum::map[EntityTypesEnum::TYPE_CHARACTERS]]);
    $chapters[1]->entities()->attach($zoro->id, ["type" => EntityTypesEnum::map[EntityTypesEnum::TYPE_CHARACTERS]]);

    $sanji = Entity::factory()
        ->hasAliases(1, ['name' => 'sanji', 'default' => true])
        ->create([
        'wiki_path' => '/wiki/sanji'
    ]);

    $chapters[1]->entities()->attach($sanji->id, ["type" => EntityTypesEnum::map[EntityTypesEnum::TYPE_CHARACTERS]]);
    $chapters[2]->entities()->attach($sanji->id, ["type" => EntityTypesEnum::map[EntityTypesEnum::TYPE_CHARACTERS]]);

    postJson(
        route('entities-encounters.search'),
        ["entities" => ["zoro", "sanji", "notfound"], "type" => EntityTypesEnum::TYPE_CHARACTERS]
    )->assertJsonValidationErrors('entities.2');
});

it('returns a validation error if the type is invalid', function() {
    $chapters = Chapter::factory()->count(3)->create();

    $zoro = Entity::factory()
        ->hasAliases(1, ['name' => 'zoro', 'default' => true])
        ->create([
        'wiki_path' => '/wiki/zoro'
    ]);
    $chapters[0]->entities()->attach($zoro->id, ["type" => EntityTypesEnum::map[EntityTypesEnum::TYPE_CHARACTERS]]);
    $chapters[1]->entities()->attach($zoro->id, ["type" => EntityTypesEnum::map[EntityTypesEnum::TYPE_CHARACTERS]]);

    $sanji = Entity::factory()
        ->hasAliases(1, ['name' => 'sanji', 'default' => true])
        ->create([
        'wiki_path' => '/wiki/sanji'
    ]);

    $chapters[1]->entities()->attach($sanji->id, ["type" => EntityTypesEnum::map[EntityTypesEnum::TYPE_CHARACTERS]]);
    $chapters[2]->entities()->attach($sanji->id, ["type" => EntityTypesEnum::map[EntityTypesEnum::TYPE_CHARACTERS]]);

    postJson(
        route('entities-encounters.search'),
        ["entities" => ["zoro", "sanji"], "type" => 'invalid']
    )->assertJsonValidationErrors('type');

});

it('returns a validation error if the type is not present', function() {
    $chapters = Chapter::factory()->count(3)->create();

    $zoro = Entity::factory()
        ->hasAliases(1, ['name' => 'zoro', 'default' => true])
        ->create([
        'wiki_path' => '/wiki/zoro'
    ]);
    $chapters[0]->entities()->attach($zoro->id, ["type" => EntityTypesEnum::map[EntityTypesEnum::TYPE_CHARACTERS]]);
    $chapters[1]->entities()->attach($zoro->id, ["type" => EntityTypesEnum::map[EntityTypesEnum::TYPE_CHARACTERS]]);

    $sanji = Entity::factory()
        ->hasAliases(1, ['name' => 'sanji', 'default' => true])
        ->create([
        'wiki_path' => '/wiki/sanji'
    ]);

    $chapters[1]->entities()->attach($sanji->id, ["type" => EntityTypesEnum::map[EntityTypesEnum::TYPE_CHARACTERS]]);
    $chapters[2]->entities()->attach($sanji->id, ["type" => EntityTypesEnum::map[EntityTypesEnum::TYPE_CHARACTERS]]);

    postJson(
        route('entities-encounters.search'),
        ["entities" => ["zoro", "sanji"]]
    )->assertJsonValidationErrors('type');
});

it('returns the chapter where 2 or more entities appears searching with alias', function () {
    $this->withoutExceptionHandling();

    $chapters = Chapter::factory()->count(3)->create();

    $zoro = Entity::factory()
        ->hasAliases(1, ['name' => 'zoro', 'default' => true])
        ->hasAliases(1, ['name' => 'Roronoa'])
        ->create([
        'wiki_path' => '/wiki/zoro'
    ]);

    $chapters[0]->entities()->attach($zoro->id, ["type" => EntityTypesEnum::map[EntityTypesEnum::TYPE_CHARACTERS]]);
    $chapters[1]->entities()->attach($zoro->id, ["type" => EntityTypesEnum::map[EntityTypesEnum::TYPE_CHARACTERS]]);

    $sanji = Entity::factory()
        ->hasAliases(1, ['name' => 'sanji', 'default' => true])
        ->create([
        'wiki_path' => '/wiki/sanji'
    ]);

    $chapters[1]->entities()->attach($sanji->id, ["type" => EntityTypesEnum::map[EntityTypesEnum::TYPE_CHARACTERS]]);
    $chapters[2]->entities()->attach($sanji->id, ["type" => EntityTypesEnum::map[EntityTypesEnum::TYPE_CHARACTERS]]);

    postJson(
        route('entities-encounters.search'),
        ["entities" => ["Roronoa", "sanji"], "type" => EntityTypesEnum::TYPE_CHARACTERS]
    )->assertJsonPath('data.chapters.0.number', $chapters[1]->number)
     ->assertJsonCount(2, 'data.entities')
     ->assertJsonPath('data.times', 1);
});
