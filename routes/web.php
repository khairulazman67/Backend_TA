<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\StafController;
use App\Http\Controllers\KaProdiController;
use App\Http\Controllers\PelanggaranController;

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
Route::post('/detailPelanggaran/{data}', [PelanggaranController::class,'getDetail']);
Route::post('/detailPelanggaranDistance/{data}', [PelanggaranController::class,'getDetailDistance']);

Route::prefix('staf')->group(function (){
// Route::middleware(['auth'])->group(function () {
    //middleware staf
    Route::middleware(['auth:sanctum','stafProdi'])->group(function () {

        Route::get('/',[StafController::class, 'index']);
        Route::post('/detailPel/{data}',[PelanggaranController::class, 'getDetailPelanggaran']);
        Route::post('/cariPelanggar', [PelanggaranController::class, 'cariPelanggar']);
        Route::get('/dataMahasiswa', [StafController::class, 'viewDataMahasiswa']);
        Route::post('cariMahasiswaStaf',[StafController::class,'cariMahasiswa']);
        Route::get('editMahasiswa/{data}',[StafController::class,'editMahasiswa']);
        Route::post('editMahasiswa',[StafController::class,'prosesEditMahasiswa']);
        Route::delete('hapusPelanggaran/{data}',[StafController::class,'hapusPelanggaran']);
        Route::delete('hapusPelanggaranDistance/{data}',[StafController::class,'hapusPelanggaranDistance']);
    });
// });
});
Route::prefix('kaprodi')->group(function (){
    Route::middleware(['auth:sanctum','kaProdi'])->group(function () {
        Route::get('/',[KaProdiController::class, 'index']);
        Route::post('/detailPel/{data}',[StafController::class, 'getDetailPelanggaran']);
        Route::get('/dataMahasiswa', [kaProdiController::class, 'viewDataMahasiswa']);
        Route::post('/cariMahasiswa',[kaProdiController::class,'cariMahasiswa']);
        Route::get('/laporan', function () {
            return view('pageKaProdi/laporanMasker');
        });
        Route::get('/laporansocialdistancing', function () {
            return view('pageKaProdi/laporanDistance');
        });
        // Route::post('/filterreport', function () {
        //     return view('pageKaProdi/pelaporan');
        // });
        Route::post('/filterreportmask',[kaProdiController::class,'filterReportMask']);
        Route::post('/filterreportsocialdistancing',[kaProdiController::class,'filterReportSocialDistancing']);

        Route::post('/printreportmask',[KaProdiController::class,'printReportMask']);
        Route::post('/printreportdistance',[KaProdiController::class,'printReportDistance']);
    });


});

Route::get('/detail', function () {
    return view('detail');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


require __DIR__.'/auth.php';
