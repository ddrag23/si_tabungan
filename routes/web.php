<?php

use App\Http\Controllers\IncomeTransactionController;
use App\Http\Controllers\OutgoingTransactionController;
use App\Http\Controllers\PinjamanController;
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
  Route::get('/tabungan/json-data',[TabunganController::class,'getJsonData']);
  Route::get('/tabungan/json-total',[TabunganController::class,'getJsonTotal']);
  Route::delete('/tabungan/delete/{tabungan}',[TabunganController::class,'destroy']);

  Route::get('/transaksi/transaksi-masuk',[IncomeTransactionController::class,'index'])->name('income.index');
  Route::get('/transaksi/transaksi-masuk/json-data',[IncomeTransactionController::class,'getJsonData']);
  Route::get('/transaksi/transaksi-masuk/json-total',[IncomeTransactionController::class,'getTotalJson']);
  Route::match(['GET','POST'],'/transaksi/transaksi-masuk/store',[IncomeTransactionController::class,'store']);
  Route::delete('/transaksi/transaksi-masuk/delete/{income}',[IncomeTransactionController::class,'destroy']);

  Route::get('/transaksi/transaksi-keluar',[OutgoingTransactionController::class,'index'])->name('outgoing.index');
  Route::get('/transaksi/transaksi-keluar/json-data',[OutgoingTransactionController::class,'getJsonData']);
  Route::get('/transaksi/transaksi-keluar/json-total',[OutgoingTransactionController::class,'getJsonTotal']);
  Route::match(['GET','POST'],'/transaksi/transaksi-keluar/store',[OutgoingTransactionController::class,'store']);
  Route::delete('/transaksi/transaksi-keluar/delete/{outgoing}',[OutgoingTransactionController::class,'destroy']);

  Route::get('/pinjaman',[PinjamanController::class,'index'])->name('pinjaman.index');
  Route::get('/pinjaman/json-data',[PinjamanController::class,'getJsonData']);
  Route::get('/pinjaman/json-total',[PinjamanController::class,'getJsonTotal']);
  Route::post('/pinjaman/store',[PinjamanController::class,'store']);
  Route::put('/pinjaman/update',[PinjamanController::class,'update']);
  Route::delete('/pinjaman/delete',[PinjamanController::class,'destroy']);

});
