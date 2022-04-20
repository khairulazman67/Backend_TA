<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\StafController;
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
//Beranda
Route::get('/', [BerandaController::class, 'index']);
Route::post('/cariPelanggar', [BerandaController::class, 'cariPelanggar']);
Route::post('/detailBer/{data}', [BerandaController::class,'getDetail']);
Route::get('/login', function () {    
    return view('login');
});

//middleware staf
Route::get('/berandaStaf',[StafController::class, 'index']);
Route::post('/detailPelStaf/{data}',[StafController::class, 'getDetailPelanggaran']);
Route::post('/cariPelanggarStaf', [StafController::class, 'cariPelanggar']);
Route::get('/dataMahasiswa', [StafController::class, 'viewDataMahasiswa']);
Route::post('cariMahasiswaStaf',[StafController::class,'cariMahasiswa']);
Route::post('staf/hapusPelanggaran/{data}',[StafController::class,'hapusPelanggaran']);

Route::get('/detail', function () {
    return view('detail');
});




