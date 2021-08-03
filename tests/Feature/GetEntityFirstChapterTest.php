<?php

use App\Models\Chapter;
use App\Models\Entity;

use function Pest\Laravel\get;

it('returns the first chapter for an entity', function() {
    $this->withoutExceptionHandling();

    $entity = Entity::factory()->create([
        'name' => 'zoro',
        'wiki_path' => '/wiki/zoro'
    ]);

    $chapter10 = Chapter::factory()->create([
        "number" => 10,
    ]);

    $chapter5 = Chapter::factory()->create([
        "number" => 5,
    ]);

    $chapter10->entities()->attach($entity->id, ["type" => Chapter::TYPE_CHARACTERS]);
    $chapter5->entities()->attach($entity->id, ["type" => Chapter::TYPE_CHARACTERS]);

    $response = get("/api/search/zoro");

    $response->assertStatus(200)
             ->assertJson([
                 "name" => "zoro",
                 "wiki" => "/wiki/zoro",
                 "firstSeenIn" => $chapter5->id,
                 "lastSeenIn" => $chapter10->id,
             ]);
});
