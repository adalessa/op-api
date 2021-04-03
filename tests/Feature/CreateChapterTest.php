<?php

use App\Models\Chapter;
use App\Models\Entity;
use App\Models\Reference;

use function Pest\Laravel\postJson;
use function PHPUnit\Framework\assertCount;
use function PHPUnit\Framework\assertNotNull;

it('creates a new chapter', function () {
    $this->withoutExceptionHandling();

    $response = postJson('/api/chapters', [
        'number' => 1,
        'title' => 'Romance Dawn - The Dawn of the Adventure' ,
        'release_date' => '1997-07-19',
        'links' => [
            'wiki' => 'https://onepiece.fandom.com/wiki/Chapter_1',
            'manganelo' => 'https://manganelo.com/chapter/tkqu521609849722/chapter_1',
        ],
        'cover' => [
            'text' => 'details of the cover scene',
            'image' => 'https://static.wikia.nocookie.net/onepiece/images/6/66/Chapter_1.png/revision/latest',
            'references' => [
                [
                    'alias' => 'luffy',
                    'name' => 'Monkey D. Luffy',
                    'wiki' => '/wiki/Monkey_D._Luffy',
                ]
            ]
        ],
        'short_summary' => [
            'text' => 'details of the chapter',
            'references' => [
                [
                    'alias' => 'luffy',
                    'name' => 'Monkey D. Luffy',
                    'wiki' => '/wiki/Monkey_D._Luffy',
                ]
            ]
        ],
        'summary' => [
            'text' => 'a more detailed text of the chapter',
            'references' => [
                [
                    'alias' => 'luffy',
                    'name' => 'Monkey D. Luffy',
                    'wiki' => '/wiki/Monkey_D._Luffy',
                ],
                [
                    'alias' => 'nami',
                    'name' => 'Nami',
                    'wiki' => '/wiki/nami',
                ]
            ]
        ],
        'characters' => [
            [
                'alias' => 'luffy',
                'name' => 'Monkey D. Luffy',
                'wiki' => '/wiki/Monkey_D._Luffy',
            ]
        ],
    ]);

    $response->assertStatus(201);

    $chapter = Chapter::where('number', 1)->first();
    assertNotNull($chapter);
    assertCount(2, $chapter->links()->get());

    // related to a Reference which relates to an entity
    assertCount(1, $chapter->characters);
    assertCount(1, $chapter->shortSummary->references);
    assertCount(2, $chapter->summary->references);
    assertCount(1, $chapter->cover->references);

    assertCount(2, Entity::all());
    assertCount(2, Reference::all());
});
