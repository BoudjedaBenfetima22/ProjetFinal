<?php

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\OffersController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AgenceController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ImageController;

Route::get('images/{id}',[ImageController::class, 'fetch']);
Route::apiResource('categories', CategoryController::class);
Route::apiResource('offers', OffersController::class);

Route::get('/appartementCat',[OffersController::class, 'appartementCat']);
Route::get('/villaCat',[OffersController::class, 'villaCat']);
Route::get('/studioCat',[OffersController::class, 'studioCat']);
Route::get('/housesCat',[OffersController::class, 'housesCat']);


Route::delete('/offers/{$id}',[OffersController::class, 'destroy']);
Route::put('/offers/{$id}',[OffersController::class, 'update']);

//Route::get('/user',[AuthController::class, 'user']);
//Route::post('/logout',[AuthController::class, 'logout']);
// Public routes
Route::post('/register_agence', [AuthController::class, 'register_agence']);
Route::post('/login_agence', [AuthController::class, 'login_agence']);
// Public routes client
Route::post('/register_client', [AuthController::class, 'register_client']);
Route::post('/login_client', [AuthController::class, 'login_client']);

//Route::post('/logout', [AuthController::class, 'logout']);
//offer
Route::group(['middleware' => ['auth:sanctum']], function () {
    //offer
//    Route::post('/offers/create', [OffersController::class, 'create']);
//    Route::post('/offers/delete', [OffersController::class, 'delete']);
//    Route::post('/offers/update', [OffersController::class, 'update']);
//    Route::get('/offers', [OffersController::class, 'offers']);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
    Route::get('/user',[AuthController::class, 'user']);
    Route::post('/logout',[AuthController::class, 'logout']);
});
