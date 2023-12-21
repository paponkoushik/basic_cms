<?php

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Http\Resources\Article\ArticleResource;
use App\Models\Article;
use App\Services\Article\ArticleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

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


    public function store(ArticleRequest $request): JsonResponse
    {
        DB::transaction( fn() =>
            $this->service
                ->setAttrs($request->only('title','content', 'categories'))
                ->mergeFillAbleData()
                ->storeArticle()
                ->syncCategories()
        );

        return response()->json(['message' => 'Data has been stored successfully']);
    }

    public function update(ArticleRequest $request, Article $article)
    {

    }
//
//    public function destroy(Article $article)
//    {
//    }

}
