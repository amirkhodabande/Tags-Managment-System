<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $tags = Tag::factory(15)->create();

        foreach ($tags as $tag) {
//          Add an image address from your local machine
            $tag->addMedia("D:\Laragon\www\SaymanDigital-Test\public\assets\sports.jpg")
                ->preservingOriginal()
                ->toMediaCollection();
        }
    }
}
