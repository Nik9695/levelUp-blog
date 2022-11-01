<?php

use App\Http\Controllers\ArticleCommentController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ArticleLikeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CommentLikeController;
use App\Http\Controllers\UserArticleController;
use App\Http\Controllers\UserCommentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



$unauthenticatedRoutes = ['index', 'show'];

Route::middleware('auth:sanctum')->group(function () use ($unauthenticatedRoutes) {

    Route::get('/user', function () {
        return auth()->user();
    });

    Route::apiResource('articles', ArticleController::class)->except($unauthenticatedRoutes);

    Route::apiResource('comments', CommentController::class)->except($unauthenticatedRoutes);

    Route::apiResource('articles.comments', ArticleCommentController::class)->shallow()->except($unauthenticatedRoutes);
    Route::apiResource('articles.likes', ArticleLikeController::class)->shallow()->except($unauthenticatedRoutes);
    Route::apiResource('comments.likes', CommentLikeController::class)->shallow()->except($unauthenticatedRoutes);
});


Route::apiResource('comments', CommentController::class)->only($unauthenticatedRoutes);

Route::apiResource('articles', ArticleController::class)->only($unauthenticatedRoutes);

Route::apiResource('users', UserController::class)->only($unauthenticatedRoutes);

Route::apiResource('users.articles', UserArticleController::class)->shallow()->only($unauthenticatedRoutes);
Route::apiResource('users.comments', UserCommentController::class)->shallow()->only($unauthenticatedRoutes);

Route::apiResource('articles.comments', ArticleCommentController::class)->shallow()->only($unauthenticatedRoutes);

Route::apiResource('articles.likes', ArticleLikeController::class)->shallow()->only($unauthenticatedRoutes);
Route::apiResource('comments.likes', CommentLikeController::class)->shallow()->only($unauthenticatedRoutes);


Route::post('/authenticate', [AuthController::class, 'authenticate']);
Route::post('/registration', [UserController::class, 'store']);

Route::apiResource('categories', CategoryController::class)->only($unauthenticatedRoutes);
