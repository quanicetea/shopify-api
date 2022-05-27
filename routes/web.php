<?php

use App\Http\Controllers;
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

Route::get('/', Controllers\AuthController::class . '@install');
Route::get('/auth/callback', Controllers\AuthController::class . '@handleCallBack')->name('handleCallBack');
Route::get('/welcome', Controllers\AuthController::class . '@welcome')->name('welcome');
Route::get('/get-shop/{shop_id}', Controllers\AuthController::class . '@getShopInfo');
