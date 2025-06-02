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

Route::get('/',[App\Http\Controllers\WelcomeController::class,'index'])->name('welcome');

Route::get('/layout', [App\Http\Controllers\IndexController::class,'index']
)->name('index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'check.admin'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



Route::get('/event/{slug}',[App\Http\Controllers\EventController::class,'index'])->name('event');
Route::get('/full/',[App\Http\Controllers\FullController::class,'index'])->name('full');
Route::get('/pay/',[App\Http\Controllers\PayController::class,'index'])->name('pay');

Route::post('/momo_payment',[PayController::class,'momo_payment']);



Route::resource('danhmuc', DanhmucController::class);
Route::resource('khachhang', KhachhangController::class);


Route::post('/checkout', [CheckoutController::class, 'processCheckout'])->name('checkout.process');




