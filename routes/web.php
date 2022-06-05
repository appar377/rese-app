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

Route::group(['middleware' => 'auth'],function() {

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