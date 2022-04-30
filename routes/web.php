<?php

use App\Http\Controllers\Admin\ExcelController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\ConfiguratorController;

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

Route::get('/', [ConfiguratorController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin',  'middleware' => ['shield']], function(){
    Route::get('/panel', [ExcelController::class, 'index']);
    Route::post('/import', [ExcelController::class, 'importData']);
    Route::post('/clear', [ExcelController::class, 'clearData']);
});
