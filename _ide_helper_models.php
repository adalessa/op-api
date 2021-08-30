<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Alias
 *
 * @property int $id
 * @property int $entity_id
 * @property int $default
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Entity $entity
 * @method static \Illuminate\Database\Eloquent\Builder|Alias default()
 * @method static \Database\Factories\AliasFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Alias newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Alias newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Alias query()
 * @method static \Illuminate\Database\Eloquent\Builder|Alias whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alias whereDefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alias whereEntityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alias whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alias whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alias whereUpdatedAt($value)
 */
	class Alias extends \Eloquent {}
}

namespace App\Models{
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
 * @method static \Illuminate\Database\Eloquent\Builder|Chapter encounters(array $entitiesIds, int $type)
 * @method static \Database\Factories\ChapterFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Chapter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Chapter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Chapter query()
 * @method static \Illuminate\Database\Eloquent\Builder|Chapter whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chapter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chapter whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chapter whereReleaseDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chapter whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chapter whereUpdatedAt($value)
 */
	class Chapter extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ChapterEntity
 *
 * @property int $chapter_id
 * @property int $entity_id
 * @property int $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Chapter $chapters
 * @property-read \App\Models\Entity $entities
 * @method static \Illuminate\Database\Eloquent\Builder|ChapterEntity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChapterEntity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChapterEntity query()
 * @method static \Illuminate\Database\Eloquent\Builder|ChapterEntity whereChapterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChapterEntity whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChapterEntity whereEntityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChapterEntity whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChapterEntity whereUpdatedAt($value)
 */
	class ChapterEntity extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Cover
 *
 * @property int $id
 * @property int $chapter_id
 * @property string $text
 * @property string $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Cover newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cover newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cover query()
 * @method static \Illuminate\Database\Eloquent\Builder|Cover whereChapterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cover whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cover whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cover whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cover whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cover whereUpdatedAt($value)
 */
	class Cover extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Entity
 *
 * @property int $id
 * @property string $wiki_path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Alias[] $aliases
 * @property-read int|null $aliases_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Chapter[] $chapters
 * @property-read int|null $chapters_count
 * @method static \Database\Factories\EntityFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Entity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Entity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Entity query()
 * @method static \Illuminate\Database\Eloquent\Builder|Entity whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entity whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entity whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entity whereWikiPath($value)
 */
	class Entity extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Link
 *
 * @property int $id
 * @property int $chapter_id
 * @property string $site
 * @property string $url
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\LinkFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Link newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Link newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Link query()
 * @method static \Illuminate\Database\Eloquent\Builder|Link whereChapterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Link whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Link whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Link whereSite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Link whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Link whereUrl($value)
 */
	class Link extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ShortSummary
 *
 * @property int $id
 * @property int $chapter_id
 * @property string $text
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ShortSummary newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ShortSummary newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ShortSummary query()
 * @method static \Illuminate\Database\Eloquent\Builder|ShortSummary whereChapterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShortSummary whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShortSummary whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShortSummary whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShortSummary whereUpdatedAt($value)
 */
	class ShortSummary extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Summary
 *
 * @property int $id
 * @property int $chapter_id
 * @property string $text
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Summary newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Summary newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Summary query()
 * @method static \Illuminate\Database\Eloquent\Builder|Summary whereChapterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Summary whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Summary whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Summary whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Summary whereUpdatedAt($value)
 */
	class Summary extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

