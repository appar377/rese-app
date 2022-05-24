<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\ReserveController;
use App\Http\Controllers\ThanksController;
use App\Http\Controllers\FavoriteController;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

Route::get('/register',  [RegisteredUserController::class, 'create']);
Route::post('/register',  [RegisteredUserController::class, 'store']);

Route::get('/thanks',  [ThanksController::class, 'index']);

Route::get('/',  [ShopController::class, 'index']);

Route::get('/detail/{shop_id}',  [ShopController::class, 'detail']);

Route::get('/search',  [ShopController::class, 'search']);

Route::group(['middleware' => 'auth'],function() {

  Route::post('/logout', [AuthenticatedSessionController::class, 'destroy']);

  Route::get('/mypage',  [UserController::class, 'mypage']);

  Route::get('/done',  [ReserveController::class, 'done']);
  Route::post('/reserve',  [ReserveController::class, 'store']);
  Route::post('/reserve/delete',  [ReserveController::class, 'destroy']);

  Route::post('/favorite',  [FavoriteController::class, 'store']);
  Route::post('/favorite/delete',  [FavoriteController::class, 'destroy']);

});