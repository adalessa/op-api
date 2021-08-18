<?php

use App\Models\Chapter;
use App\Models\Entity;

use function Pest\Laravel\postJson;
use function PHPUnit\Framework\assertCount;
use function PHPUnit\Framework\assertNotNull;

it('creates a new chapter', function () {
    $this->withoutExceptionHandling();
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

it('requires a number of the chapter', function () {
    postJson('/api/chapters', getChapterData(['number' => null]))
        ->assertJsonValidationErrors('number');
});

it('requires a title of the chapter', function () {
    postJson('/api/chapters', getChapterData(['title' => null]))
        ->assertJsonValidationErrors('title');
});

it('requires a release date of the chapter', function () {
    postJson('/api/chapters', getChapterData(['release_date' => null]))
        ->assertJsonValidationErrors('release_date');
});

it('requires a release date to be a date of the chapter', function () {
    postJson('/api/chapters', getChapterData(['release_date' => "not a date"]))
        ->assertJsonValidationErrors('release_date');
});

it('can have empty links', function () {
    postJson('/api/chapters', getChapterData(['links' => []]))
        ->assertJsonMissingValidationErrors('links');
});

it('the links need to be a url', function () {
    postJson('/api/chapters', getChapterData(['links' => [
        [
            "name" => "test",
            "value" => "not a url",
        ]
    ]]))->assertJsonValidationErrors('links.0.value');
});

it('requires a cover for the chapter', function () {
    postJson('/api/chapters', getChapterData(['cover' => null]))
        ->assertJsonValidationErrors('cover');
});

it('requires a cover text for the chapter', function () {
    postJson('/api/chapters', getChapterData(['cover' => ['text' => null]]))
        ->assertJsonValidationErrors('cover.text');
});

it('requires a cover image for the chapter', function () {
    postJson('/api/chapters', getChapterData(['cover' => ['image' => null]]))
        ->assertJsonValidationErrors('cover.image');
});

it('cover image needs to be a url', function () {
    postJson('/api/chapters', getChapterData(['cover' => ['image' => "not a url"]]))
        ->assertJsonValidationErrors('cover.image');
});

it('requires cover references', function () {
    postJson('/api/chapters', getChapterData(['cover' => ['references' => []]]))
        ->assertJsonValidationErrors('cover.references');
});

it('requires cover references name', function () {
    postJson('/api/chapters', getChapterData(['cover' => ['references' => [["name" => null]]]]))
        ->assertJsonValidationErrors('cover.references.0.name');
});

it('requires cover references wiki', function () {
    postJson('/api/chapters', getChapterData(['cover' => ['references' => [["wiki" => null]]]]))
        ->assertJsonValidationErrors('cover.references.0.wiki');
});


it('requires a short summary for the chapter', function () {
    postJson('/api/chapters', getChapterData(['short_summary' => null]))
        ->assertJsonValidationErrors('short_summary');
});

it('requires a short summary text for the chapter', function () {
    postJson('/api/chapters', getChapterData(['short_summary' => ['text' => null]]))
        ->assertJsonValidationErrors('short_summary.text');
});


it('requires short summary references', function () {
    postJson('/api/chapters', getChapterData(['short_summary' => ['references' => []]]))
        ->assertJsonValidationErrors('short_summary.references');
});

it('requires short summary references name', function () {
    postJson('/api/chapters', getChapterData(['short_summary' => ['references' => [["name" => null]]]]))
        ->assertJsonValidationErrors('short_summary.references.0.name');
});

it('requires short summary references wiki', function () {
    postJson('/api/chapters', getChapterData(['short_summary' => ['references' => [["wiki" => null]]]]))
        ->assertJsonValidationErrors('short_summary.references.0.wiki');
});


it('requires a summary for the chapter', function () {
    postJson('/api/chapters', getChapterData(['summary' => null]))
        ->assertJsonValidationErrors('summary');
});

it('requires a summary text for the chapter', function () {
    postJson('/api/chapters', getChapterData(['summary' => ['text' => null]]))
        ->assertJsonValidationErrors('summary.text');
});


it('requires summary references', function () {
    postJson('/api/chapters', getChapterData(['summary' => ['references' => []]]))
        ->assertJsonValidationErrors('summary.references');
});

it('requires summary references name', function () {
    postJson('/api/chapters', getChapterData(['summary' => ['references' => [["name" => null]]]]))
        ->assertJsonValidationErrors('summary.references.0.name');
});

it('requires summary references wiki', function () {
    postJson('/api/chapters', getChapterData(['summary' => ['references' => [["wiki" => null]]]]))
        ->assertJsonValidationErrors('summary.references.0.wiki');
});

it('requires characters', function () {
    postJson('/api/chapters', getChapterData(['characters' => []]))
        ->assertJsonValidationErrors('characters');
});

it('requires characters name', function () {
    postJson('/api/chapters', getChapterData(['characters' => [["name" => null]]]))
        ->assertJsonValidationErrors('characters.0.name');
});

it('requires characters wiki', function () {
    postJson('/api/chapters', getChapterData(['characters' => [["wiki" => null]]]))
        ->assertJsonValidationErrors('characters.0.wiki');
});

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
