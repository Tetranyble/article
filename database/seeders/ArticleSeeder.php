<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Article::factory()->count(20)
            ->has(Comment::factory()->count(5), 'comments')
            ->create()->map(function ($article) {
                Tag::factory()->count(5)->create()
                    ->map(fn ($tag) => $article->giveTags($tag));

                User::factory()->count(4)->create()
                    ->map(fn ($user) => $article->liked($user));
            });

    }
}
