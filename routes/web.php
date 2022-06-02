<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LogsController;
use App\Http\Controllers\DelayedReplyController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\ComplainController;
use App\Http\Controllers\ReturnOrderController;
use \App\Http\Controllers\UserController;
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

    Route::get('/admin-dashboard',[ReportsController::class,'index']);
    Route::get('/dailyReports',[ReportsController::class,'dailyReports']);


    Route::get('/progress-report',[ComplainController::class,'index']);
    Route::post('complain',[ComplainController::class,'store']);



    //userdashboard
    Route::get('/user_dashboard',[UserController::class,'index']);


    //For Generating Report
    Route::get('/generateReport',[ComplainController::class,'generateReport']);

    //For return/replace
    Route::post('/returnOrder',[ReturnOrderController::class,'store']);
    Route::get('/returnReplacement',[ReturnOrderController::class,'show']);
    Route::get('/returnOrderReport',[ReturnOrderController::class,'returnOrderReport']);

});



//CronJbs  Route for Notifying Admin
Route::get('/notification', function () {
    Artisan::call('send:notification');
});

Route::get('/test',[ReportsController::class,'test']);


require __DIR__.'/auth.php';
