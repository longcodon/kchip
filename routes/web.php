<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EvenController;
use App\Http\Controllers\FullController;
use App\Http\Controllers\PayController;
use App\Http\Controllers\DanhmucController; 
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\IndexController; 
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\KhachhangController;
use App\Http\Controllers\ThongbaoController;
use App\Http\Controllers\GiohangController;
use App\Http\Controllers\DichvuController;
use App\Http\Controllers\MaController;
use App\Http\Controllers\DonhangController;
use App\Http\Controllers\Auth\NewPasswordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|-----------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/',[App\Http\Controllers\WelcomeController::class,'index'])->name('welcome');

Route::get('/layout', [App\Http\Controllers\IndexController::class,'index']
)->name('index');

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])
    ->middleware(['auth', 'verified', 'check.admin'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



Route::get('/event/{slug}',[App\Http\Controllers\EventController::class,'index'])->name('event');
Route::get('/full/',[App\Http\Controllers\FullController::class,'index'])->name('full');
Route::get('/pay/',[App\Http\Controllers\PayController::class,'index'])->name('pay');
Route::get('/dichvu/',[App\Http\Controllers\DichvuController::class,'index'])->name('dichvu');

Route::get('/donhang/',[App\Http\Controllers\DonhangController::class,'index'])->name('donhang');
Route::get('/khachhang/',[App\Http\Controllers\KhachhangController::class,'index'])->name('khachhang');


Route::get('/get-cart', [App\Http\Controllers\GiohangController::class, 'getCart'])->name('get.cart');







Route::resource('danhmuc', DanhmucController::class);
Route::resource('khachhang', KhachhangController::class);
Route::put('/khachhang/update-trangthai/{id}', [KhachhangController::class, 'updateTrangthai'])->name('khachhang.updateTrangthai');

Route::resource('thongbao', ThongbaoController::class);
Route::get('/thongbao/edit/{country}', [ThongbaoController::class, 'editByCountry'])->name('thongbao.edit.country');

Route::resource('ma', MaController::class);




Route::post('/vnpay_payment', [PayController::class, 'vnpay_payment'])->name('vnpay_payment');
Route::get('/vnpay_return', [PayController::class, 'vnpayReturn'])->name('vnpay_return');

Route::post('/momo_payment', [PayController::class, 'momo_payment'])->name('momo_payment');
Route::get('/momo_callback', [PayController::class, 'momoCallback'])->name('momo_callback');


Route::post('/cod_payment', [PayController::class, 'cod_payment'])->name('cod_payment');

// Route::resource('giohang', GiohangController::class);
Route::post('/save-cart', [GiohangController::class, 'saveCart'])->name('save.cart'); 


Route::post('/checkout', [CheckoutController::class, 'processCheckout'])->name('checkout.process');

Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
    ->middleware('guest')
    ->name('password.reset');


