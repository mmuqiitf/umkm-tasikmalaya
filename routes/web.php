<?php

use App\Http\Controllers\Admin\JenisUmkmController;
use App\Http\Controllers\Admin\KecamatanController;
use App\Http\Controllers\Admin\UmkmController;
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
    return view('layouts.test');
})->name('homepage');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/kecamatan/list', [KecamatanController::class, 'list'])->name('kecamatan.list');
    Route::resource('kecamatan', KecamatanController::class);

    Route::get('/jenis-umkm/list', [JenisUmkmController::class, 'list'])->name('jenis-umkm.list');
    Route::resource('jenis-umkm', JenisUmkmController::class);

    Route::get('/umkm/list', [UmkmController::class, 'list'])->name('umkm.list');
    Route::resource('umkm', UmkmController::class);
});

require __DIR__ . '/auth.php';
