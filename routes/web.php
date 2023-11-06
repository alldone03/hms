<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\HistoryController;
use App\Models\Device;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware('guest')->group(
    function () {
        Route::controller(AuthController::class)->prefix('auth')->group(function () {
            Route::get('/login', function () {
                return view('pages.auth.login');
            })->name('login');
            Route::get('/register', function () {
                return view('pages.auth.register');
            })->name('register');
            Route::post('/login', 'loginProcess')->name('loginProcess');
            Route::post('/register', 'registerProcess')->name('registerProcess');
        });
        Route::get('/logdevice', [HistoryController::class, 'logdevice'])->name('logdevice');
    }
);
Route::middleware('auth')->group(function () {
    Route::controller(DashboardController::class)->prefix('dashboard')->group(function () {
        Route::get('/', 'index')->name('dashboard');
        Route::get('/getdata/{id}', 'gethistoryfend')->name('dashboard/getdata');
    });
    Route::get('/setting', function () {
        return view('pages.setting');
    })->name('setting');
    Route::controller(AuthController::class)->prefix('auth')->group(function () {
        Route::get('/logout', 'logout')->name('logout');
        Route::post('/update', 'updateUser')->name('updateUser');
        Route::post('/delete/{id}', 'deleteUser')->name('deleteUser');
    });
    Route::controller(HistoryController::class)->prefix('history')->group(function () {
        Route::get('/', 'index')->name('history');

        Route::get('/device', 'history2')->name('historyget2');
        Route::get('/device/export', 'exportcsv')->name('historyexport');
    });
    Route::controller(DeviceController::class)->prefix('managedevice')->group(function () {
        Route::get('/', 'index')->name('managedevice');
        Route::post('/add', 'store')->name('managedevice/add');
        Route::get('/edit/{device}', 'edit')->name('managedevice/edit');
        Route::put('/update/{device}', 'update')->name('managedevice/update');
        Route::delete('/delete/{id}', 'deletedevice')->name('managedevice/delete');
    });
});
