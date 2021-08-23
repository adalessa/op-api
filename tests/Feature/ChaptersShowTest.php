<?php

use App\Models\Chapter;

it('can get a chapter', function () {

    $chapter = Chapter::factory()->create();

    $response = $this->get($chapter->path());

    $response->assertStatus(200);
});
