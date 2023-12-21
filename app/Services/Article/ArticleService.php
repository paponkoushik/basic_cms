<?php

namespace App\Services\Article;

use App\Http\Resources\Article\ArticleResource;
use App\Models\Article;
use App\Services\Traits\HasAttrs;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Str;

class ArticleService
{
    use HasAttrs;
    protected $model;
    public function __construct(Article $article)
    {
        $this->model = $article;
    }

    public function setModel(Article $article): static
    {
        $this->model = $article;

        return $this;
    }
    public function getArticles(): AnonymousResourceCollection
    {
        return ArticleResource::collection(
            $this->model
                ->with('author', 'categories')
                ->get()
        );
    }

    public function getArticleData(): ArticleResource
    {
        return new ArticleResource($this->model->load('author', 'categories'));
    }

    public function mergeFillAbleData(): self
    {
        $this->mergeAttrs([
            'slug' => Str::slug($this->getAttribute('title')) . '_' . uniqid(),
            'author' => auth()->user()->id,
            'published_at' => now(),
        ]);

        return $this;
    }

    public function storeArticle(): self
    {
        $this->model = $this->model
            ->query()
            ->create($this->getAttrs());

        return $this;
    }

    public function syncCategories(): self
    {
        $this->model
            ->categories()
            ->sync($this->getAttribute('categories'));

        return $this;
    }
}
