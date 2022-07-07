<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FiltersController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/order/store', [OrderController::class, 'createOrder']);
Route::post('/cart/update', [ProductController::class, 'updateCartProducts']);

Route::post('/comments/store', [CommentController::class, 'store']);

Route::post('/user/authentication', [UserController::class, 'authentication']);

Route::get('/comments/{post}', [CommentController::class, 'index']);
Route::delete('/comment/delete', [CommentController::class, 'destroy']);

Route::get('/promotions/{count}', [PromotionController::class, 'getLatestPromotions']);

Route::get('/catalog/filters', [FiltersController::class, 'filter']);

Route::get('/shops/all', [ShopController::class, 'all']);

Route::post('/review/store', [ReviewController::class, 'store']);
Route::get('/reviews/{product}', [ReviewController::class, 'index']);
