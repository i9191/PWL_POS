<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
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

Route::get('/', [HomeController::class,'index']);
Route::prefix('category')->group(function () {
    Route::get('/food-beverage', 
        [ProductController::Class,'foodProductView']
    );
    Route::get('/beauty-health', 
        [ProductController::Class,'beautyhealthProductView']
    );
    Route::get('/home-care', 
        [ProductController::Class,'homeProductView']
    );
    Route::get('/baby-kid', 
        [ProductController::Class,'babyProductView']
    );
});
Route::get('/user/{id}/name/{name}', [UserController::class,'profile']);
Route::get('/transaction', [TransactionController::class,'transactionView']);