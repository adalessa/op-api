<?php

use App\Models\Entity;

use function Pest\Laravel\get;

it('has entityshow page', function () {
    $entity = Entity::factory()
        ->hasAliases(1, ['name' => 'zoro', 'default' => true])
        ->create([
        'wiki_path' => '/wiki/zoro'
    ]);

    $response = get($entity->path());

    $response->assertStatus(200)
        ->assertJsonCount(1, 'data.aliases');
});
