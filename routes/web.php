<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\StyleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;

Route::get('/', [PageController::class, 'home'])->name('home');

Route::middleware('user.verified')->group(function() {
    Route::view('/login', 'pages.auth.login')->name('login');
    Route::view('/registration', 'pages.auth.registration')->name('registration');
});

Route::get('/user/blocked', [UserController::class, 'blocked'])->name('user.blocked');

Route::post('/login', [UserController::class, 'login']);
Route::post('/registration', [UserController::class, 'registration']);

Route::resource('product', ProductController::class);

Route::view('/cart', 'pages.cart')->name('cart');
Route::view('/favorites', 'pages.favorites')->name('favorites');

Route::resource('posts', PostController::class);
Route::resource('promotions', PromotionController::class);
Route::resource('shops', ShopController::class);

Route::middleware('auth')->group(function() {
    Route::resource('order', OrderController::class);

    Route::middleware('can:is-admin')->group(function() {
        Route::resource('user', UserController::class);

        Route::resource('brands', BrandController::class);
        Route::resource('category', CategoryController::class);
        Route::resource('city', CityController::class);
        Route::resource('collection', CollectionController::class);
        Route::resource('color', ColorController::class);
        Route::resource('style', StyleController::class);

        Route::get('/shop/all', [PageController::class, 'shops'])->name('shops.all');

        Route::get('/admin/posts', [PostController::class, 'adminPosts'])->name('admin.posts');
        Route::get('/post/{post}/comments', [PostController::class, 'commentsForPost'])->name('post.comments');
        Route::delete('/comment/{comment}/delete', [CommentController::class, 'delete'])->name('comment.delete');

        Route::get('/admin/promotions', [PromotionController::class, 'adminPromotions'])->name('admin.promotions');
        Route::get('/admin/promotions/{promotion}/attach', [PromotionController::class, 'attach'])->name('admin.attach');
        Route::post('/admin/promotions/attach', [PromotionController::class, 'attachPromotions'])->name('admin.promotions.attach');
        Route::patch('/admin/promotions/{promotion}/status', [PromotionController::class, 'editPromotionStatus'])->name('promotion.status');
        Route::delete('/admin/promotions/{product}/detach', [PromotionController::class, 'detach'])->name('promotion.detach');

        Route::get('admin/users', [UserController::class, 'users'])->name('admin.users');
        Route::patch('admin/users/{user}/update', [UserController::class, 'updateUserStatus'])->name('admin.users.update');
        Route::patch('admin/users/{user}/role', [UserController::class, 'updateUserRole'])->name('admin.role.update');

        Route::get('/admin/orders', [OrderController::class, 'usersOrders'])->name('admin.orders');

        Route::get('/admin/control', [PageController::class, 'control'])->name('admin.control');

        Route::get('/admin/products', [ProductController::class, 'products'])->name('admin.products');

        Route::patch('/password/{user}/reset', [UserController::class, 'reset'])->name('password.reset');
    });

    Route::resource('account', UserController::class);
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
});
