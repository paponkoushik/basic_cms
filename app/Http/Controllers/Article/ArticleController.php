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
        try {
            return DB::transaction( function () use ($request) {
                $article = $this->service
                    ->setAttrs($request->only('title','content', 'categories'))
                    ->mergeFillAbleData()
                    ->storeArticle()
                    ->syncCategories()
                    ->getArticleData();

                return response()->json(['message' => 'Data has been stored successfully', 'article' => $article], 201);
            });
        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], 500);
        }
    }

    public function update(ArticleRequest $request, Article $article): JsonResponse
    {
        try {
            return DB::transaction( function () use ($request, $article) {
                $article = $this->service
                    ->setAttrs($request->only('title','content', 'categories'))
                    ->setModel($article)
                    ->updateArticle()
                    ->syncCategories()
                    ->getArticleData();

                return response()->json(['message' => 'Data has been updated successfully', 'article' => $article], 200);
            });
        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], 500);
        }
    }

    public function destroy(Article $article): JsonResponse
    {
        try {
            $article->delete();
            return response()->json(['message' => 'data has been deleted successfully'], 200);
        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], 500);
        }
    }

}
