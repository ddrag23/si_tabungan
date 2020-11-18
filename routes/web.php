<?php

use App\Http\Controllers\IncomeTransactionController;
use App\Http\Controllers\TabunganController;
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

Route::get('/', function () {
    return view('auth.login');
});

Route::group(['middleware' => 'auth'], function(){
  Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
  Route::get('/tabungan',[TabunganController::class,'index'])->name('tabungan.index');
  Route::post('/tabungan',[TabunganController::class,'store'])->name('tabungan.store');

  Route::get('/transaksi/transaksi-masuk',[IncomeTransactionController::class,'index'])->name('income.index');
  Route::get('/transaksi/transaksi-masuk/json-data',[IncomeTransactionController::class,'getJsonData']);
  Route::get('/transaksi/transaksi-masuk/json-total',[IncomeTransactionController::class,'getTotalJson']);
  Route::match(['GET','POST'],'/transaksi/transaksi-masuk/store',[IncomeTransactionController::class,'store']);
  Route::delete('/transaksi/transaksi-masuk/delete/{income}',[IncomeTransactionController::class,'destroy']);
});
