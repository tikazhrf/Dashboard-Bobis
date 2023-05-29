<?php

use App\Http\Controllers\BusStopsController;
use App\Http\Controllers\BookingTiketController;
use App\Http\Controllers\BusController;
use App\Http\Controllers\DetailManagement;
use App\Http\Controllers\DetailManagementController;
use App\Http\Controllers\DetailPOController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\JenisTiketController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RuteController;
use App\Http\Controllers\TrackBusController;
use App\Http\Controllers\UserManagementController;
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
    return view('welcome');
});

//ROUTE GROUP
Route::group(['middleware' => ['auth', 'hakakses:Superadmin,Management PO,Driver']], function(){
    Route::get('/rutebus',[RuteController::class, 'rutebus'])->name('rutebus');
    Route::get('/jadwal',[JadwalController::class, 'jadwal'])->name('jadwal');
    Route::get('bookingtiket',[BookingTiketController::class, 'bookingtiket'])->name('bookingtiket');
});

Route::group(['middleware' => ['auth', 'hakakses:Superadmin,Management PO']], function(){
    //Bus
    Route::get('/databus', [BusController::class, 'databus'])->name('databus');
    Route::get('/tambahbus', [BusController::class, 'tambahbus'])->name('tambahbus');
    Route::post('/insertbus', [BusController::class, 'insertbus'])->name('insertbus');
    Route::get('/tampilbus/{id}', [BusController::class, 'tampilbus'])->name('tampilbus');
    Route::post('/updatebus/{id}', [BusController::class, 'updatebus'])->name('updatebus');
    Route::get('/deletebus/{id}', [BusController::class, 'deletebus'])->name('deletebus');

    //Rute
    Route::get('/tambahrute',[RuteController::class, 'tambahrute'])->name('tambahrute');
    Route::post('/insertrute',[RuteController::class, 'insertrute'])->name('insertrute');
    Route::get('/tampilrute/{id}',[RuteController::class, 'tampilrute'])->name('tampilrute');
    Route::post('/updaterute/{id}',[RuteController::class, 'updaterute'])->name('updaterute');
    Route::get('/deleterute/{id}',[RuteController::class, 'deleterute'])->name('deleterute');

    //jadwal
    Route::get('/tambahjadwal',[JadwalController::class, 'tambahjadwal'])->name('tambahjadwal');
    Route::post('/insertjadwal',[JadwalController::class, 'insertjadwal'])->name('insertjadwal');
    Route::get('/tampiljadwal/{id}',[JadwalController::class, 'tampiljadwal'])->name('tampiljadwal');
    Route::post('/updatejadwal/{id}',[JadwalController::class, 'updatejadwal'])->name('updatejadwal');
    Route::get('/deletejadwal/{id}',[JadwalController::class, 'deletejadwal'])->name('deletejadwal');

    //tiket
    Route::get('/kategoritiket',[JenisTiketController::class, 'kategoritiket'])->name('kategoritiket');

});

Route::group(['middleware' => ['auth', 'hakakses:Superadmin']], function(){
    //tiket
    Route::get('/tambahtiket',[JenisTiketController::class, 'tambahtiket'])->name('tambahtiket');
    Route::post('/inserttiket',[JenisTiketController::class, 'inserttiket'])->name('inserttiket');
    Route::get('/tampiltiket/{id}',[JenisTiketController::class, 'tampiltiket'])->name('tampiltiket');
    Route::post('/updatetiket/{id}',[JenisTiketController::class, 'updatetiket'])->name('updatetiket');
    Route::get('/deletetiket/{id}',[JenisTiketController::class, 'deletetiket'])->name('deletetiket');

});


//LOGIN & REGISTER
Route::get('/login',[LoginController::class, 'login'])->name('login');
Route::get('/register',[LoginController::class, 'register'])->name('register');
Route::post('/registeruser',[LoginController::class, 'registeruser'])->name('registeruser');
Route::post('/loginproses',[LoginController::class, 'loginproses'])->name('loginproses');
Route::get('/logout',[LoginController::class, 'logout'])->name('logout');

//Track Bus
Route::get('/trackbus',[TrackBusController::class, 'trackbus'])->name('trackbus');
Route::get('/trackrutebus',[TrackBusController::class, 'trackrutebus'])->name('trackrutebus');


//Booking Tiket
Route::get('/tampilimage/{id}', [BusController::class, 'tampilimage'])->name('tampilimage');

//User Management
Route::get('/usermanagement', [UserManagementController::class, 'usermanagement'])->name('usermanagement');
Route::get('/detailmanagement', [LoginController::class, 'detailmanagement'])->name('detailmanagement');
Route::get('/tampilmanagement/{id}', [LoginController::class, 'tampilmanagement'])->name('tampilmanagement');

//All Rute
Route::get('/busstops', [BusStopsController::class, 'busstops'])->name('busstops');
Route::get('/tambahbusstops', [BusStopsController::class, 'tambahbusstops'])->name('tambahbusstops');
Route::post('/insertbusstops',[BusStopsController::class, 'insertbusstops'])->name('insertbusstops');
Route::get('/tampilbusstops/{id}', [BusStopsController::class, 'tampilbusstops'])->name('tampilbusstops');
Route::post('/updatebusstops/{id}',[BusStopsController::class, 'updatebusstops'])->name('updatebusstops');
Route::get('/deletebusstops/{id}',[BusStopsController::class, 'deletebusstops'])->name('deletebusstops');
