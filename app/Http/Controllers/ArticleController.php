<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'tags_id' => 'required'
        ]);

        $article = Article::create([
            'title' => $request->title
        ]);

        foreach ($request->tags_id as $tag_id) {
            $article->tags()->attach($tag_id);
        }

        return response("Article created successfully!", 201);
    }
}
