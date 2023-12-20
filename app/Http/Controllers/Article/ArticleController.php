<?php

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Controller;
use App\Http\Resources\Article\ArticleResource;
use App\Models\Article;
use App\Services\Article\ArticleService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ArticleController extends Controller
{
    protected $service;

    public function __construct(ArticleService $articleService)
    {
        $this->service = $articleService;
    }

    public function index(): AnonymousResourceCollection
    {
        return $this->service->getArticles();
    }

    public function show(Article $article): ArticleResource
    {
        return $this->service->setModel($article)->getArticleData();
    }


//    public function store(ArticleRequest $request)
//    {
//    }
//
//    public function update(ArticleRequest $request, Article $article)
//    {
//
//    }
//
//    public function destroy(Article $article)
//    {
//    }

}
