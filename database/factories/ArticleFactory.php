<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $paragraphs = $this->faker->paragraphs(rand(8, 30));
        $title = $this->faker->realText(50);
        $post = "<h1>{$title}</h1>";
        foreach ($paragraphs as $para) {
            $post .= "<p>{$para}</p>";
        }

        return [
            'title' => $title,
            'description' => $paragraphs[1],
            'thumbnail' => $this->faker->imageUrl(),
            'cover' => $this->faker->imageUrl(),
            'article' => $post,
            'views' => $this->faker->numberBetween(20, 20000),
            'user_id' => User::factory(),

        ];
    }

    /**
     * Configure the model factory.
     */
    public function configure(): static
    {
        return $this->afterMaking(function (Article $article) {
            //return $user->updateContactPreference(Contact::EMAIL);
        })->afterCreating(function (Article $article) {
            Tag::factory()->count(5)->create()
                ->map(fn ($tag) => $article->giveTags($tag));

            User::factory()->count(4)->create()
                ->map(fn ($user) => $article->liked($user));

        });
    }
}
