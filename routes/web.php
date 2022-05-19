<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\StafController;
use App\Http\Controllers\KaProdiController;

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
Route::get('/', [BerandaController::class, 'index']);
Route::post('/cariPelanggar', [BerandaController::class, 'cariPelanggar']);
Route::post('/detailBer/{data}', [BerandaController::class,'getDetail']);

Route::prefix('staf')->group(function (){
// Route::middleware(['auth'])->group(function () {
    //middleware staf
    Route::middleware(['auth:sanctum','stafProdi'])->group(function () {
        
        Route::get('/',[StafController::class, 'index']);
        Route::post('/detailPel/{data}',[StafController::class, 'getDetailPelanggaran']);
        Route::post('/cariPelanggar', [StafController::class, 'cariPelanggar']);
        Route::get('/dataMahasiswa', [StafController::class, 'viewDataMahasiswa']);
        Route::post('cariMahasiswaStaf',[StafController::class,'cariMahasiswa']);
        Route::delete('hapusPelanggaran/{data}',[StafController::class,'hapusPelanggaran']);
    });
// });
});
Route::prefix('kaprodi')->group(function (){
    Route::middleware(['auth:sanctum','kaProdi'])->group(function () {
        Route::get('/',[KaProdiController::class, 'index']);
    });
});

Route::get('/detail', function () {
    return view('detail');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


require __DIR__.'/auth.php';
