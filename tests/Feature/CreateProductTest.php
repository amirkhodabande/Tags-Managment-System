<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateProductTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_valid_product_can_be_stored()
    {
        $product = [
            'name' => 'product name',
            'tags_id' => ['1', 2]
        ];

        $this->post("/api/products", $product)
            ->assertStatus(201);

        $this->assertEquals(1, Product::count());
    }

    /** @test */
    public function a_created_product_connect_to_tags_successfully()
    {
        $tags = Tag::factory(2)->create();

        $product = [
            'name' => 'product name',
            'tags_id' => [1, 2]
        ];

        $this->post("/api/products", $product)
            ->assertStatus(201);

        $this->assertEquals(1, Product::count());

        $this->assertDatabaseHas('taggables', [
            'tag_id' => '1',
            'taggable_id' => '1',
            'taggable_type' => 'App\Models\Product',
        ]);
        $this->assertDatabaseHas('taggables', [
            'tag_id' => '2',
            'taggable_id' => '1',
            'taggable_type' => 'App\Models\Product',
        ]);
    }
}
