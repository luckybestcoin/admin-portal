<?php

use App\Http\Controllers\AutentikasiController;
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
Route::group(['middleware' => ['auth']], function () {
    Route::get('/', \App\Http\Livewire\Dashboard::class);
    Route::get('/dashboard', \App\Http\Livewire\Dashboard::class)->name('dashboard');

    Route::prefix('datamaster')->group(function () {
        Route::group(['middleware' => ['role_or_permission:super-admin|paket']], function () {
            Route::prefix('paket')->group(function () {
                Route::get('/', \App\Http\Livewire\Datamaster\Paket\Index::class)->name('datamaster.paket');
                Route::get('/tambah', \App\Http\Livewire\Datamaster\Paket\Form::class)->name('datamaster.paket.tambah');
                Route::get('/edit/{key}', \App\Http\Livewire\Datamaster\Paket\Form::class)->name('datamaster.paket.edit');
            });
        });
        Route::group(['middleware' => ['role_or_permission:super-admin|peringkat']], function () {
            Route::prefix('peringkat')->group(function () {
                Route::get('/', \App\Http\Livewire\Datamaster\Peringkat\Index::class)->name('datamaster.peringkat');
                Route::get('/tambah', \App\Http\Livewire\Datamaster\Peringkat\Form::class)->name('datamaster.peringkat.tambah');
                Route::get('/edit/{key}', \App\Http\Livewire\Datamaster\Peringkat\Form::class)->name('datamaster.peringkat.edit');
            });
        });
    });

    Route::prefix('setup')->group(function () {
        Route::group(['middleware' => ['role_or_permission:super-admin|harilibur']], function () {
            Route::prefix('harilibur')->group(function () {
                Route::get('/', \App\Http\Livewire\Setup\Harilibur\Index::class)->name('setup.harilibur');
                Route::get('/tambah', \App\Http\Livewire\Setup\Harilibur\Form::class)->name('setup.harilibur.tambah');
                Route::get('/edit/{key}', \App\Http\Livewire\Setup\Harilibur\Form::class)->name('setup.harilibur.edit');
            });
        });
        Route::group(['middleware' => ['role_or_permission:super-admin|kurs']], function () {
            Route::prefix('kurs')->group(function () {
                Route::get('/', \App\Http\Livewire\Setup\Kurs\Form::class)->name('setup.kurs.tambah');
                Route::get('/data', \App\Http\Livewire\Setup\Kurs\Index::class)->name('setup.kurs');
            });
        });
        Route::group(['middleware' => ['role_or_permission:super-admin|pengguna']], function () {
            Route::prefix('pengguna')->group(function () {
                Route::get('/', \App\Http\Livewire\Setup\Pengguna\Index::class)->name('setup.pengguna');
                Route::get('/tambah', \App\Http\Livewire\Setup\Pengguna\Form::class)->name('setup.pengguna.tambah');
                Route::get('/edit/{key}', \App\Http\Livewire\Setup\Pengguna\Form::class)->name('setup.pengguna.edit');
            });
        });
    });

    Route::prefix('member')->group(function () {
        Route::get('/registrasi',  \App\Http\Livewire\Member\Registrasi\Form::class)->name('member.registrasi');
    });
});
