<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LogsController;

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
Route::middleware(['auth'])->group(function () {
    Route::get('/',[DashboardController::class,'index']);
    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');

    ## ORDER ROUTES ##
    Route::any('search-order',[OrderController::class,'search'])->name('search-order');
    Route::resource('logs', LogsController::class);
});



require __DIR__.'/auth.php';
