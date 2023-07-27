<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('data',[ProductController::class,'index']);
Route::get('data/{id}',[ProductController::class,'show']);
Route::get('data/filter/{cat_id}',[ProductController::class,'destroy']);
Route::get('category',[CategoryController::class,'index']);
Route::post('login',[UserController::class,'index']);


Route::group(['middleware' => 'auth:sanctum'], function(){
    Route::post('category/create',[CategoryController::class,'create']);
    Route::post('data/create',[ProductController::class,'create']);
    Route::put('data/updates/{id}',[ProductController::class,'update']);
    Route::delete('category/delete/{id}',[CategoryController::class,'store']);
    Route::delete('data/delete/{id}',[ProductController::class,'store']);
});
