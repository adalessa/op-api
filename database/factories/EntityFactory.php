<?php

namespace Database\Factories;

use App\Models\Entity;
use Illuminate\Database\Eloquent\Factories\Factory;

class EntityFactory extends Factory
{
    protected $model = Entity::class;

    public function definition()
    {
        return [
            'wiki_path' => "/wiki/".$this->faker->word,
        ];
    }
}
