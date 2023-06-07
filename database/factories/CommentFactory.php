<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'subject' => $this->faker->sentence,
            'body' => $this->faker->paragraph(5),
            'article_id' => Article::factory(),
            'user_id' => User::factory(),
        ];
    }
}
