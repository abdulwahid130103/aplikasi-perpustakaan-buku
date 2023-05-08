<?php

use App\Http\Controllers\anggotaAjaxController;
use App\Http\Controllers\bukuAjaxController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\detailBukuAjaxController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\kategoriAjaxController;
use App\Http\Controllers\laporanAnggotaAjax;
use App\Http\Controllers\logAnggotaController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\logPetugasController;
use App\Http\Controllers\peminjamanAjaxController;
use App\Http\Controllers\pengembalianAjaxController;
use App\Http\Controllers\petugasAjaxController;
use App\Http\Controllers\rakAjaxController;
use App\Http\Controllers\registerController;
use App\Http\Controllers\SaranAjaxController;
use App\Http\Controllers\laporanBukuAjax;
use App\Http\Controllers\laporanPeminjamanAjax;
use App\Http\Controllers\laporanPetugasAjax;
use App\Http\Controllers\laporanPengembalianAjax;
use App\Http\Controllers\profileController;
use Illuminate\Support\Facades\Route;

Route::controller(loginController::class)->group(function(){
    Route::get('/login','index')->name('login');
    Route::post('/login','authenticate');
    Route::get('/logout','logout')->name('logout');
});

Route::controller(GoogleController::class)->group(function(){
    Route::get('auth/google','redirectToGoogle')->name('auth.google');
    Route::get('auth/google/callback','handleGoogleCallback');
});

Route::controller(registerController::class)->group(function(){
    Route::get('/register','index')->name('register');
    Route::post('/registerAdd','store')->name('register.store');
});


Route::middleware(['auth','checkRole:petugas,admin'])->group(function () {
    
    Route::get('/',[dashboardController::class,'index'] )->name('dashboard');

    Route::middleware(['auth','checkRole:petugas','logAktivitasPetugas'])->prefix('petugas')->group(function () {

        Route::get('/kategori',[kategoriAjaxController::class,'viewKategori']);
        Route::resource('kategoriAjax',kategoriAjaxController::class);

        Route::get('/rak',[rakAjaxController::class,'viewRak']);
        Route::resource('rakAjax',rakAjaxController::class);

        Route::get('/buku',[bukuAjaxController::class,'viewBuku']);
        Route::resource('bukuAjax',bukuAjaxController::class);

        Route::get('/detailBuku',[detailBukuAjaxController::class,'viewDetailBuku']);
        Route::resource('detailBukuAjax',detailBukuAjaxController::class);

        Route::get('/peminjaman',[peminjamanAjaxController::class,'viewPeminjaman']);
        Route::resource('peminjamanAjax',peminjamanAjaxController::class);
        Route::get('/peminjamanAcc/{id}',[peminjamanAjaxController::class,'accPeminjaman']);
        Route::get('/pengembalianAcc/{id}',[peminjamanAjaxController::class,'accPengembalian']);

        Route::get('/pengembalian',[pengembalianAjaxController::class,'viewPengembalian']);
        Route::resource('pengembalianAjax',pengembalianAjaxController::class);

        Route::get('/saran',[SaranAjaxController::class,'viewSaran']);
        Route::resource('saranAjax',SaranAjaxController::class);

        Route::get('/anggota',[anggotaAjaxController::class,'viewAnggota']);
        Route::resource('anggotaAjax',anggotaAjaxController::class);

    });
    Route::middleware(['auth','checkRole:admin'])->prefix('admin')->group(function () {

        Route::get('/petugas',[petugasAjaxController::class,'viewPetugas']);
        Route::resource('petugasAjax',petugasAjaxController::class);

        Route::get('/logAnggota',[logAnggotaController::class,'viewLogAnggota']);
        Route::resource('logAnggotaAjax',logAnggotaController::class);

        Route::get('/logPetugas',[logPetugasController::class,'viewLogPetugas']);
        Route::resource('logPetugasAjax',logPetugasController::class);

        Route::get('/laporanAnggota',[laporanAnggotaAjax::class,'viewLaporanAnggota']);
        Route::get('excelAnggota',[laporanAnggotaAjax::class,'exportExcelAnggota'])->name('excelAnggota');
        Route::resource('laporanAnggotaAjax',laporanAnggotaAjax::class);

        Route::get('/laporanPetugas',[laporanPetugasAjax::class,'viewLaporanPetugas']);
        Route::get('excelPetugas',[laporanPetugasAjax::class,'exportExcelPetugas'])->name('excelPetugas');
        Route::resource('laporanPetugasAjax',laporanPetugasAjax::class);
        
        Route::get('/laporanBuku',[laporanBukuAjax::class,'viewLaporanBuku']);
        Route::get('excelBuku',[laporanBukuAjax::class,'exportExcelBuku'])->name('excelBuku');
        Route::resource('laporanBukuAjax',laporanBukuAjax::class);
        
        Route::get('/laporanPeminjaman',[laporanPeminjamanAjax::class,'viewLaporanPeminjaman']);
        Route::get('excelPeminjaman',[laporanPeminjamanAjax::class,'exportExcelPeminjaman'])->name('excelPeminjaman');
        Route::resource('laporanPeminjamanAjax',laporanPeminjamanAjax::class);
        
        Route::get('/laporanPengembalian',[laporanPengembalianAjax::class,'viewLaporanPengembalian']);
        Route::get('excelPengembalian',[laporanPengembalianAjax::class,'exportExcelPengembalian'])->name('excelPengembalian');
        Route::resource('laporanPengembalianAjax',laporanPengembalianAjax::class);

    });
});

