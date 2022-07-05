<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReserveController;
use App\Http\Controllers\ThanksController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ReviewController;

Route::get('/thanks',  [ThanksController::class, 'index']);

Route::get('/',  [ShopController::class, 'index']);

Route::get('/detail/{shop_id}',  [ShopController::class, 'detail']);

Route::get('/search',  [ShopController::class, 'search']);

Route::group(['middleware' => ['verified', 'can:user']],function() {

  Route::get('/mypage',  [UserController::class, 'mypage']);

  Route::get('/done',  [ReserveController::class, 'done']);

  Route::prefix('/reserve')->group(function () {
    Route::post('',  [ReserveController::class, 'store']);
    Route::post('/delete',  [ReserveController::class, 'destroy']);
    Route::post('/update',  [ReserveController::class, 'update']);
  });

  Route::prefix('/favorite')->group(function () {
    Route::post('',  [FavoriteController::class, 'store']);
    Route::post('/delete',  [FavoriteController::class, 'destroy']);
  });

  Route::post('/review', [ReviewController::class, 'store']);
});

Route::group(['middleware' => 'can:manager'], function () {
  Route::get('/management', [UserController::class, 'management']);

  Route::post('/management/store', [UserController::class, 'store']);

  Route::post('/management/delete', [UserController::class, 'delete']);
});

Route::group(['middleware' => ['verified','can:shop_leader']], function () {
  Route::get('/create_shop', [ShopController::class, 'create_shop']);

  Route::get('/reserve/{shop_id}', [ReserveController::class, 'confirmation']);

  Route::post('/shop/store', [ShopController::class, 'store']);

  Route::post('/shop/update', [ShopController::class, 'update']);

  Route::post('/shop/delete', [ShopController::class, 'delete']);
});
Route::get('collation/{reserve_id}', [ReserveController::class, 'collation']);