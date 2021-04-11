<?php

namespace Tests\Feature;

use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class UpdateTagsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_valid_tag_can_be_updated()
    {
        $tag = Tag::factory()->create();

        $this->put(route('tags.update', $tag->slug), [
            'name' => 'new tag name',
            'description' => 'new tag description',
            'image' => 'D:\sports.jpg'
        ])->assertStatus(200);

        $this->assertDatabaseHas('tags', [
            'name' => 'new tag name',
            'slug' => Str::slug('new tag name'),
        ]);
    }
}
