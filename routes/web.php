<?php

use App\Http\Controllers\api\BookRatingController;
use App\Http\Controllers\api\CartController;
use App\Http\Controllers\api\SuggestBookController;
use App\Http\Controllers\AppSettingController;
use App\Http\Controllers\Auth\GoogleLoginController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookDashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InstructionController;
use App\Http\Controllers\NotifcationsController;
use App\Http\Controllers\Payment\paymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\SlideShowController;
use App\Http\Controllers\SubcategoryController;
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

Route::get('/login/google', [GoogleLoginController::class, 'redirectToGoogle'])->name("login.google");
Route::get('/login/callback', [GoogleLoginController::class, 'handleGoogleCallback']);


Route::get('/cart', [ShoppingCartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{productId}', [ShoppingCartController::class, 'addToCart'])->name('cart.add');
Route::patch('/cart/update/{cartId}', [ShoppingCartController::class, 'updateCart'])->name('cart.update');
Route::delete('/cart/remove/{cartId}', [ShoppingCartController::class, 'removeFromCart'])->name('cart.remove');


Route::middleware('UserAdmin')->group(function () {

    // Dashboards
    Route::get('/dashboard/books', [BookDashboardController::class, 'index'])->name('dashboard.books');


    Route::get('/authors', [BookDashboardController::class, 'getAuthors'])->name('getAuthors');
    Route::get('/publishers', [BookDashboardController::class, 'getPublishers'])->name('getPublishers');


    // Categories
    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/categories/updateOrder', [CategoryController::class, 'updateOrder'])->name('categories.updateOrder');
    Route::post('/category/save', [CategoryController::class, 'save'])->name('category.save');
    Route::get('/category/edit/{category}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('/category/update/{category}', [CategoryController::class, 'update'])->name('category.update');
    Route::get('/category/show/{category}', [CategoryController::class, 'show'])->name('category.show');
    Route::delete('/category/delete/{category}', [CategoryController::class, 'delete'])->name('category.delete');

    // Subcategories
    Route::get('/subcategory', [SubcategoryController::class, 'index'])->name('subcategory.index');
    Route::get('/subcategory/create', [SubcategoryController::class, 'create'])->name('subcategory.create');
    Route::post('/subcategory/save', [SubcategoryController::class, 'save'])->name('subcategory.save');
    Route::get('/subcategory/edit/{category}', [SubcategoryController::class, 'edit'])->name('subcategory.edit');
    Route::put('/subcategory/update/{category}', [SubcategoryController::class, 'update'])->name('subcategory.update');
    Route::get('/subcategory/show/{category}', [SubcategoryController::class, 'show'])->name('subcategory.show');
    Route::delete('/subcategory/delete/{category}', [SubcategoryController::class, 'delete'])->name('subcategory.delete');

    // Authors
    Route::get('/author', [AuthorController::class, 'index'])->name('author.index');
    Route::get('/author/create', [AuthorController::class, 'create'])->name('author.create');
    Route::post('/author/save', [AuthorController::class, 'save'])->name('author.save');
    Route::get('/author/edit/{author}', [AuthorController::class, 'edit'])->name('author.edit');
    Route::put('/author/update/{author}', [AuthorController::class, 'update'])->name('author.update');
    Route::get('/author/show/{author}', [AuthorController::class, 'show'])->name('author.show');
    Route::delete('/author/delete/{author}', [AuthorController::class, 'delete'])->name('author.delete');
    Route::POST('/author/search', [AuthorController::class, 'searchSelect'])->name('author.searchSelect');

    // Publishers
    Route::get('/publisher', [PublisherController::class, 'index'])->name('publisher.index');
    Route::get('/publisher/create', [PublisherController::class, 'create'])->name('publisher.create');
    Route::post('/publisher/save', [PublisherController::class, 'save'])->name('publisher.save');
    Route::get('/publisher/edit/{publisher}', [PublisherController::class, 'edit'])->name('publisher.edit');
    Route::put('/publisher/update/{publisher}', [PublisherController::class, 'update'])->name('publisher.update');
    Route::get('/publisher/show/{publisher}', [PublisherController::class, 'show'])->name('publisher.show');
    Route::delete('/publisher/delete/{publisher}', [PublisherController::class, 'delete'])->name('publisher.delete');
    Route::POST('/publisher/search', [PublisherController::class, 'searchSelect'])->name('publisher.searchSelect');


    // Books
    Route::get('/book', [BookController::class, 'index'])->name('book.index');
    Route::get('/book/create', [BookController::class, 'create'])->name('book.create');
    Route::post('/book/save', [BookController::class, 'save'])->name('book.save');
    Route::get('/book/edit/{book}', [BookController::class, 'edit'])->name('book.edit');
    Route::put('/book/update/{book}', [BookController::class, 'update'])->name('book.update');
    Route::get('/book/show/{book}', [BookController::class, 'show'])->name('book.show');
    Route::delete('/book/delete/{book}', [BookController::class, 'delete'])->name('book.delete');
    Route::get('/book/search/{search}', [BookController::class, 'searchSelect'])->name('book.searchSelect');

    //Book sold data
    Route::get('/books/sold', [BookDashboardController::class, 'bookSold'])->name('book.sold');
    Route::get('/book/sold/details/{bookId}', [BookDashboardController::class, 'soldBookDetails'])->name('book.sold.details');
    //Coupons 
    Route::get('/coupons', [CouponController::class, 'index'])->name('coupons.index');
    Route::post('/coupon/store', [CouponController::class, 'store'])->name('coupon.store');
    Route::delete('/coupons/delete', [CouponController::class, 'deleteCoupons'])->name('coupons.delete');
    Route::get('/book/coupons/{bookId}', [CouponController::class, 'bookCoupon'])->name('book.coupons');

    //users information
    Route::get('users', [UsersController::class, 'index'])->name('users.index');
    Route::get('users/{userId}', [UsersController::class, 'showBook'])->name('user.show.books');
    Route::post('user/update/{userId}/', [UsersController::class, 'update'])->name('user.update');
    Route::post('users/{userId}/books/{bookId}', [UsersController::class, 'destroyBook'])->name('user.books.destroy');
    Route::post('users/delete/{userId}', [UsersController::class, 'delete'])->name('user.delete');
    Route::post('users/add/books', [UsersController::class, 'addBookFromUser'])->name('user.addBooks');
    Route::post('add/new/user', [UsersController::class, 'addNewUser'])->name('add.newUser');
    Route::post('update/user/role/{userId}', [UsersController::class, 'updateUserRole'])->name('update.user.role');
    Route::post('user/add/author/publisher/{userId}', [UsersController::class, 'addAuthorAndPublisherFromUser'])->name('user.addAuthorAndPublisher');
    Route::get('user/author/publisher/{userId}', [UsersController::class, 'getAuthorAndPublisherFromUser'])->name('user.AuthorAndPublisher');

    //slideShow 
    Route::get('slide/show', [SlideShowController::class, 'index'])->name('index.slide');
    Route::post('create/slide/show', [SlideShowController::class, 'store'])->name('upload.slide');
    Route::post('delete/slide/show/{slideId}', [SlideShowController::class, 'delete'])->name('delete.slide');

    //notification 
    Route::get('notification/show', [NotifcationsController::class, 'index'])->name('index.notification');
    Route::post('notification/upload', [NotifcationsController::class, 'store'])->name('upload.notification');
    Route::post('notification/destroy/{notificationId}', [NotifcationsController::class, 'destroy'])->name('destroy.notification');

    //feedBack Crud
    Route::get('contact/us/show', [ContactUsController::class, 'index'])->name('index.contactUs');
    Route::post('contact/us/delete/{contactId}', [ContactUsController::class, 'destroy'])->name('destroy.contact');

    //App Setting
    Route::get('app/setting/show', [AppSettingController::class, 'index'])->name('index.appSetting');
    Route::post('app/setting/store', [AppSettingController::class, 'store'])->name('app-settings.store');
    Route::post('app/setting/update/{id}', [AppSettingController::class, 'update'])->name('app-settings.update');


    //instructions
    Route::resource('instructions', InstructionController::class);

    //payment
    Route::get('payment', [paymentController::class, 'index'])->name('payment.index');
    Route::post('payment/store', [paymentController::class, 'store'])->name('payments.store');
    Route::post('payment/update/{payment}', [paymentController::class, 'update'])->name('payments.update');
    Route::delete('payment/destroy/{payment}', [paymentController::class, 'destroy'])->name('payments.destroy');


    //this route suggest book
    Route::get('suggest/book', [SuggestBookController::class, 'index'])->name('suggest.book.index');
    Route::delete('suggest/book/destroy/{suggestBook}', [SuggestBookController::class, 'destroy'])->name('suggest.book.destroy');

    //this route rating book
    Route::get('rating/book', [BookRatingController::class, 'index'])->name('rating.book.index');
    Route::delete('rating/book/destroy/{ratingBook}', [BookRatingController::class, 'destroy'])->name('rating.book.destroy');

    //this route chat
    Route::get('chats/{userId}', [ChatController::class, 'index'])->name('chats.index');
    Route::get('users/chats/show', [ChatController::class, 'users'])->name('chats.users');
    Route::post('chats', [ChatController::class, 'store'])->name('chats.store');
    Route::put('chats/{id}', [ChatController::class, 'update'])->name('chats.update');
    Route::delete('chats/{id}', [ChatController::class, 'destroy'])->name('chats.destroy');

});

//payment pages
Route::get('payment/page/successfuly/{userId}', [CartController::class, 'removedBooksFromCartAndAddToUserBooks'])->name('payment.page.successfuly');

//public books
Route::get('/book/view/{book}', [BookController::class, 'view'])->name('book.view');
Route::get('/book/search', [BookController::class, 'search'])->name('book.search');
Route::POST('/book/search', [BookController::class, 'search2'])->name('book.search2');

require __DIR__ . '/auth.php';
