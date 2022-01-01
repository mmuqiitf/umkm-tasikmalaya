<?php

use App\Http\Controllers\Admin\JenisUmkmController;
use App\Http\Controllers\Admin\KecamatanController;
use App\Http\Controllers\Admin\UmkmController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\User\UmkmController as UserUmkmController;
use App\Models\Kecamatan;
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
    $kecamatans = Kecamatan::where('status', 1)->get();
    return view('layouts.front', compact('kecamatans'));
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

    Route::get('/user/list', [UserController::class, 'list'])->name('user.list');
    Route::resource('user', UserController::class);
});

Route::prefix('user')->name('user.')->middleware(['auth'])->group(function () {
    Route::get('/umkm/list', [UserUmkmController::class, 'list'])->name('umkm.list');
    Route::resource('umkm', UserUmkmController::class);
});

require __DIR__ . '/auth.php';
