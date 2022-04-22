<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LogsController;
use App\Http\Controllers\DelayedReplyController;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Artisan;

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
    Route::post('/order/{order_id}/assign',[OrderController::class,'assignOrder']) -> name ('assign.order');
    Route::resource('logs', LogsController::class);


    Route::get('/admin-dashboard', function () {
        return view('admin.dashboard');
    });

});
//CronJbs  Route for Notifying Admin
Route::get('/notification', function () {
    Artisan::call('send:notification');
});




require __DIR__.'/auth.php';
