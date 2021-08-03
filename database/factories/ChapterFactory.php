<?php

namespace Database\Factories;

use App\Models\Chapter;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChapterFactory extends Factory
{
    protected $model = Chapter::class;

    public function definition()
    {
        return [
            'number' => $this->faker->randomNumber(),
            'title' => $this->faker->word,
            'release_date' => $this->faker->date(),
        ];
    }
}
