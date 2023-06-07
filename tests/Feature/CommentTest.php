<?php

namespace Tests\Feature;

use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_should_get_index_data()
    {
        $articles = Comment::factory(20)
            ->create();

        $response = $this->getJson(route('comments.index', [
            'article' => 1,
        ]))->assertOk();

        // I have intentionally skipped some of the model field check
        $response->assertJson(fn (AssertableJson $json) => $json->has('status')
            ->has('message')
            ->has('meta')
            ->has('links')
            ->has('data', 10, fn ($json) => $json
                ->where('id', $articles->first()->id)
                ->where('subject', $articles->first()->subject)
                ->where('body', $articles->first()->body)
                ->where('url', $articles->first()->path(true))
                ->has('author')
                ->etc())

            ->etc()
        );
    }
}
