<?php

use App\Http\Controllers\api\CartController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotifcationsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SlideShowController;
use App\Http\Controllers\subscriptionController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'show'])->name('home');
Route::get('/authors/{id}', [HomeController::class, 'author'])->name('author');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [UsersController::class, 'profile'])->name('profile');
    Route::delete('/profile/delete', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['middleware' => ['auth', 'UserAdmin'], 'prefix' => 'admin'], function () {
    // this is admin dashboard home page
    Route::get('/', [HomeController::class, 'index'])->name('home.dashboard');

    Route::resource('users', UsersController::class);
    Route::post('users/{user}/addBooks', [UsersController::class, 'addBooksFromUser'])->name('users.addBooks');
    Route::get('users/{user}/books', [UsersController::class, 'showBook'])->name('users.books');
    Route::delete('/users/{userId}/books/{bookId}', [UsersController::class, 'destroyBook'])->name('user.book.destroy');
    Route::post('/users/{user}/add-author-publisher', [UsersController::class, 'addAuthorAndPublisherFromUser'])->name('users.addAuthorAndPublisher');
    Route::patch('/users/{user}/toggle-active', [UsersController::class, 'toggleActive'])->name('users.toggleActive');
    Route::patch('/users/{user}/toggle-verified', [UsersController::class, 'toggleVerified'])->name('users.toggleVerified');

    Route::resource('roles', RoleController::class);

    Route::resource('categories', CategoryController::class);
    Route::post('/categories/update-order', [CategoryController::class, 'updateOrder'])->name('categories.updateOrder');

    Route::get('/categories/{id}/books', [BookController::class, 'showBooks'])->name('categories.books');
    Route::post('/categories/{id}/books/update-order', [BookController::class, 'updateBooksOrder'])->name('categories.books.updateOrder');

    Route::resource('author', AuthorController::class);

    Route::resource('publishers', PublisherController::class);
    Route::get('/publishers/analysis/{publisher}', [PublisherController::class, 'analysis'])->name('publishers.analysis');

    Route::resource('books', BookController::class);
    Route::put('books/{id}/toggle-activation', [BookController::class, 'toggleActivation'])->name('books.toggleActivation');
    Route::get('/api/subcategories/{category_id}', function ($category_id) {
        $subcategories = \App\Models\Subcategory::where('category_id', $category_id)->pluck('name', 'id');
        return response()->json($subcategories);
    });
    Route::post('books/{id}/toggle-activation', [BookController::class, 'toggleActivation'])->name('books.toggleActivation');
    Route::delete('books/translator/{translatorId}', [BookController::class, 'deleteBookTranslator'])->name('books.deleteTranslator');
    Route::post('books/update-order/{categoryId}', [BookController::class, 'updateBooksOrder'])->name('books.updateOrder');

    Route::resource('coupons', CouponController::class);
    Route::post('coupons/delete', [CouponController::class, 'deleteCoupons'])->name('coupons.deleteCoupons');
    Route::get('coupons/book/{bookId}', [CouponController::class, 'bookCoupon'])->name('coupons.bookCoupons');
    Route::get('coupons/subscription/{id}', [CouponController::class, 'showSubscriptionCoupons'])->name('coupons.subscriptionCoupons');

    Route::resource('slides', SlideShowController::class);
    Route::resource('notifcations', NotifcationsController::class);

    Route::resource('subscriptions', subscriptionController::class);
    Route::get('subscriptions/{subscription}/users', [subscriptionController::class, 'manageUsers'])->name('subscriptions.users');
    Route::post('subscriptions/{subscription}/add-user', [subscriptionController::class, 'addUser'])->name('subscriptions.addUser');
    Route::post('/subscriptions/{subscription}/remove-user', [SubscriptionController::class, 'removeUser'])->name('subscriptions.removeUser');
    Route::post('/subscriptions/{subscription}/renew/{user}', [SubscriptionController::class, 'renewUser'])->name('subscriptions.renewUser');

    Route::resource('posts', PostController::class);
});

//payment pages
Route::get('payment/page/successfuly/{userId}/{type}/{subscriptionId?}', [CartController::class, 'removedBooksFromCartAndAddToUserBooks'])->name('payment.page.successfuly');


require __DIR__ . '/web/auth.php';
