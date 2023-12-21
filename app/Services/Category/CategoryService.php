<?php

namespace App\Services\Category;

use App\Http\Resources\Article\ArticleResource;
use App\Models\Category;
use App\Services\BaseService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoryService extends BaseService
{
    public function __construct(Category $category)
    {
        $this->model = $category;
    }

    public function getCategories()
    {
        return cache()->rememberForever('categories', function () {
            return $this->model->all();
        });
    }

    public function getArticles(): AnonymousResourceCollection
    {
        return ArticleResource::collection(
            $this->model->articles()
                ->with('user', 'categories')
                ->get()
        );
    }
}
