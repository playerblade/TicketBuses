<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TicketController;
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
//    return view('welcome');
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/get_cities',[HomeController::class,'GetCities'])->name('get_cities');
Route::get('/get_sub_total',[HomeController::class,'GetSubTotal'])->name('get_sub_total');
Route::get('/get_seats',[HomeController::class,'GetSeats'])->name('get_seats');
Route::get('/get_seats_buses',[HomeController::class,'GetSeatsBuses'])->name('get_seats_buses');
Route::get('/price_total',[HomeController::class,'PriceTotal'])->name('price_total');
Route::resource('tickets',TicketController::class);
