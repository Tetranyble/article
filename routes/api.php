<?php

use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\ArticleLikeController;
use App\Http\Controllers\Api\ArticleViewController;
use App\Http\Controllers\Api\CommentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1'], function () {

    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });

    /**
     * Articles endpoint
     */
    Route::get('articles', [ArticleController::class, 'index'])
        ->name('articles.index');
    Route::get('articles/{article}', [ArticleController::class, 'show'])
        ->name('articles.show');
    Route::get('articles/{article}/view', ArticleViewController::class)
        ->name('articles.view');
    Route::get('articles/{article}/like', ArticleLikeController::class)
        ->name('articles.like');

    /**
     * Comments endpoint
     */
    Route::get('articles/{article}/comment', [CommentController::class, 'index'])
        ->name('comments.index');
    Route::get('articles/{articleId}/comment/{commentId}', [CommentController::class, 'show'])
        ->name('comments.show');

});
