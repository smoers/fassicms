<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PermissionController;

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
    return redirect()->route('dashboard');
})->name('main');

Auth::routes();

Route::get('/permissions',[PermissionController::class,'add'])->name('permissions.add');

Route::group(['middleware' => ['role_or_permission:admin','auth']],function (){

    Route::get('/dashboard', [DashboardController::class, 'index'])->name("dashboard");
    Route::resource('crane', \App\Http\Controllers\CraneController::class);
    Route::resource('store',\App\Http\Controllers\StoreController::class);
});

