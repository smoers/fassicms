<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\CraneController;
use App\Http\Controllers\ReassortController;
use App\Http\Controllers\OutController;
use App\Http\Controllers\CustomerController;
use \App\Http\Controllers\OutWorksheetController;

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

Auth::routes();

Route::get('/permissions',[PermissionController::class,'add'])->name('permissions.add');

Route::group(['middleware' => ['role_or_permission:admin','auth']],function (){
    Route::get('/', function () {
        return redirect()->route('dashboard');
    })->name('main');
    //Dashboard Controller
    Route::get('/dashboard', [DashboardController::class, 'index'])->name("dashboard");
    //Crane Controller
    Route::resource('crane', CraneController::class);
    //Store Controller
    Route::get('store',[StoreController::class,'index'])->name('store.index');
    Route::get('/store/create',[StoreController::class,'create'])->name('store.create');
    Route::post('/store',[StoreController::class,'store'])->name('store.store');
    Route::post('/store/update',[StoreController::class,'update'])->name('store.update');
    Route::get('/store/{id}/{cat_id}/edit',[StoreController::class,'edit'])->name('store.edit');
    Route::post('/store/ajaxvalidation',[StoreController::class,'ajaxValidation'])->name('store.ajaxvalidation');
    //Reassort Controller
    Route::get('/reassort',[ReassortController::class,'index'])->name('reassort.index');
    Route::get('/reassort/{id}/edit',[ReassortController::class,'edit'])->name('reassort.edit');
    Route::post('/reassort/update',[ReassortController::class,'update'])->name('reassort.update');
    Route::post('/reassort/ajaxvalidation',[ReassortController::class,'ajaxValidation'])->name('reassort.ajaxvalidation');
    //Out Controller
    Route::get('/out/{id}/edit',[OutController::class,'edit'])->name('out.edit');
    Route::post('/out/update',[OutController::class,'update'])->name('out.update');
    Route::post('/out/ajaxvalidation',[OutController::class,'ajaxValidation'])->name('out.ajaxvalidation');
    //Customer Controller
    Route::get('/customer/create',[CustomerController::class,'create'])->name('customer.create');
    Route::post('/customer/store',[CustomerController::class,'store'])->name('customer.store');
    Route::post('/customer/ajaxvalidation',[CustomerController::class,'ajaxValidation'])->name('customer.ajaxvalidation');
    Route::post('/customer/ajaxselect',[CustomerController::class,'ajaxSelect'])->name('customer.ajaxselect');
    //OutWorksheet Controller
    Route::get('/outworksheet',[OutWorksheetController::class,'index'])->name('outworksheet.index');
    Route::post('/outworksheet/out',[OutWorksheetController::class,'out'])->name('outworksheet.out');
    Route::post('/outworksheet/treatment',[OutWorksheetController::class,'treatment'])->name('outworksheet.treatment');
    Route::post('/outworksheet/validation',[OutWorksheetController::class,'validation'])->name('outworksheet.validation');
    Route::post('/outworksheet/ajaxvalidation',[OutWorksheetController::class,'ajaxValidation'])->name('outworksheet.ajaxvalidation');

    Route::get('/store/bs',[StoreController::class,'barcodeSticker'])->name('store.barcode_sticker');

});

