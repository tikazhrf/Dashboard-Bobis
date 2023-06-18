<?php

use App\Http\Controllers\BusStopsController;
use App\Http\Controllers\BookingTiketController;
use App\Http\Controllers\BusController;
use App\Http\Controllers\DetailManagement;
use App\Http\Controllers\DetailManagementController;
use App\Http\Controllers\DetailPOController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\JenisTiketController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\RevenueController;
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

//LOGIN & REGISTER
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('/loginproses', 'loginproses')->name('loginproses');
    Route::get('/register', 'register')->name('register');
    Route::post('/registeruser', 'registeruser')->name('registeruser');
    Route::get('logout', 'logout')->name('logout');
});


//ROUTE GROUP
Route::group(['middleware' => ['auth', 'hakakses:Superadmin,managementPO,Driver,user']], function () {
    Route::get('/', function () {
        return redirect('dashboard');
    });
    Route::get('/dashboard', [LoginController::class, 'index'])->name('dashboard');
    Route::get('/rutebus', [RuteController::class, 'rutebus'])->name('rutebus');
    Route::get('/jadwal', [JadwalController::class, 'jadwal'])->name('jadwal');
    Route::get('bookingtiket', [BookingTiketController::class, 'bookingtiket'])->name('bookingtiket');
    Route::post('/booking/store', [BookingTiketController::class, 'bookingStore'])->name('booking.store');
    Route::get('penumpang/create', [BookingTiketController::class, 'createPenumpang'])->name('penumpang.create');
    Route::post('/penumpang/store', [BookingTiketController::class, 'storePenumpang'])->name('penumpang.store');
    Route::get('checkout', [BookingTiketController::class, 'checkout'])->name('checkout');
    Route::get('/invoice/{id}', [BookingTiketController::class, 'invoice'])->name('invoice');

    //All Rute
    Route::get('/busstops', [BusStopsController::class, 'busstops'])->name('busstops');

    //Track Bus
    Route::get('/trackbus', [TrackBusController::class, 'trackbus'])->name('trackbus');
    Route::get('/trackrutebus', [TrackBusController::class, 'trackrutebus'])->name('trackrutebus');


    //Booking Tiket
    Route::get('/tampilimage/{id}', [BusController::class, 'tampilimage'])->name('tampilimage');


    //Profil
    Route::get('/profile', [ProfilController::class, 'profile'])->name('profile');
    Route::get('/editprofile', [ProfilController::class, 'editprofile'])->name('editprofile');
});

Route::group(['middleware' => ['auth', 'hakakses:Superadmin,managementPO,Driver']], function () {
    Route::get('/tambahbusstops', [BusStopsController::class, 'tambahbusstops'])->name('tambahbusstops');
    Route::post('/insertbusstops', [BusStopsController::class, 'insertbusstops'])->name('insertbusstops');
    Route::get('/tampilbusstops/{id}', [BusStopsController::class, 'tampilbusstops'])->name('tampilbusstops');
    Route::post('/updatebusstops/{id}', [BusStopsController::class, 'updatebusstops'])->name('updatebusstops');
    Route::delete('/deletebusstops/{id}', [BusStopsController::class, 'deletebusstops'])->name('deletebusstops');
    Route::get('/databus', [BusController::class, 'databus'])->name('databus');
});

Route::group(['middleware' => ['auth', 'hakakses:Superadmin,managementPO']], function () {
    Route::get('bookingdata', [BookingTiketController::class, 'bookingdata'])->name('booking.data');
    Route::delete('/deletebooking/{id}', [BookingTiketController::class, 'deleteBooking'])->name('booking.delete');
    Route::resources([
        'finance' => FinanceController::class,
    ]);

    //Bus
    Route::get('/tambahbus', [BusController::class, 'tambahbus'])->name('tambahbus');
    Route::post('/insertbus', [BusController::class, 'insertbus'])->name('insertbus');
    Route::get('/tampilbus/{id}', [BusController::class, 'tampilbus'])->name('tampilbus');
    Route::post('/updatebus/{id}', [BusController::class, 'updatebus'])->name('updatebus');
    Route::delete('/deletebus/{id}', [BusController::class, 'deletebus'])->name('deletebus');

    //Rute
    Route::get('/tambahrute', [RuteController::class, 'tambahrute'])->name('tambahrute');
    Route::post('/insertrute', [RuteController::class, 'insertrute'])->name('insertrute');
    Route::get('/tampilrute/{id}', [RuteController::class, 'tampilrute'])->name('tampilrute');
    Route::post('/updaterute/{id}', [RuteController::class, 'updaterute'])->name('updaterute');
    Route::delete('/deleterute/{id}', [RuteController::class, 'deleterute'])->name('deleterute');

    //jadwal
    Route::get('/tambahjadwal', [JadwalController::class, 'tambahjadwal'])->name('tambahjadwal');
    Route::post('/insertjadwal', [JadwalController::class, 'insertjadwal'])->name('insertjadwal');
    Route::get('/tampiljadwal/{id}', [JadwalController::class, 'tampiljadwal'])->name('tampiljadwal');
    Route::post('/updatejadwal/{id}', [JadwalController::class, 'updatejadwal'])->name('updatejadwal');
    Route::delete('/deletejadwal/{id}', [JadwalController::class, 'deletejadwal'])->name('deletejadwal');

    //tiket
    Route::get('/kategoritiket', [JenisTiketController::class, 'kategoritiket'])->name('kategoritiket');

    //User Management
    Route::get('/usermanagement', [UserManagementController::class, 'usermanagement'])->name('usermanagement');
    Route::get('/detailmanagement', [UserManagementController::class, 'detailmanagement'])->name('detailmanagement');
    Route::get('/detaildriver', [UserManagementController::class, 'detaildriver'])->name('detaildriver');
    Route::get('/detailuser', [UserManagementController::class, 'detailuser'])->name('detailuser');
    Route::get('/addakun', [UserManagementController::class, 'tambahakun'])->name('create.user');
    Route::post('/storeakun', [UserManagementController::class, 'storeakun'])->name('store.user');
    Route::get('/tampilmanagement/{id}', [UserManagementController::class, 'tampilmanagement'])->name('tampilmanagement');
    Route::post('/update-user/{id}', [UserManagementController::class, 'updateUser'])->name('update.user');
    Route::delete('/deleteuser/{id}', [UserManagementController::class, 'deleteuser'])->name('deleteuser');
});

Route::group(['middleware' => ['auth', 'hakakses:Superadmin']], function () {
    //tiket
    Route::get('/tambahtiket', [JenisTiketController::class, 'tambahtiket'])->name('tambahtiket');
    Route::post('/inserttiket', [JenisTiketController::class, 'inserttiket'])->name('inserttiket');
    Route::get('/tampiltiket/{id}', [JenisTiketController::class, 'tampiltiket'])->name('tampiltiket');
    Route::post('/updatetiket/{id}', [JenisTiketController::class, 'updatetiket'])->name('updatetiket');
    Route::get('/deletetiket/{id}', [JenisTiketController::class, 'deletetiket'])->name('deletetiket');
    //Finance
    Route::get('/revenue', [RevenueController::class, 'revenue'])->name('revenue');
});
