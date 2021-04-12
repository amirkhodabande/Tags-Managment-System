<?php

namespace Tests\Feature;

use App\Models\Product;
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
}
