<?php

namespace App\Http\Resources\Tag;

use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class TagResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'image' => $this->getFirstMedia() ? $this->getFirstMedia()->getUrl() : "",
            'products' => [
                $this->products
            ],
            'articles' => [
                $this->articles
            ],
        ];
    }
}
