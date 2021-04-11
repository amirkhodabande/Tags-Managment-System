<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tag\CreateRequest;
use App\Http\Requests\Tag\UpdateRequest;
use App\Http\Resources\Tag\TagResource;
use App\Http\Resources\Tag\TagCollection;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new TagCollection(Tag::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $name = $request->name;

        $tag = Tag::create([
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $request->description,
        ]);

        $tag->addMedia($request->image)->toMediaCollection();

        return response("The tag created successfully!", 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        return new TagResource($tag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequest  $request
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Tag $tag)
    {
        $name = $request->name;

        $tag->update([
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $request->description,
        ]);

        if($tag->image) {
            if($tag->media()) {
                $tag->deleteMedia();
            }
            $tag->addMedia($tag->image)->toMediaCollection();
        }

        return ("The tag: $tag->slug Updated successfully!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $tag->products()->detach();
        $tag->articles()->detach();

        $tag->delete();
        return ("The tag removed successfully!");
    }
}
