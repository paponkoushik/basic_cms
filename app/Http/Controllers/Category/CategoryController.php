<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Services\Category\CategoryService;

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
}
