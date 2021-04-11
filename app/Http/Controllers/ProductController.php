<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'tags_id' => 'required'
        ]);

        $product = Product::create([
            'name' => $request->name
        ]);

        foreach ($request->tags_id as $tag_id) {
            $product->tags()->attach($tag_id);
        }

        return response("Product created successfully!", 201);
    }
}
