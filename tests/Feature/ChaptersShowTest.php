<?php

use App\Models\Chapter;

use function Pest\Laravel\get;

it('can get a chapter', function () {

    /** @var Chapter **/
    $chapter = Chapter::factory()->create();

    $response = get($chapter->path());

    $response->assertStatus(200)
        ->assertJsonStructure([
            'data' => [
                'number',
                'release_date',
                'title',
                'cover' => [
                    'image',
                    'text',
                ],
                'short_summary',
                'summary',
                'links',
            ]
        ]);
});
