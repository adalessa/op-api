<?php

namespace App\Models;

trait HasReferences
{
    public function references()
    {
        return $this->morphToMany(Reference::class, 'referenceable');
    }

    public function addReference(array $references)
    {
        collect($references)->each(function ($reference) {
            $ref = Reference::where('name', $reference['alias'])->first();

            if (null === $ref) {
                $entity = Entity::firstOrCreate([
                    'name' => $reference['name'],
                    'wiki_path' => $reference['wiki'],
                ]);

                $ref = $entity->references()->create([
                    'name' => $reference['alias'],
                ]);
            }

            $this->references()->attach($ref->id);
        });
    }
}
