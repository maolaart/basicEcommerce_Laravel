<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\TestimoniController;
use App\Models\Order;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// Route::post('login', [AuthController::class,'login_member']);
// Route::post('logout', [AuthController::class,'logout_member']);

//auth login
Route::get('login', [AuthController::class,'index']) -> name('login');
Route::post('login', [AuthController::class,'login']);
Route::get('logout', [AuthController::class,'logout']);

//auth Login Member
Route::get('login_member', [AuthController::class,'login_member']);
Route::post('login_member', [AuthController::class,'login_member_action']);
Route::get('logout_member', [AuthController::class,'logout_member']);

//auth Register Member
Route::get('register_member', [AuthController::class,'register_member']);
Route::post('register_member', [AuthController::class,'register_member_action']);

//data kategori
Route::get('/kategori',[CategoryController::class,'list']);
Route::get('/subkategori',[SubCategoryController::class,'list']);
Route::get('/slider',[SliderController::class,'list']);
Route::get('/barang',[ProdukController::class,'list']);
Route::get('/testimoni',[TestimoniController::class,'list']);

//data pembayaran
Route::get('/payment',[PaymentController::class,'list']);

//data pesanaan
Route::get('/pesanan/baru',[OrderController::class,'list']);
Route::get('/pesanan/dikonfirmasi',[OrderController::class,'list_dikonfirmasi']);
Route::get('/pesanan/dikemas',[OrderController::class,'list_dikemas']);
Route::get('/pesanan/dikirim',[OrderController::class,'list_dikirim']);
Route::get('/pesanan/diterima',[OrderController::class,'list_diterima']);
Route::get('/pesanan/selesai',[OrderController::class,'list_selesai']);


//data laporan
Route::get('/laporan',[ReportController::class,'index']);

//tentang
Route::get('/tentang',[AboutController::class,'index']);
Route::post('/tentang/{about}',[AboutController::class,'update']);


Route::get('/dashboard', [Dashboard::class,'index']);


//home route
Route::get('/',[HomeController::class,'index']);
Route::get('/produks/{category}',[HomeController::class,'produks']);
Route::get('/produk/{id}',[HomeController::class,'produk']);
Route::get('/cart',[HomeController::class,'cart']);
Route::get('/checkout',[HomeController::class,'checkout']);
Route::get('/orders',[HomeController::class,'orders']);
Route::get('/about',[HomeController::class,'about']);
Route::get('/contact',[HomeController::class,'contact']);
Route::get('/faq',[HomeController::class,'faq']);

Route::post('/add_to_cart',[HomeController::class,'add_to_cart']);
Route::get('/delete_from_cart/{cart}',[HomeController::class,'delete_from_cart']);
Route::get('/get_city/{id}',[HomeController::class,'get_city']);
Route::get('/get_cost/{destination}/{weight}/',[HomeController::class,'get_cost']);

Route::post('/checkout_orders',[HomeController::class,'checkout_orders']);
Route::post('/payments',[HomeController::class,'payments']);
Route::post('/pesanan_selesai/{order}',[HomeController::class,'pesanan_selesai']);


// Route::get('/', function () {
//     return view('welcome');
// });
