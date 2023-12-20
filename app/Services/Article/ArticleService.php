<?php

namespace App\Services\Article;

use App\Http\Resources\Article\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ArticleService
{
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
}
