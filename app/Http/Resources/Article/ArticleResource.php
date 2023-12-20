<?php

namespace App\Http\Resources\Article;

use App\Http\Resources\AuthorResource;
use App\Http\Resources\Category\CategoryResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'author' => new AuthorResource($this->whenLoaded('author')),
            'published_at' => $this->published_at->toDateTimeString(),
            'categories' => CategoryResource::collection($this->whenLoaded('categories')),
        ];

    }
}
