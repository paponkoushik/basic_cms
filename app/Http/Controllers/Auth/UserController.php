<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\Auth\UserService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{
    protected $service;
    public function __construct(UserService $userService)
    {
        $this->service = $userService;
    }

    public function getAuthArticles(): AnonymousResourceCollection
    {
        return $this->service->getAuthArticles();
    }
}
