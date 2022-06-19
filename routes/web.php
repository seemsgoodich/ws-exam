<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Главная
Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('/location', [PageController::class, 'location'])->name('location');
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::get('/orders', [OrderController::class, 'index'])->name('orders');
Route::get('/list', [PageController::class, 'list'])->name('list');
Route::get('/list/{item}', [PageController::class, 'show'])->name('show');

// Вход
Route::prefix('login')->group(function() {
    Route::get('/', [PageController::class, 'login'])->name('login');
    Route::post('/', [AuthController::class, 'login']);
});

// Регистрация
Route::prefix('register')->group(function() {
    Route::get('/', [PageController::class, 'register'])->name('register');
    Route::post('/', [AuthController::class, 'register']);
});

// Руты авторизованного
Route::middleware('auth')->group(function() {
   Route::get('logout', [AuthController::class, 'logout'])->name('logout');


   Route::post('cart/{item}', [CartController::class, 'add'])->name('toCart');
   Route::post('/order/create', [OrderController::class, 'store'])->name('createOrder');
   Route::get('/order/delete/{order}', [OrderController::class, 'delete'])->name('deleteOrder');

   // Руты админа
   Route::middleware('access:admin')->group(function() {
       Route::prefix('admin')->group(function() {
            Route::get('/', [AdminController::class, 'index'])->name('admin');

            Route::prefix('categories')->group(function() {
                Route::get('/', [AdminController::class, 'categories'])->name('admin.categories.index');

                Route::get('/create', [AdminController::class, 'categoriesCreate'])->name('admin.categories.createPage');
                Route::post('/create', [CategoryController::class, 'create'])->name('admin.categories.create');

                Route::get('/delete/{category}', [CategoryController::class, 'delete'])->name('admin.categories.delete');
            });

            Route::prefix('items')->group(function() {
                Route::get('/', [AdminController::class, 'items'])->name('admin.items.index');

                Route::get('/create', [AdminController::class, 'itemsCreate'])->name('admin.items.createPage');
                Route::post('/create', [ItemController::class, 'create'])->name('admin.items.create');

                Route::get('/edit/{item}', [AdminController::class, 'itemsUpdate'])->name('admin.items.updatePage');
                Route::post('/edit/{item}', [ItemController::class, 'edit'])->name('admin.items.edit');

                Route::get('/delete/{item}', [ItemController::class, 'delete'])->name('admin.items.delete');
            });

            Route::prefix('orders')->group(function() {
                Route::get('/', [AdminController::class, 'orders'])->name('admin.orders.index');
                Route::get('cancel/{order}', [OrderController::class, 'cancelOrder'])->name('admin.orders.cancel');
                Route::get('confirm/{order}', [OrderController::class, 'confirmOrder'])->name('admin.orders.confirm');
            });
       });
   });
});
