<?php

use App\Http\Controllers\commentAjaxController;
use App\Http\Controllers\detailBukuFrontendAjaxController;
use App\Http\Controllers\listBukuController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\keranjangAjaxController;
use App\Http\Controllers\peminjamanAjaxController;
use App\Http\Controllers\peminjamanFrontendAjax;
use App\Http\Controllers\profileController;
use App\Http\Controllers\searchAjaxController;
use App\Http\Controllers\transaksiAjaxController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth','checkRole:anggota'])->group(function () {
    Route::get('/home',[homeController::class,'viewHome'])->name('home');
    Route::resource('homeAjax',homeController::class);

    Route::resource('profileAjax',profileController::class);
    Route::resource('listBukuAjax',listBukuController::class);
    Route::resource('detailBukuFrontendAjax', detailBukuFrontendAjaxController::class);
    Route::get('detailBukuFrontendAjax/viewDetail/{id}', [detailBukuFrontendAjaxController::class, 'viewDetail'])->name('detailBukuFrontendAjax.viewDetail');   
    Route::resource('keranjangAjax',keranjangAjaxController::class);
    Route::resource('commentAjax',commentAjaxController::class);
    Route::resource('peminjamanAjaxFrontend',peminjamanFrontendAjax::class);
    Route::resource('transaksiAjax',transaksiAjaxController::class);
    Route::resource('searchAjax',searchAjaxController::class);
});