<?php

use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReportingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
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

Route::get('/login',[LoginController::class,'showLoginForm'])->name('login');
Route::post('/login',[LoginController::class,'login']);
Route::post('/login/setcookie',[LoginController::class,'setCookie'])->name('login.setcookie');
Route::post('/logout',[LoginController::class,'logout'])->name('logout');

//Route::get('/permissions',[PermissionController::class,'add'])->name('permissions.add');

Route::group(['middleware' => ['auth']],function (){


    Route::get('/', function () {
        return redirect()->route('dashboard');
    })->name('main');

    /**
     * Change Password Controller
     */
    Route::post('/cpassword/current',[ChangePasswordController::class,'ajaxCheckCurrentPassword'])->name('password.checkcurrent')->middleware(['ifnot:password change']);
    Route::post('/cpassword/format',[ChangePasswordController::class,'ajaxCheckFormatPassword'])->name('password.format')->middleware(['ifnot:password change']);
    Route::post('/cpassword/store',[ChangePasswordController::class,'ajaxStorePassword'])->name('password.store')->middleware(['ifnot:password change']);
    /**
     * Dashboard Controller
     */
    Route::get('/dashboard', [DashboardController::class, 'index'])->name("dashboard");
    Route::get('/home', [DashboardController::class, 'index'])->name("home");
    /**
     * Crane Controller
     */
    Route::get('/crane',[CraneController::class,'index'])->name('crane.index')->middleware(['ifnot:list crane']);
    Route::get('/crane/actions',[CraneController::class,'create'])->name('crane.create')->middleware(['ifnot:create crane']);
    Route::get('/crane/{id}/actions',[CraneController::class,'edit'])->name('crane.edit')->middleware(['ifnot:edit crane']);
    //Route::get('/crane/{id}/edit',[CraneController::class,'edit'])->name('crane.edit')->middleware(['ifnot:edit crane']);
    Route::get('/crane/{id}/show',[CraneController::class,'show'])->name('crane.show')->middleware(['ifnot:consult crane']);
    Route::post('/crane/store',[CraneController::class,'store'])->name('crane.store')->middleware(['ifnot:create crane']);
    Route::post('/crane/{id}/update',[CraneController::class,'update'])->name('crane.update')->middleware(['ifnot:edit crane']);
    Route::post('/crane/ajaxvalidation',[CraneController::class,'ajaxValidation'])->name('crane.ajaxvalidation')->middleware(['ifnot:create crane|edit crane']);

    /**
     * Store Controller
     */
    Route::get('store',[StoreController::class,'index'])->name('store.index')->middleware(['ifnot:list catalog']);
    Route::get('/store/create',[StoreController::class,'create'])->name('store.create')->middleware(['ifnot:create catalog']);
    Route::post('/store/store',[StoreController::class,'store'])->name('store.store')->middleware(['ifnot:create catalog']);
    Route::post('/store/update',[StoreController::class,'update'])->name('store.update')->middleware(['ifnot:edit catalog']);
    Route::get('/store/{id}/{cat_id}/edit',[StoreController::class,'edit'])->name('store.edit')->middleware(['ifnot:edit catalog']);
    Route::post('/store/ajaxvalidation',[StoreController::class,'ajaxValidation'])->name('store.ajaxvalidation')->middleware(['ifnot:create catalog|edit catalog']);
    Route::get('/store/{id}/bs',[StoreController::class,'barcodeSticker'])->name('store.barcode_sticker')->middleware(['ifnot:print catalog']);
    Route::get('/store/{id}/show',[StoreController::class,'show'])->name('store.show')->middleware(['ifnot:consult catalog']);

    /**
     * Reassort Controller
     */
    Route::get('/reassort',[ReassortController::class,'index'])->name('reassort.index')->middleware(['ifnot:list stock']);
    Route::get('/reassort/{id}/edit',[ReassortController::class,'edit'])->name('reassort.edit')->middleware(['ifnot:reassort stock']);
    Route::post('/reassort/update',[ReassortController::class,'update'])->name('reassort.update')->middleware(['ifnot:reassort stock']);
    Route::post('/reassort/ajaxvalidation',[ReassortController::class,'ajaxValidation'])->name('reassort.ajaxvalidation')->middleware(['ifnot:reassort stock']);
    Route::post('/reassort/ajaxreassortcheck',[ReassortController::class,'ajaxReassortCheck'])->name('reassort.ajaxreassortcheck')->middleware(['ifnot:reassort stock']);

    /**
     * Out Controller
     */
    Route::get('/out/{id}/edit',[OutController::class,'edit'])->name('out.edit')->middleware(['ifnot:out stock']);
    Route::post('/out/update',[OutController::class,'update'])->name('out.update')->middleware(['ifnot:out stock']);
    Route::post('/out/ajaxvalidation',[OutController::class,'ajaxValidation'])->name('out.ajaxvalidation')->middleware(['ifnot:out stock']);
    Route::post('/out/ajaxoutcheck',[OutController::class,'ajaxOutCheck'])->name('out.ajaxoutcheck')->middleware(['ifnot:out stock']);

    /**
     * Customer Controller
     */
    Route::get('/customer',[CustomerController::class,'index'])->name('customer.index')->middleware(['ifnot:list customer']);
    Route::get('/customer/create',[CustomerController::class,'create'])->name('customer.create')->middleware(['ifnot:create customer']);
    Route::get('/customer/{id}/edit',[CustomerController::class,'edit'])->name('customer.edit')->middleware(['ifnot:edit customer']);
    Route::get('/customer/{id}/show',[CustomerController::class,'show'])->name('customer.show')->middleware(['ifnot:consult customer']);
    Route::post('/customer/store',[CustomerController::class,'store'])->name('customer.store')->middleware(['ifnot:create customer']);
    Route::post('/customer/{id}/update',[CustomerController::class,'update'])->name('customer.update')->middleware(['ifnot:edit customer']);
    Route::post('/customer/ajaxvalidation',[CustomerController::class,'ajaxValidation'])->name('customer.ajaxvalidation')->middleware(['ifnot:create customer|edit customer']);
    Route::post('/customer/ajaxselect',[CustomerController::class,'ajaxSelect'])->name('customer.ajaxselect')->middleware(['ifnot:create customer|edit customer']);

    /**
     * OutWorksheet Controller
     */
    Route::get('/outworksheet/in',[OutWorksheetController::class,'in'])->name('outworksheet.in')->middleware(['ifnot:reassort worksheet stock']);
    Route::get('/outworksheet/out',[OutWorksheetController::class,'out'])->name('outworksheet.out')->middleware(['ifnot:out worksheet stock']);
    Route::post('/outworksheet/in',[OutWorksheetController::class,'inTreatment'])->name('outworksheet.intreatment')->middleware(['ifnot:reassort worksheet stock']);
    Route::post('/outworksheet/out',[OutWorksheetController::class,'outTreatment'])->name('outworksheet.outtreatment')->middleware(['ifnot:out worksheet stock']);
    Route::post('/outworksheet/ajaxworksheetcheck',[OutWorksheetController::class,'ajaxWorksheetCheck'])->name('outworksheet.ajaxworksheetcheck')->middleware(['ifnot:reassort worksheet stock|reassort worksheet stock']);
    Route::post('/outworksheet/ajaxpartcheck',[OutWorksheetController::class,'ajaxPartCheck'])->name('outworksheet.ajaxpartcheck')->middleware(['ifnot:reassort worksheet stock|reassort worksheet stock']);
    Route::post('/outworksheet/ajaxpartcheckout',[OutWorksheetController::class,'ajaxPartCheckOut'])->name('outworksheet.ajaxpartcheckout')->middleware(['ifnot:reassort worksheet stock|reassort worksheet stock']);
    Route::post('/outworksheet/ajaxpartqtycheck',[OutWorksheetController::class,'ajaxPartQtyCheck'])->name('outworksheet.ajaxpartqtycheck')->middleware(['ifnot:reassort worksheet stock|reassort worksheet stock']);

    /**
     * Worksheet Controller
     */
    Route::get('/worksheet/index',[WorksheetController::class,'index'])->name('worksheet.index')->middleware(['ifnot:list worksheet']);
    Route::get('/worksheet/create',[WorksheetController::class,'create'])->name('worksheet.create')->middleware(['ifnot:create worksheet']);
    Route::get('/worksheet/template',[WorksheetController::class,'templateCreate'])->name('worksheet.template.create')->middleware(['ifnot:create worksheet']);
    Route::post('/worksheet/template',[WorksheetController::class,'templateStore'])->name('worksheet.template.store')->middleware(['ifnot:create worksheet']);
    Route::get('/worksheet/{id}/edit',[WorksheetController::class,'edit'])->name('worksheet.edit')->middleware(['ifnot:edit worksheet']);
    Route::get('/worksheet/{id}/part',[WorksheetController::class,'partConsult'])->name('worksheet.part')->middleware(['ifnot:part worksheet']);
    Route::get('/worksheet/{id}/show',[WorksheetController::class,'show'])->name('worksheet.show')->middleware(['ifnot:consult worksheet']);
    Route::get('/worksheet/{id}/{number}/export',[WorksheetController::class,'export'])->name('worksheet.export')->middleware(['ifnot:consult worksheet']);
    Route::post('/worksheet/print',[WorksheetController::class,'print'])->name('worksheet.print')->middleware(['ifnot:print worksheet']);
    Route::post('/worksheet/store',[worksheetController::class,'store'])->name('worksheet.store')->middleware(['ifnot:create worksheet']);
    Route::post('/worksheet/{id}/update',[worksheetController::class,'update'])->name('worksheet.update')->middleware(['ifnot:edit worksheet']);
    Route::post('/worksheet/ajaxselect',[WorksheetController::class,'ajaxSelect'])->name('worksheet.ajaxselect')->middleware(['ifnot:create worksheet|edit worksheet']);
    Route::post('/worksheet/ajaxvalidation',[WorksheetController::class,'ajaxValidation'])->name('worksheet.ajaxvalidation')->middleware(['ifnot:create worksheet|edit worksheet']);
    Route::post('/worksheet/addoption',[WorksheetController::class,'addOption'])->name('worksheet.add.option')->middleware(['ifnot:create worksheet|edit worksheet']);

    /**
     * Clocking Controller
     */
    Route::get('/clocking/{id}/edit',[ClockingController::class,'edit'])->name('clocking.edit')->middleware(['ifnot:clocking worksheet']);
    Route::get('/clocking/correct',[ClockingController::class,'correct'])->name('clocking.correct')->middleware(['ifnot:clocking correction']);
    Route::post('/clocking/ajaxcorrect',[ClockingController::class,'ajaxCorrect'])->name('clocking.ajaxcorrect')->middleware(['ifnot:clocking correction']);
    //Route::get('/clocking/{id}/show',[ClockingController::class,'show'])->name('clocking.show');
    Route::get('/clocking/clockingtechnician',[ClockingController::class,'ClockingTechnician'])->name('clocking.technician')->middleware(['ifnot:clocking technician']);
    Route::post('/clocking/{id}/update',[ClockingController::class,'update'])->name('clocking.update')->middleware(['ifnot:clocking worksheet']);
    Route::post('/clocking/ajaxworksheetcheck',[ClockingController::class,'ajaxWorksheetCheck'])->name('clocking.ajaxworksheetcheck')->middleware(['ifnot:clocking technician']);
    Route::post('/clocking/ajaxtechniciancheck',[ClockingController::class,'ajaxTechnicianCheck'])->name('clocking.ajaxtechniciancheck')->middleware(['ifnot:clocking technician']);

    /**
     * Technician Controller
     */
    Route::get('/technician',[TechnicianController::class,'index'])->name('technician.index')->middleware(['ifnot:list technician']);
    Route::get('/technician/create',[TechnicianController::class,'create'])->name('technician.create')->middleware(['ifnot:create technician']);
    Route::get('/technician/{id}/edit',[TechnicianController::class,'edit'])->name('technician.edit')->middleware(['ifnot:edit technician']);
    Route::get('/technician/{id}/show',[TechnicianController::class,'show'])->name('technician.show')->middleware(['ifnot:consult technician']);
    Route::post('/technician/store',[TechnicianController::class,'store'])->name('technician.store')->middleware(['ifnot:create technician']);
    Route::post('/technician/{id}/update',[TechnicianController::class,'update'])->name('technician.update')->middleware(['ifnot:edit technician']);
    Route::post('/technician/ajaxvalidation',[TechnicianController::class,'ajaxValidation'])->name('technician.ajaxvalidation')->middleware(['ifnot:create technician|edit technician']);
    Route::post('/technician/ajaxnamecheck',[TechnicianController::class,'ajaxNameCheck'])->name('technician.ajaxnamecheck')->middleware(['ifnot:create technician|edit technician']);

    /**
     * Provider Controller
     */
    Route::get('/provider',[ProviderController::class,'index'])->name('provider.index')->middleware(['ifnot:list provider']);

    /**
     * Reporting
     */
    Route::get('/report/reassort',[ReportController::class,'reassortLevel'])->name('report.reassortLevel')->middleware(['ifnot:list provider']);
    Route::get('/reporting',[ReportingController::class,'from'])->name('reporting.from');
});

