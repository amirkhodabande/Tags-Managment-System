<?php

namespace Tests\Feature;

use App\Models\Article;
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
}
