<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Tag;
use Tests\TestCase;

class CreateTagsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_name_is_required_to_create_a_tag()
    {
        $tag = [
            'description' => 'new tag description',
            'image' => 'FakeUrl',
        ];

        $this->post("/api/tags", $tag)
            ->assertSessionHasErrors('name');

        $this->assertEquals(0, Tag::count());
    }

    /** @test */
    public function the_description_is_required_to_create_a_tag()
    {
        $tag = [
            'name' => 'name',
            'image' => 'FakeUrl',
        ];

        $this->post("/api/tags", $tag)
            ->assertSessionHasErrors('description');

        $this->assertEquals(0, Tag::count());
    }

    /** @test */
    public function the_image_is_required_to_create_a_tag()
    {
        $tag = [
            'name' => 'name',
            'description' => 'new tag description',
        ];

        $this->post("/api/tags", $tag)
            ->assertSessionHasErrors('image');

        $this->assertEquals(0, Tag::count());
    }
}
