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
    public function a_valid_tag_can_be_stored()
    {
        $this->withoutExceptionHandling();
        $tag = [
            'name' => 'name of the valid tag',
            'description' => 'new tag description',
            'image' => 'D:\sports.jpg',
        ];

        $this->post("/api/tags", $tag)
            ->assertStatus(201);

        $this->assertEquals(1, Tag::count());
    }

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

    /** @test */
    public function tags_name_must_be_unique_to_create_a_new_tag()
    {
//        Store a tag into the database
        $tag = Tag::factory()->create([
            'name' => 'name-tag',
            'description' => 'new tag description',
        ]);

//        Just make a tag and save it into $tag variable
        $tag = Tag::factory()->make([
            'name' => 'name-tag',
            'description' => 'new tag description',
        ]);

        $this->post("/api/tags", $tag->toArray())
            ->assertSessionHasErrors('name');

        $this->assertEquals(1, Tag::count());
    }
}
