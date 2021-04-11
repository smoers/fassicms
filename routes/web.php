<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\CraneController;
use App\Http\Controllers\ReassortController;
use App\Http\Controllers\OutController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OutWorksheetController;
use App\Http\Controllers\WorksheetController;
use App\Http\Controllers\ClockingController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\TechnicianController;

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

//Auth::routes();

Route::get('/login',[LoginController::class,'showLoginForm'])->name(('login'));
Route::post('/login',[LoginController::class,'login']);
Route::post('/logout',[LoginController::class,'logout'])->name('logout');

Route::get('/permissions',[PermissionController::class,'add'])->name('permissions.add');

Route::group(['middleware' => ['role_or_permission:admin','auth']],function (){


    Route::get('/', function () {
        return redirect()->route('dashboard');
    })->name('main');

    /**
     * Dashboard Controller
     */
    Route::get('/dashboard', [DashboardController::class, 'index'])->name("dashboard");
    Route::get('/home', [DashboardController::class, 'index'])->name("home");
    /**
     * Crane Controller
     */
    Route::get('/crane',[CraneController::class,'index'])->name('crane.index');
    Route::get('/crane/create',[CraneController::class,'create'])->name('crane.create');
    Route::get('/crane/{id}/edit',[CraneController::class,'edit'])->name('crane.edit');
    Route::post('/crane/store',[CraneController::class,'store'])->name('crane.store');
    Route::post('/crane/{id}/update',[CraneController::class,'update'])->name('crane.update');
    Route::post('/crane/ajaxvalidation',[CraneController::class,'ajaxValidation'])->name('crane.ajaxvalidation');

    /**
     * Store Controller
     */
    Route::get('store',[StoreController::class,'index'])->name('store.index');
    Route::get('/store/create',[StoreController::class,'create'])->name('store.create');
    Route::post('/store/store',[StoreController::class,'store'])->name('store.store');
    Route::post('/store/update',[StoreController::class,'update'])->name('store.update');
    Route::get('/store/{id}/{cat_id}/edit',[StoreController::class,'edit'])->name('store.edit');
    Route::post('/store/ajaxvalidation',[StoreController::class,'ajaxValidation'])->name('store.ajaxvalidation');
    Route::get('/store/{id}/bs',[StoreController::class,'barcodeSticker'])->name('store.barcode_sticker');

    /**
     * Reassort Controller
     */
    Route::get('/reassort',[ReassortController::class,'index'])->name('reassort.index');
    Route::get('/reassort/{id}/edit',[ReassortController::class,'edit'])->name('reassort.edit');
    Route::post('/reassort/update',[ReassortController::class,'update'])->name('reassort.update');
    Route::post('/reassort/ajaxvalidation',[ReassortController::class,'ajaxValidation'])->name('reassort.ajaxvalidation');

    /**
     * Out Controller
     */
    Route::get('/out/{id}/edit',[OutController::class,'edit'])->name('out.edit');
    Route::post('/out/update',[OutController::class,'update'])->name('out.update');
    Route::post('/out/ajaxvalidation',[OutController::class,'ajaxValidation'])->name('out.ajaxvalidation');

    /**
     * Customer Controller
     */
    Route::get('/customer',[CustomerController::class,'index'])->name('customer.index');
    Route::get('/customer/create',[CustomerController::class,'create'])->name('customer.create');
    Route::get('/customer/{id}/edit',[CustomerController::class,'edit'])->name('customer.edit');
    Route::post('/customer/store',[CustomerController::class,'store'])->name('customer.store');
    Route::post('/customer/{id}/update',[CustomerController::class,'update'])->name('customer.update');
    Route::post('/customer/ajaxvalidation',[CustomerController::class,'ajaxValidation'])->name('customer.ajaxvalidation');
    Route::post('/customer/ajaxselect',[CustomerController::class,'ajaxSelect'])->name('customer.ajaxselect');

    /**
     * OutWorksheet Controller
     */
    Route::get('/outworksheet/in',[OutWorksheetController::class,'in'])->name('outworksheet.in');
    Route::get('/outworksheet/out',[OutWorksheetController::class,'out'])->name('outworksheet.out');
    Route::post('/outworksheet/in',[OutWorksheetController::class,'inTreatment'])->name('outworksheet.intreatment');
    Route::post('/outworksheet/out',[OutWorksheetController::class,'outTreatment'])->name('outworksheet.outtreatment');
    Route::post('/outworksheet/ajaxworksheetcheck',[OutWorksheetController::class,'ajaxWorksheetCheck'])->name('outworksheet.ajaxworksheetcheck');
    Route::post('/outworksheet/ajaxpartcheck',[OutWorksheetController::class,'ajaxPartCheck'])->name('outworksheet.ajaxpartcheck');
    Route::post('/outworksheet/ajaxpartcheckout',[OutWorksheetController::class,'ajaxPartCheckOut'])->name('outworksheet.ajaxpartcheckout');
    Route::post('/outworksheet/ajaxpartqtycheck',[OutWorksheetController::class,'ajaxPartQtyCheck'])->name('outworksheet.ajaxpartqtycheck');

    /**
     * Worksheet Controller
     */
    Route::get('/worksheet/index',[WorksheetController::class,'index'])->name('worksheet.index');
    Route::get('/worksheet/create',[WorksheetController::class,'create'])->name('worksheet.create');
    Route::get('/worksheet/{id}/edit',[WorksheetController::class,'edit'])->name('worksheet.edit');
    Route::get('/worksheet/{id}/part',[WorksheetController::class,'partConsult'])->name('worksheet.part');
    Route::post('/worksheet/print',[WorksheetController::class,'print'])->name('worksheet.print');
    Route::post('/worksheet/store',[worksheetController::class,'store'])->name('worksheet.store');
    Route::post('/worksheet/{id}/update',[worksheetController::class,'update'])->name('worksheet.update');
    Route::post('/worksheet/ajaxselect',[WorksheetController::class,'ajaxSelect'])->name('worksheet.ajaxselect');
    Route::post('/worksheet/ajaxvalidation',[WorksheetController::class,'ajaxValidation'])->name('worksheet.ajaxvalidation');
    Route::post('/worksheet/addoption',[WorksheetController::class,'addOption'])->name('worksheet.add.option');

    /**
     * Clocking Controller
     */
    Route::get('/clocking/{id}/edit',[ClockingController::class,'edit'])->name('clocking.edit');
    Route::get('/clocking/{id}/show',[ClockingController::class,'show'])->name('clocking.show');
    Route::get('/clocking/clockingtechnician',[ClockingController::class,'ClockingTechnician'])->name('clocking.technician');
    Route::post('/clocking/{id}/update',[ClockingController::class,'update'])->name('clocking.update');
    Route::post('/clocking/ajaxworksheetcheck',[ClockingController::class,'ajaxWorksheetCheck'])->name('clocking.ajaxworksheetcheck');
    Route::post('/clocking/ajaxtechniciancheck',[ClockingController::class,'ajaxTechnicianCheck'])->name('clocking.ajaxtechniciancheck');

    /**
     * Technician Controller
     */
    Route::get('/technician',[TechnicianController::class,'index'])->name('technician.index');
    Route::get('/technician/create',[TechnicianController::class,'create'])->name('technician.create');
    Route::get('/technician/{id}/edit',[TechnicianController::class,'edit'])->name('technician.edit');
    Route::post('/technician/store',[TechnicianController::class,'store'])->name('technician.store');
    Route::post('/technician/{id}/update',[TechnicianController::class,'update'])->name('technician.update');
    Route::post('/technician/ajaxvalidation',[TechnicianController::class,'ajaxValidation'])->name('technician.ajaxvalidation');
    Route::post('/technician/ajaxnamecheck',[TechnicianController::class,'ajaxNameCheck'])->name('technician.ajaxnamecheck');

});

