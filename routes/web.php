<?php

use App\Http\Controllers\ActionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\MainPageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
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

Route::get('/', [MainPageController::class, 'index'])->name('main');
Route::get('/admin', [AdminController::class, 'panel'])->name('admin')->middleware(['auth', 'admin']);

Route::controller(ProductController::class)->group(function () {
    Route::get('/products', 'index')->name('products')->middleware(['auth', 'admin']);
    Route::post('/products', 'store')->name('products.store')->middleware(['auth', 'admin']);
    Route::get('/products/create', 'create')->name('products.create')->middleware(['auth', 'admin']);
    Route::get('/products/{product}', 'show')->name('products.show');
    Route::get('/products/{product}/edit', 'edit')->name('products.edit');
    Route::put('/products/{product}/update', 'update')->name('products.update');
    Route::delete('/products/{product}', 'destroy')->name('products.destroy');
});

Route::controller(CategoryController::class)->group(function () {
    Route::get('/categories', 'index')->name('categories')->middleware(['auth', 'admin']);
    Route::post('/categories', 'store')->name('categories.store')->middleware(['auth', 'admin']);
    Route::get('/categories/create', 'create')->name('categories.create')->middleware(['auth', 'admin']);
    Route::get('/categories/{category}/edit', 'edit')->name('categories.edit')->middleware(['auth', 'admin']);
    Route::put('/categories/{category}', 'update')->name('categories.update')->middleware(['auth', 'admin']);
    Route::delete('/categories/{category}', 'destroy')->name('categories.destroy')->middleware(['auth', 'admin']);
});

Route::controller(CartController::class)->group(function () {
    Route::get('/cart', 'index')->name('cart')->middleware('auth');
    Route::post('/cart/add/{product}', 'add')->name('cart.add')->middleware('auth');
    Route::put('/cart/increase/{product}', 'increase')->name('cart.increase')->middleware('auth');
    Route::put('/cart/decrease/{product}', 'decrease')->name('cart.decrease')->middleware('auth');
    Route::put('/cart/remove/{product}', 'remove')->name('cart.remove')->middleware('auth');
    Route::delete('/cart', 'clear')->name('cart.clear')->middleware('auth');
});

Route::controller(OrderController::class)->group(function () {
    Route::get('/orders', 'index')->name('orders')->middleware(['auth', 'admin']);
    Route::get('/orders/cteate', 'create')->name('orders.create')->middleware('auth');
    Route::post('/orders', 'store')->name('orders.store')->middleware('auth');
    Route::put('/orders/delivered/{order}', 'delivered')->name('orders.delivered')->middleware(['auth', 'admin']);
    Route::put('/orders/paid/{order}', 'paid')->name('orders.paid')->middleware(['auth', 'admin']);
    Route::put('/orders/cancel/{order}', 'cancel')->name('orders.cancel')->middleware(['auth', 'admin']);
});

Route::controller(UserController::class)->group(function () {
    Route::get('/profile', 'profile')->name('profile')->middleware('auth');
    Route::get('/profile/orders', 'orders')->name('profile.orders')->middleware('auth');
    Route::put('/profile', 'update')->name('profile.update')->middleware('auth');
    Route::get('/fav', [UserController::class, 'favourites'])->name('favourite')->middleware('auth');
    Route::post('/fav', [UserController::class, 'addFavourites'])->name('favourite.store')->middleware('auth');
    Route::delete('/fav/{product}', [UserController::class, 'removeFavourites'])->name('favourite.remove')->middleware('auth');
});

Route::post('/feedbacks/{product}', [FeedbackController::class, 'store'])->name('feedbacks.store')->middleware('auth');

Route::controller(ActionController::class)->group(function () {
    Route::get('/actions', 'index')->name('actions')->middleware(['auth', 'admin']);
    Route::get('/actions/create', 'create')->name('actions.create')->middleware(['auth', 'admin']);
    Route::post('/actions', 'store')->name('actions.store')->middleware(['auth', 'admin']);
    Route::put('/actions/on/{action}', 'on')->name('actions.on')->middleware(['auth', 'admin']);
    Route::put('/actions/off/{action}', 'off')->name('actions.off')->middleware(['auth', 'admin']);
});
