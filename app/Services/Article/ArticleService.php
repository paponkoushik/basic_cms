<?php

namespace App\Services\Article;

use App\Http\Resources\Article\ArticleResource;
use App\Models\Article;
use App\Services\BaseService;
use App\Services\Traits\HasAttrs;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Str;

class ArticleService extends BaseService
{
    public function __construct(Article $article)
    {
        $this->model = $article;
    }

    public function getArticles(): AnonymousResourceCollection
    {
        return ArticleResource::collection(
            $this->model
                ->with('user', 'categories')
                ->get()
        );
    }

    public function getArticleData(): ArticleResource
    {
        return new ArticleResource($this->model->load('user', 'categories'));
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

    public function updateArticle(): self
    {
        $this->model->fill($this->getAttrs())->save();

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
