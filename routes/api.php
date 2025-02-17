<?php

use App\Http\Controllers\api\AppSettingController;
use App\Http\Controllers\api\authController;
use App\Http\Controllers\api\BookRatingController;
use App\Http\Controllers\api\booksController;
use App\Http\Controllers\api\CartController;
use App\Http\Controllers\api\ChatController;
use App\Http\Controllers\api\homeController;
use App\Http\Controllers\api\InstructionController;
use App\Http\Controllers\api\searchController;
use App\Http\Controllers\api\subscriptionController;
use App\Http\Controllers\api\SuggestBookController;
use App\Http\Controllers\api\userFavoriteController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\Payment\paymentController;
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
Route::post('socialAuth', [authController::class, 'socialAuth']);
Route::post('logout', [authController::class, 'logout']);
Route::get('me', [authController::class, 'me']);
Route::get('delete/user', [authController::class, 'deleteUser']);
Route::post('auth/update', [authController::class, 'update']);
Route::post('change/password', [authController::class, 'changePassword']);

//this the home api
Route::get('home/lastadded', [homeController::class, 'lastAdded']);
Route::get('notifications', [homeController::class, 'notifications']);
Route::get('home/slide', [homeController::class, 'slideshow']);
Route::get('home/categories', [homeController::class, 'index']);
Route::get('home/category/{id}', [homeController::class, 'category']);

//this search and coupon
Route::get('search/coupon/{code}', [searchController::class, 'getCouponBook']);
Route::get('search/{term}', [searchController::class, 'searchBooks']);
Route::post('use/coupon', [searchController::class, 'useCoupon']);

Route::get('book/details/{id}', [booksController::class, 'show']);
Route::get('user/data/{type}/{id}', [booksController::class, 'publisherOrAuthor']);

//this create cart and get 
Route::get('user/cart', [CartController::class, 'index']);
Route::post('user/add/cart', [CartController::class, 'addToCart']);
Route::post('user/delete/cart', [CartController::class, 'deleteFromCart']);
Route::get('user/books', [CartController::class, 'userBook']);
Route::post('user/add/free/book', [CartController::class, 'addFreeBookToUserBooks']);
Route::post('gift/book', [CartController::class, 'sendBookAndRemoveInSender']);

//user favorite
Route::get('user/favorite', [userFavoriteController::class, 'favorite']);
Route::post('user/add/favorite', [userFavoriteController::class, 'addForFavorite']);
Route::post('user/delete/favorite', [userFavoriteController::class, 'deleteForFavorite']);

//user feedBack
Route::post('user/feed/back', [ContactUsController::class, 'store']);

//AppSetting
Route::get('/MobileApi', [AppSettingController::class, 'index']);

//instruction
Route::get('/instruction', [InstructionController::class, 'index']);

//test payment
Route::post('/payment/test', [paymentController::class, 'PaymentWeb']);

//payment route
Route::post('/payment/store', [\App\Http\Controllers\api\PaymentController::class, 'store']);

//suggest book
Route::post('/suggest/book', [SuggestBookController::class, 'store']);

//rating book
Route::post('/rating/book', [BookRatingController::class, 'store']);
Route::get('/rating/book/{bookId}', [BookRatingController::class, 'getRatings']);

//chat api
Route::get('/chats', [ChatController::class, 'show']);
Route::post('/chats', [ChatController::class, 'store']);

//this subscription api 
Route::get('/subscriptions', [subscriptionController::class, 'index']);
