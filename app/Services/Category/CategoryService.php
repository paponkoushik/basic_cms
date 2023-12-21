<?php

namespace App\Services\Category;

use App\Models\Category;

class CategoryService
{
    protected $model;

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
}
