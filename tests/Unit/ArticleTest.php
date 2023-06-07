<?php

namespace Tests\Unit;

use App\Models\Article;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_a_cover()
    {
        $cover = 'http://article.test/images/article.png';
        $article = Article::factory()->create(['cover' => $cover]);

        $this->assertEquals($cover, $article->cover);
    }

    /** @test */
    public function it_has_a_thumbnail()
    {
        $thumbnail = 'http://article.test/images/article.png';
        $article = Article::factory()->create(['thumbnail' => $thumbnail]);

        $this->assertEquals($thumbnail, $article->thumbnail);
    }

    /** @test */
    public function it_has_a_title()
    {
        $title = 'it has a title content';
        $article = Article::factory()->create(['title' => $title]);

        $this->assertEquals($title, $article->title);
    }

    /** @test */
    public function it_has_a_description()
    {
        $description = 'it has a description';
        $article = Article::factory()->create(['description' => $description]);

        $this->assertEquals($description, $article->description);
    }

    /** @test */
    public function it_has_a_article()
    {
        $body = 'it has a article content';
        $article = Article::factory()->create(['article' => $body]);

        $this->assertEquals($body, $article->article);
    }

    /** @test */
    public function a_user_can_like_an_article()
    {

        $article = Article::factory()->create();

        $user = User::factory()->create();

        $article->liked($user);

        $this->assertDatabaseHas('article_likes', [
            'article_id' => $article->id,
            'user_id' => $user->id,
        ]);
    }

    /** @test */
    public function a_user_can_unlike_an_article()
    {

        // I am intentionally skipping this test
        $this->markTestSkipped();

        $article = Article::factory()->create();

        $user = User::factory()->create();

        $article->liked($user);
        $article->liked($user);

        $this->assertDatabaseCount('article_likes', 0);
    }

    /** @test */
    public function it_has_a_views()
    {
        $view_count = 10;
        $article = Article::factory()->create(['views' => $view_count]);

        $this->assertEquals($view_count, $article->views);
    }

    /** @test */
    public function it_has_an_user_id()
    {
        $user = User::factory()->create();
        $article = Article::factory()->create(['user_id' => $user->id]);

        $this->assertEquals($user->id, $article->user_id);
    }

    /** @test */
    public function an_article_view_count_can_be_increased()
    {

        $article = Article::factory()->create(['views' => 200]);
        $article->viewed();
        $this->assertDatabaseHas('articles', ['views' => 201]);
    }

    /** @test */
    public function an_article_have_tags()
    {

        $article = Article::factory()->create();

        $this->assertTrue((bool) $article->tags->count());
    }

    /** @test */
    public function an_article_has_comments()
    {

        $article = Article::factory()
            ->has(Comment::factory()->count(5), 'comments')->create();

        $this->assertDatabaseCount('comments', 5);
    }
}
