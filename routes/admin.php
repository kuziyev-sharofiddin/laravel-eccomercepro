<?php

use App\Http\Controllers\Admin\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\ProductController;


// Admin  Category
Route::get('/category/view', [CategoryController::class, 'viewCategory'])->name('view_category');
Route::post('/category/store', [CategoryController::class, 'addCategory'])->name('add_category');
Route::delete('/category/{category}/delete', [CategoryController::class, 'deleteCategory'])->name('delete_category');



// Admin Contact
Route::delete('/contact/{contact}/delete', [ContactController::class, 'contactDestroy'])->name('contact_destroy');
Route::get('/contacts', [ContactController::class, 'contact'])->name('contacts');

// Admin Order
Route::get('/orders', [OrderController::class, 'getOrderSearch'])->name('order');
Route::get('/delivered/{order}', [OrderController::class, 'delivered'])->name('delivered');

// Admin  Product
Route::resources(['products' => ProductController::class,]);
