<?php
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReplyController;

// Authentication
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register_store', [AuthController::class, 'register_store'])->name('register.store');


// Contact
Route::get('/contact', [ContactController::class, 'contact'])->name('contact');
Route::post('/contact/store', [ContactController::class, 'contactStore'])->name('contact_store');

// Product
Route::get('/products', [ProductController::class, 'searchProduct'])->name('search_product');
Route::get('/', [ProductController::class, 'searchProduct'])->name('product_search');
Route::get('/{category}/products', [ProductController::class, 'productCategory'])->name('product_category');
Route::get('/product/details/{product}', [ProductController::class, 'productDetails'])->name('product_details');

//Order
Route::get('/show/order', [OrderController::class, 'showOrder'])->name('show_order');
Route::get('/cancel/{order}/order', [OrderController::class, 'cancelOrder'])->name('cancel_order');
Route::get('/cash/order', [OrderController::class, 'cashOrder'])->name('cash_order');

//Reply
Route::post('/reply/add', [ReplyController::class, 'addReply'])->name('add_reply');

//Comment
Route::post('/comment/add', [CommentController::class, 'addComment'])->name('add_comment');

// Cart
Route::post('/add/{product}/cart', [CartController::class, 'addCart'])->name('add_cart');
Route::get('/show/cart', [CartController::class, 'showCart'])->name('show_cart');
Route::get('/cart/{cart}/delete', [CartController::class, 'removeCart'])->name('remove_cart');

// Home
Route::get('/', [HomeController::class, 'index']);


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});



