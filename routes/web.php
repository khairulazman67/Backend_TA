<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;
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
Route::get('/', [BerandaController::class, 'index'])->name('home');

Route::get('/login', function () {
    
    return view('login');
});

Route::get('/berandaStaf', function () {
    return view('pageStaf/berandaStaf');
});

Route::get('/datamhs', function () {
    return view('pageStaf/dataMhs');
});

Route::get('/detailPelanggaran', function () {
    return view('pageStaf/detailPelanggaran');
});

