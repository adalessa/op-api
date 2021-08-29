<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\DTO\Chapter;
use App\DTO\Cover;
use App\DTO\Link;
use App\DTO\Reference;
use App\DTO\Summary;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class CreateChapterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'number' => ['required'],
            'title' => ['required'],
            'release_date' => ['required', 'date'],
            'links.*.name' => ['required'],
            'links.*.value' => ['required', 'url'],
            'cover' => ['required'],
            'cover.text' => ['required'],
            'cover.image' => ['required', 'url'],
            'cover.references.*.name' => ['required'],
            'cover.references.*.wiki' => ['required'],
            'short_summary' => ['required'],
            'short_summary.text' => ['required'],
            'short_summary.references.*.name' => ['required'],
            'short_summary.references.*.wiki' => ['required'],
            'summary' => ['required'],
            'summary.text' => ['required'],
            'summary.references.*.name' => ['required'],
            'summary.references.*.wiki' => ['required'],
            'characters.*.name' => ['required'],
            'characters.*.wiki' => ['required'],
        ];
    }

    public function getDto(): Chapter
    {
        $data = $this->validated();

        return (new Chapter())
            ->setNumber($data['number'])
            ->setTitle($data['title'])
            ->setReleaseDate(Carbon::parse($data['release_date']))
            ->setCover(
                (new Cover())
                    ->setText($data['cover']['text'])
                    ->setImage($data['cover']['image'])
                    ->setReferences(
                        collect($data['cover']['references'])
                        ->map(fn ($ref) => (new Reference())->setName($ref['name'])->setWiki($ref['wiki']))
                        ->all()
                    )
            )
            ->setSummary(
                (new Summary())
                    ->setText($data['summary']['text'])
                    ->setReferences(
                        collect($data['summary']['references'])
                        ->map(fn ($ref) => (new Reference())->setName($ref['name'])->setWiki($ref['wiki']))
                        ->all()
                    )
            )
            ->setShortSummary(
                (new Summary())
                    ->setText($data['short_summary']['text'])
                    ->setReferences(
                        collect($data['short_summary']['references'])
                            ->map(fn ($ref) => (new Reference())->setName($ref['name'])->setWiki($ref['wiki']))
                            ->all()
                    )
            )
            ->setLinks(
                collect($data['links'])
                    ->map(fn ($link) => (new Link())->setName($link['name'])->setValue($link['value']))
                    ->all()
            )
            ->setCharacters(
                collect($data['characters'])
                ->map(fn ($ref) => (new Reference())->setName($ref['name'])->setWiki($ref['wiki']))
                ->all()
            )
        ;
    }
}
