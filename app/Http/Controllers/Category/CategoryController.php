<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\Category\CategoryService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoryController extends Controller
{
    protected $service;
    public function __construct(CategoryService $categoryService)
    {
        $this->service = $categoryService;
    }

    public function index()
    {
        return $this->service->getCategories();
    }

    public function getArticle(Category $category): AnonymousResourceCollection
    {
        return $this->service->setModel($category)->getArticles();
    }
}
