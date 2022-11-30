<?php

use App\Http\Controllers\Apps\CategoryController;
use App\Http\Controllers\Apps\CustomerController;
use App\Http\Controllers\Apps\DashboardController;
use App\Http\Controllers\Apps\ProductController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});

Route::group(['prefix' => 'app', 'as' => 'app.', 'middleware' => ['auth']], function(){
    // dashboard route
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    // category route
    Route::resource('/category', CategoryController::class)->except('create','show','edit');
    // customer route
    Route::resource('/customer', CustomerController::class)->except('create','show','edit');
    // product route
    Route::post('/product/delete-selected', [ProductController::class, 'destroySelected'])->name('product.selected');
    Route::resource('/product', ProductController::class);
});
