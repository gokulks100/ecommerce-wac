<?php

use App\Http\Controllers\OrderManagementController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/',[ProductController::class,'index'])->name('index');

Route::group(['preifx'=>'products'],function(){
    Route::get('/getData',[ProductController::class,'getData'])->name('product.getdata');
    Route::post('/store',[ProductController::class,'store'])->name('product.store');
    Route::get('/edit',[ProductController::class,'editData'])->name('product.edit');
    Route::delete('/delete',[ProductController::class,'delete'])->name('product.delete');
});

Route::group(['prefix'=>'order-management'],function(){
    Route::get('/',[OrderManagementController::class,'index'])->name('order.index');
    Route::get('/getData',[OrderManagementController::class,'getData'])->name('order.getdata');
    Route::post('/store',[OrderManagementController::class,'store'])->name('order.store');
    Route::get('/edit',[OrderManagementController::class,'editData'])->name('order.edit');
    Route::any('/generate_invoice',[OrderManagementController::class,'invoice'])->name('order.invoice');
    Route::delete('/delete',[OrderManagementController::class,'delete'])->name('order.delete');
});
