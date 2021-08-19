<?php

use App\Models\Chapter;
use App\Models\Entity;

use function Pest\Laravel\postJson;
use function PHPUnit\Framework\assertCount;
use function PHPUnit\Framework\assertNotNull;

it('creates a new chapter', function () {
    $response = postJson('/api/chapters', getChapterData());

    $response->assertStatus(201);

    $chapter = Chapter::where('number', 1)->first();
    assertNotNull($chapter);
    assertCount(2, $chapter->links()->get());

    // related to a Reference which relates to an entity
    assertCount(1, $chapter->characters);
    assertCount(1, $chapter->shortSummaryReferences);
    assertCount(2, $chapter->summaryReferences);
    assertCount(1, $chapter->coverReferences);

    assertCount(2, Entity::all());
});

it("validates the chapter data", function ($field, $data, $error) {
    postJson('/api/chapters', getChapterData([$field => $data]))
        ->assertJsonValidationErrors($error);
})->with([
    ['number',       null, 'number'],
    ['title',        null, 'title'],
    ['release_date', null, 'release_date'],
    ['release_date', 'not a date', 'release_date'],
    ['links',        [["name" => "test", "value" => "not a url"]], 'links.0.value'],

    ['cover', null, 'cover'],
    ['cover', ['text' => null], 'cover.text'],
    ['cover', ['image' => null], 'cover.image'],
    ['cover', ['image' => "not a url"], 'cover.image'],
    ['cover', ['references' => []], 'cover.references'],
    ['cover', ['references' => [["name" => null]]], 'cover.references.0.name'],
    ['cover', ['references' => [["wiki" => null]]], 'cover.references.0.wiki'],

    ['short_summary', null, 'short_summary'],
    ['short_summary', ['text' => null], 'short_summary.text'],
    ['short_summary', ['references' => []], 'short_summary.references'],
    ['short_summary', ['references' => [["name" => null]]], 'short_summary.references.0.name'],
    ['short_summary', ['references' => [["wiki" => null]]], 'short_summary.references.0.wiki'],

    ['summary', null, 'summary'],
    ['summary', ['text' => null], 'summary.text'],
    ['summary', ['references' => []], 'summary.references'],
    ['summary', ['references' => [["name" => null]]], 'summary.references.0.name'],
    ['summary', ['references' => [["wiki" => null]]], 'summary.references.0.wiki'],

    ['characters', [], 'characters'],
    ['characters', [["name" => null]], 'characters.0.name'],
    ['characters', [["wiki" => null]], 'characters.0.wiki'],
]);

function getChapterData(array $overwrite = []): array {
    return array_merge([
        'number' => 1,
        'title' => 'Romance Dawn - The Dawn of the Adventure' ,
        'release_date' => '1997-07-19',
        'links' => [
            [
                "name" => "wiki",
                "value" => 'https://onepiece.fandom.com/wiki/Chapter_1'
            ],
            [
                "name" => "manganelo",
                "value" => 'https://manganelo.com/chapter/tkqu521609849722/chapter_1'
            ],
        ],
        'cover' => [
            'text' => 'details of the cover scene',
            'image' => 'https://static.wikia.nocookie.net/onepiece/images/6/66/Chapter_1.png/revision/latest',
            'references' => [
                [
                    'name' => 'Luffy',
                    'wiki' => '/wiki/Monkey_D._Luffy',
                ]
            ]
        ],
        'short_summary' => [
            'text' => 'details of the chapter',
            'references' => [
                [
                    'name' => 'luffy',
                    'wiki' => '/wiki/Monkey_D._Luffy',
                ]
            ]
        ],
        'summary' => [
            'text' => 'a more detailed text of the chapter',
            'references' => [
                [
                    'name' => 'Monkey D. Luffy',
                    'wiki' => '/wiki/Monkey_D._Luffy',
                ],
                [
                    'name' => 'Nami',
                    'wiki' => '/wiki/nami',
                ]
            ]
        ],
        'characters' => [
            [
                'name' => 'Monkey D. Luffy',
                'wiki' => '/wiki/Monkey_D._Luffy',
            ]
        ],
    ], $overwrite);
}
