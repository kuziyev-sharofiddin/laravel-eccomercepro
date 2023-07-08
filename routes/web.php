<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;


Route::get('/', [HomeController::class, 'index']);

Route::get('/redirect', [HomeController::class, 'redirect'])->name('redirect')->middleware('auth', 'verified');
Route::get('/product_details/{product}', [HomeController::class, 'product_details'])->name('product_details');
Route::post('/add_cart/{product}', [HomeController::class, 'add_cart'])->name('add_cart');
Route::get('/show_cart', [HomeController::class, 'show_cart'])->name('show_cart');
Route::get('/remove_cart/{cart}', [HomeController::class, 'remove_cart'])->name('remove_cart');
Route::get('/cash_order', [HomeController::class, 'cash_order'])->name('cash_order');
Route::get('/stripe/{totalprice}', [HomeController::class, 'stripe'])->name('stripe');
Route::post('/stripe/{totalprice}', [HomeController::class, 'stripePost'])->name('stripe.post');
Route::get('/cancel_order/{order}', [HomeController::class, 'cancel_order'])->name('cancel_order');
Route::post('/add_comment', [HomeController::class, 'add_comment'])->name('add_comment');
Route::post('/add_reply', [HomeController::class, 'add_reply'])->name('add_reply');
Route::get('/product_search', [HomeController::class, 'product_search'])->name('product_search');
Route::get('/search_product', [HomeController::class, 'search_product'])->name('search_product');
Route::get('/productss', [HomeController::class, 'products'])->name('productss');
Route::get('/show_order', [HomeController::class, 'show_order'])->name('show_order');
Route::get('/view_category', [AdminController::class, 'view_category'])->name('view_category');
Route::post('/add_category', [AdminController::class, 'add_category'])->name('add_category');
Route::delete('/delete_category/{category}', [AdminController::class, 'delete_category'])->name('delete_category');
Route::get('/order', [AdminController::class, 'order'])->name('order');
Route::get('/delivered/{order}', [AdminController::class, 'delivered'])->name('delivered');
Route::get('/print_pdf/{order}', [AdminController::class, 'print_pdf'])->name('print_pdf');
Route::get('/search', [AdminController::class, 'search'])->name('search');
Route::resources([
    'products' => ProductController::class,

]);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});



