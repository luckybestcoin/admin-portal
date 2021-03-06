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

    Route::prefix('member')->group(function ()
    {
        Route::group(['middleware' => ['role_or_permission:super-admin|memberappkey']], function () {
            Route::get('/appkey', \App\Http\Livewire\Member\Appkey::class)->name('member.appkey');
        });
        Route::group(['middleware' => ['role_or_permission:super-admin|memberdata']], function () {
            Route::get('/', \App\Http\Livewire\Member\Index::class)->name('member');
            Route::get('/data', \App\Http\Livewire\Member\Index::class)->name('member.data');
            Route::get('/edit/{key}', \App\Http\Livewire\Member\Edit::class)->name('member.edit');
        });
        Route::group(['middleware' => ['role_or_permission:super-admin|memberregistration']], function () {
            Route::get('/registration', \App\Http\Livewire\Member\Registration::class)->name('member.registration');
        });
        Route::group(['middleware' => ['role_or_permission:super-admin|membertransaction']], function () {
            Route::get('/transaction', \App\Http\Livewire\Member\Transaction::class)->name('member.transaction');
        });
    });

    Route::prefix('reward')->group(function () {

        Route::group(['middleware' => ['role_or_permission:super-admin|rewardachievement']], function () {
            Route::get('/achievement', \App\Http\Livewire\Reward\Turnover::class)->name('achievement');
        });
        Route::group(['middleware' => ['role_or_permission:super-admin|daily']], function () {
            Route::prefix('daily')->group(function ()
            {
                Route::get('/', \App\Http\Livewire\Reward\Daily\Index::class)->name('reward.daily');
                Route::get('/add', \App\Http\Livewire\Reward\Daily\Form::class)->name('reward.daily.add');
            });
        });
    });

    Route::group(['middleware' => ['role_or_permission:super-admin|wallet']], function () {
        Route::prefix('wallet')->group(function ()
        {
            Route::get('/', \App\Http\Livewire\Lbc::class)->name('wallet');
            Route::get('/send', \App\Http\Livewire\Send::class)->name('send');
        });
    });

    Route::group(['middleware' => ['role_or_permission:super-admin|transaction']], function () {
        Route::get('/transaction', \App\Http\Livewire\Transactionhistory::class)->name('transaction');
    });

    Route::prefix('setup')->group(function () {
        Route::group(['middleware' => ['role_or_permission:super-admin|rate']], function () {
            Route::prefix('rate')->group(function () {
                Route::get('/', \App\Http\Livewire\Setup\Rate\Index::class)->name('setup.rate');
                Route::get('/add', \App\Http\Livewire\Setup\Rate\Form::class)->name('setup.rate.add');
            });
        });
        Route::group(['middleware' => ['role_or_permission:super-admin|user']], function () {
            Route::prefix('user')->group(function () {
                Route::get('/', \App\Http\Livewire\Setup\User\Index::class)->name('setup.user');
                Route::get('/add', \App\Http\Livewire\Setup\User\Form::class)->name('setup.user.add');
                Route::get('/edit/{id}', \App\Http\Livewire\Setup\User\Form::class)->name('setup.user.edit');
            });
        });
    });
});
