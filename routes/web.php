<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PendaftarController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    return view('landingpage');
});

Route::get('/syarat', function () {
    return view('syaratpage');
});

Auth::routes();


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//User Route

// Route::group(['prefix' => '/user'], function(){
//     Route::get('/', [HomeController::class, 'index'])->name('user');
//     Route::get('/daftar', [PendaftarController::class, 'create'])->name('daftar');
//     Route::post('/daftarkan', [PendaftarController::class, 'store'])->name('daftarkan');
// });


// //Admin Route
// Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home')->middleware('role');

Route::group(['prefix' => '/admin'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('admin.dashboard')->middleware('admin');
});
Route::group(['prefix' => '/user'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('user.home')->middleware('user');
    Route::get('/daftar', [PendaftarController::class, 'create'])->name('daftar')->middleware('user');
    Route::post('/daftarkan', [PendaftarController::class, 'store'])->name('daftarkan')->middleware('user');
});

Route::get('logout', [LoginController::class, 'logout']);
