<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\TestimoniController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function () {
    Route::post('admin', [AuthController::class,'login']);
    Route::post('register', [AuthController::class,'register']);
    Route::post('logout', [AuthController::class,'logout']);


    // Route::post('admin', [AuthController::class,'login']) -> name('login');
    // Route::post('register', [AuthController::class,'register']) -> name('register');
});


Route::group([
    'middleware' => 'api'
], function(){
    Route::resources([
       'categories' =>CategoryController::class,
       'subcategories' =>SubCategoryController::class,
       'sliders' =>SliderController::class,
       'produk' =>ProdukController::class,
       'member' =>MemberController::class,
       'testimoni' =>TestimoniController::class,
       'review' =>ReviewController::class,
       'orders' =>OrderController::class,
       'payments' =>PaymentController::class,
    ]);
       
       Route::get('pesanan/baru', [OrderController::class, 'baru']);
       Route::get('pesanan/dikonfirmasi', [OrderController::class, 'dikonfirmasi']);
       Route::get('pesanan/dikemas', [OrderController::class, 'dikemas']);
       Route::get('pesanan/dikirim', [OrderController::class, 'dikirim']);
       Route::get('pesanan/diterima', [OrderController::class, 'diterima']);
       Route::get('pesanan/selesai', [OrderController::class, 'selesai']);
       
       
       Route::post('pesanan/ubah_status/{order}' , [OrderController::class, 'ubah_status']);
       
       Route::get('reports' , [ReportController::class, 'get_reports']);
});
