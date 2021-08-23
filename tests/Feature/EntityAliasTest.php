<?php

use App\Models\Entity;

it('get the entity by an alias', function () {

    Entity::factory()
        ->hasAliases(1, ['name' => 'zoro', 'default' => true])
        ->create([
        'wiki_path' => '/wiki/zoro'
    ]);

    $response = $this->get(route('entity-alias.show', 'zoro'));

    $response->assertStatus(200);
});
