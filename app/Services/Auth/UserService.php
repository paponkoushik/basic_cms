<?php

namespace App\Services\Auth;

use App\Http\Resources\Article\ArticleResource;
use App\Services\BaseService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserService extends BaseService
{
    public function getAuthArticles(): AnonymousResourceCollection
    {
        return ArticleResource::collection(
            auth()->user()->articles()
                ->with('user', 'categories')
                ->get()
        );
    }
}
