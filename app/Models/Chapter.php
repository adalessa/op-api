<?php

namespace App\Models;

use App\DTO\Chapter as ChapterDTO;
use App\DTO\Link as LinkDTO;
use App\DTO\Reference;
use App\EntityTypesEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;
use Laravel\Scout\Searchable;

/**
 * App\Models\Chapter
 *
 * @property int $id
 * @property int $number
 * @property string $title
 * @property \Illuminate\Support\Carbon $release_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Entity[] $characters
 * @property-read int|null $characters_count
 * @property-read \App\Models\Cover|null $cover
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Entity[] $coverReferences
 * @property-read int|null $cover_references_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Entity[] $entities
 * @property-read int|null $entities_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Link[] $links
 * @property-read int|null $links_count
 * @property-read \App\Models\ShortSummary|null $shortSummary
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Entity[] $shortSummaryReferences
 * @property-read int|null $short_summary_references_count
 * @property-read \App\Models\Summary|null $summary
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Entity[] $summaryReferences
 * @property-read int|null $summary_references_count
 * @method static Builder|Chapter encounters(array $entitiesIds, int $type)
 * @method static \Database\Factories\ChapterFactory factory(...$parameters)
 * @method static Builder|Chapter newModelQuery()
 * @method static Builder|Chapter newQuery()
 * @method static Builder|Chapter query()
 * @method static Builder|Chapter whereCreatedAt($value)
 * @method static Builder|Chapter whereId($value)
 * @method static Builder|Chapter whereNumber($value)
 * @method static Builder|Chapter whereReleaseDate($value)
 * @method static Builder|Chapter whereTitle($value)
 * @method static Builder|Chapter whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Chapter extends Model
{
    use HasFactory;
    use Searchable;

    public $guarded = [];

    protected $dates = ['release_date'];

    public function shortSummary(): HasOne
    {
        return $this->hasOne(ShortSummary::class);
    }

    public function summary(): HasOne
    {
        return $this->hasOne(Summary::class);
    }

    public function cover(): HasOne
    {
        return $this->hasOne(Cover::class);
    }

    public function entities(): BelongsToMany {
        return $this->belongsToMany(Entity::class);
    }

    public function characters(): BelongsToMany {
        return $this->entities()->wherePivot('type' , EntityTypesEnum::map[EntityTypesEnum::TYPE_CHARACTERS]);
    }
    public function shortSummaryReferences(): BelongsToMany {
        return $this->entities()->wherePivot('type' , EntityTypesEnum::map[EntityTypesEnum::TYPE_SHORT_SUMMARY]);
    }
    public function summaryReferences(): BelongsToMany {
        return $this->entities()->wherePivot('type' , EntityTypesEnum::map[EntityTypesEnum::TYPE_SUMMARY]);
    }
    public function coverReferences(): BelongsToMany {
        return $this->entities()->wherePivot('type' , EntityTypesEnum::map[EntityTypesEnum::TYPE_COVER]);
    }

    public function links(): HasMany
    {
        return $this->hasMany(Link::class);
    }

    public function path(): string
    {
        return route('chapters.show', $this->number);
    }

    public function addLink(string $site, string $url): static
    {
        $this->links()->create([
            'site' => $site,
            'url' => $url,
        ]);

        return $this;
    }

    public function scopeEncounters(Builder $query, array $entitiesIds, int $type): Builder
    {
        $chapterIds = ChapterEntity::whereHas('entities', function($query) use ($entitiesIds) {
            return $query->whereIn('id', $entitiesIds);
        })->where('type', $type)
            ->select('chapter_id')
            ->groupBy('chapter_id')
            ->havingRaw('SUM(1) >= ?', [count($entitiesIds)]);

        return $query->whereIn('id', $chapterIds);
    }

    private function removeEntities()
    {
        $this->entities()->sync([]);
    }

    public static function fromDto(ChapterDTO $dto): self {

        return DB::transaction(function() use ($dto){
            /** @var Chapter $chapter */
            $chapter = self::firstOrCreate([
                'number' => $dto->getNumber(),
            ],[
                'title' => $dto->getTitle(),
                'release_date' => $dto->getReleaseDate(),
            ]);

            $chapter->removeEntities();

            $coverDto = $dto->getCover();
            $chapter->cover()->create([
                'text' => $coverDto->getText(),
                'image' => $coverDto->getImage(),
            ]);
            $chapter->addEntities($coverDto->getReferences(), EntityTypesEnum::map[EntityTypesEnum::TYPE_COVER]);

            $summaryDto = $dto->getSummary();
            $chapter->summary()->create([
                'text' => $summaryDto->getText(),
            ]);
            $chapter->addEntities($summaryDto->getReferences(), EntityTypesEnum::map[EntityTypesEnum::TYPE_SUMMARY]);


            $shortSummaryDto = $dto->getShortSummary();
            $chapter->shortSummary()->create([
                'text' => $shortSummaryDto->getText(),
            ]);
            $chapter->addEntities($shortSummaryDto->getReferences(), EntityTypesEnum::map[EntityTypesEnum::TYPE_SHORT_SUMMARY]);

            array_map(
                fn (LinkDTO $link) => $chapter->addLink($link->getName(), $link->getValue()),
                $dto->getLinks()
                );

            $chapter->addEntities($dto->getCharacters(), EntityTypesEnum::map[EntityTypesEnum::TYPE_CHARACTERS]);

            return $chapter;
        });
    }

    /**
     * @param Reference[] $references
     */
    private function addEntities(array $references, int $type): void
    {
        collect($references)->unique(fn (Reference $ref) => $ref->getWiki())
            ->map(function (Reference $ref) {
                /** @var Entity $entity */
                $entity = Entity::firstOrCreate(['wiki_path' => $ref->getWiki()]);

                $entity->aliases()->firstOrCreate(['name' => $ref->getName()], ['default' => $entity->wasRecentlyCreated]);

                return $entity;
            })
            ->each(fn (Entity $entity) => $this->entities()->attach($entity->id, ["type" => $type]));
    }
}
