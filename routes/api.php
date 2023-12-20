<?php

use App\Http\Controllers\Article\ArticleController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::group(['prefix' => 'auth/'], function (Router $router) {

    $router->post('login', [AuthController::class, 'login'])
        ->name('login');

    $router->post('logout', [AuthController::class, 'logout'])
        ->name('logout');

    $router->middleware('jwt.authenticate')
        ->post('refresh', [AuthController::class, 'refresh'])
        ->name('refresh');

    $router->middleware('auth:api')
        ->get('myself', [AuthController::class, 'mySelf'])
        ->name('myself');
});

Route::middleware('jwt.auth')->group(function (Router $router) {
    $router->apiResource('articles', ArticleController::class);
});

