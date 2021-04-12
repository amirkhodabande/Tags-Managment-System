<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateArticleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_valid_article_can_be_stored()
    {
        $product = [
            'title' => 'article title',
            'tags_id' => ['1', 2]
        ];

        $this->post("/api/articles", $product)
            ->assertStatus(201);

        $this->assertEquals(1, Article::count());
    }

    /** @test */
    public function a_created_article_connect_to_tags_successfully()
    {
        $tags = Tag::factory(2)->create();

        $article = [
            'title' => 'article title',
            'tags_id' => [1, 2]
        ];

        $this->post("/api/articles", $article)
            ->assertStatus(201);

        $this->assertEquals(1, Article::count());

        $this->assertDatabaseHas('taggables', [
            'tag_id' => '1',
            'taggable_id' => '1',
            'taggable_type' => 'App\Models\Article',
        ]);
        $this->assertDatabaseHas('taggables', [
            'tag_id' => '2',
            'taggable_id' => '1',
            'taggable_type' => 'App\Models\Article',
        ]);
    }
}
