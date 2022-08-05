<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\MenuController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\TableController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\Frontend\WelcomeController;
use App\Http\Controllers\admin\ReservationController;
use App\Http\Controllers\Frontend\FrontendMenuController;
use App\Http\Controllers\admin\ReservationInputsController;
use App\Http\Controllers\Frontend\FrontendCategoryController;
use App\Http\Controllers\Frontend\FrontendReservationController;

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

Route::get('/',[WelcomeController::class,'index']);

Route::get('/categories',[FrontendCategoryController::class,'index'])->name('category.index');
Route::get('/categories/{category}',[FrontendCategoryController::class,'show'])->name('category.show');

Route::get('/menus',[FrontendMenuController::class,'index'])->name('menu.index');
Route::get('/menus/{menu}',[FrontendMenuController::class,'show'])->name('menu.show');

Route::get('/reservation/step-one',[FrontendReservationController::class,'stepOne'])->name('reservation.stepOne');
// Route::get('/reservation/step-two',[FrontendReservationController::class,'stepTwo'])->name('reservation.stepTwo');
Route::get('/reservation/verifyDate',[ReservationInputsController::class,'verifyDate'])->name('reservation.verifyDate');
Route::get('/reservation/verifyMeal',[ReservationInputsController::class,'verifyMeal'])->name('reservation.verifyMeal');
Route::post('/reservation/step-one/store',[FrontendReservationController::class,'store'])->name('reservation.store');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::middleware(['auth','admin'])->name('admin.')->prefix('admin')->group(function(){
    Route::get('/',[AdminController::class,'index'])->name('index');
    Route::resource('/categories',CategoryController::class);
    Route::resource('/menus',MenuController::class);
    Route::resource('/tables',TableController::class);
    // Route::post('/reservations/create/verification',[ReservationController::class,'store'])->name('verification');
    Route::resource('/reservations',ReservationController::class);
    Route::get('/reservation/verifyDate',[ReservationInputsController::class,'verifyDate'])->name('reservation.verifyDate');
    Route::get('/reservation/verifyMeal',[ReservationInputsController::class,'verifyMeal'])->name('reservation.verifyMeal');

});


require __DIR__.'/auth.php';
