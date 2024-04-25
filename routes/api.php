<?php

use App\Http\Controllers\api\booksController;
use App\Http\Controllers\api\homeController;
use App\Http\Controllers\api\searchController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//this the home api
Route::get('home/lastadded', [homeController::class, 'lastAdded']);
Route::get('home/categories', [homeController::class, 'index']);
Route::get('home/category/{id}', [homeController::class, 'category']);

//this search and coupon
Route::get('search/coupon/{code}', [searchController::class, 'getCouponBook']);


Route::get('book/details/{id}', [booksController::class, 'show']);
Route::get('user/data/{type}/{id}', [booksController::class, 'publisherOrAuthor']);


