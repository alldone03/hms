<?php

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
    }
);
