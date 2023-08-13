<?php

use Illuminate\Http\Request;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\AuthController;

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


Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', [AuthController::class, 'user']);



Route::middleware('auth:api')->group(function () {


   Route::get('/product-filter-options', [ProductController::class, 'fetchFilterOptions']);
   Route::get('/product-sort-options', [ProductController::class, 'fetchSortOptions']);
   Route::get('/products', [ProductController::class, 'index']);
   Route::get('products/{id}', [ProductController::class, 'show']);

   Route::get('/favorites', [ProductController::class, 'listFavorites']);
   Route::post('/favorites/{productId}', [ProductController::class, 'addToFavorites']);
   Route::post('/favorites/remove/{productId}', [ProductController::class, 'removeFromFavorites']);

   // Route::post('/products/{product}/toggle-favorite', [ProductController::class, 'toggleFavorite']);
   // Route::get('/favorite-products', [ProductController::class, 'getFavoriteProducts']);
   // Other authenticated routes
});