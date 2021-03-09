<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\AutentikasiController;

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
    Route::get('/balance', [WalletController::class, 'balance']);

    Route::prefix('master')->group(function () {
        Route::group(['middleware' => ['role_or_permission:super-admin|contract']], function () {
            Route::prefix('contract')->group(function () {
                Route::get('/', \App\Http\Livewire\Master\Contract\Index::class)->name('master.contract');
                Route::get('/add', \App\Http\Livewire\Master\Contract\Form::class)->name('master.contract.add');
                Route::get('/edit/{key}', \App\Http\Livewire\Master\Contract\Form::class)->name('master.contract.edit');
            });
        });
        // Route::group(['middleware' => ['role_or_permission:super-admin|peringkat']], function () {
        //     Route::prefix('peringkat')->group(function () {
        //         Route::get('/', \App\Http\Livewire\Master\Peringkat\Index::class)->name('master.peringkat');
        //         Route::get('/add', \App\Http\Livewire\Master\Peringkat\Form::class)->name('master.peringkat.add');
        //         Route::get('/edit/{key}', \App\Http\Livewire\Master\Peringkat\Form::class)->name('master.peringkat.edit');
        //     });
        // });
    });

    Route::group(['middleware' => ['role_or_permission:super-admin|member']], function () {
        Route::prefix('member')->group(function ()
        {
            Route::get('/', \App\Http\Livewire\Member\Index::class)->name('member');
            Route::get('/registration', \App\Http\Livewire\Member\Registration::class)->name('member.registration');
        });
    });

    Route::prefix('reward')->group(function () {
        Route::group(['middleware' => ['role_or_permission:super-admin|daily']], function () {
            Route::prefix('daily')->group(function ()
            {
                Route::get('/', \App\Http\Livewire\Reward\Daily\Index::class)->name('reward.daily');
                Route::get('/add', \App\Http\Livewire\Reward\Daily\Form::class)->name('reward.daily.add');
            });
        });
    });

    Route::get('/wallet', \App\Http\Livewire\Lbc::class)->name('wallet');

    Route::prefix('setup')->group(function () {
        Route::group(['middleware' => ['role_or_permission:super-admin|harilibur']], function () {
            Route::prefix('harilibur')->group(function () {
                Route::get('/', \App\Http\Livewire\Setup\Harilibur\Index::class)->name('setup.harilibur');
                Route::get('/add', \App\Http\Livewire\Setup\Harilibur\Form::class)->name('setup.harilibur.add');
                Route::get('/edit/{key}', \App\Http\Livewire\Setup\Harilibur\Form::class)->name('setup.harilibur.edit');
            });
        });
        Route::group(['middleware' => ['role_or_permission:super-admin|kurs']], function () {
            Route::prefix('kurs')->group(function () {
                Route::get('/', \App\Http\Livewire\Setup\Kurs\Form::class)->name('setup.kurs.add');
                Route::get('/data', \App\Http\Livewire\Setup\Kurs\Index::class)->name('setup.kurs');
            });
        });
        Route::group(['middleware' => ['role_or_permission:super-admin|pengguna']], function () {
            Route::prefix('pengguna')->group(function () {
                Route::get('/', \App\Http\Livewire\Setup\Pengguna\Index::class)->name('setup.pengguna');
                Route::get('/add', \App\Http\Livewire\Setup\Pengguna\Form::class)->name('setup.pengguna.add');
                Route::get('/edit/{key}', \App\Http\Livewire\Setup\Pengguna\Form::class)->name('setup.pengguna.edit');
            });
        });
    });
});
