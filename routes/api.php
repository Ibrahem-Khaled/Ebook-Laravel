<?php

use App\Http\Controllers\api\authController;
use App\Http\Controllers\api\booksController;
use App\Http\Controllers\api\CartController;
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

//Auth JWT
Route::post('login', [authController::class, 'login']);
Route::post('register', [authController::class, 'register']);
Route::post('logout', [authController::class, 'logout']);
Route::get('me', [authController::class, 'me']);
Route::post('auth/update', [authController::class, 'update']);
Route::post('change/password', [authController::class, 'changePassword']);

//this the home api
Route::get('home/lastadded', [homeController::class, 'lastAdded']);
Route::get('home/categories', [homeController::class, 'index']);
Route::get('home/category/{id}', [homeController::class, 'category']);

//this search and coupon
Route::get('search/coupon/{code}', [searchController::class, 'getCouponBook']);

Route::get('book/details/{id}', [booksController::class, 'show']);
Route::get('user/data/{type}/{id}', [booksController::class, 'publisherOrAuthor']);

//this create cart and get 
Route::get('user/cart', [CartController::class, 'index']);
Route::post('user/add/cart', [CartController::class, 'addToCart']);
Route::get('user/books', [CartController::class, 'userBook']);
Route::post('add/books/from/user/books', [CartController::class, 'removedBooksFromCartAndAddToUserBooks']);

