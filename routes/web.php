<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProviderController;

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


Route::get('/test', [ProviderController::class, 'test']);
Route::post('/csv', [ProviderController::class, 'csv']);
Route::get('/geturls', [ProviderController::class, 'geturls']);

Route::get('/jtocsv', [ProviderController::class, 'jtocsv']);
Route::get('/getdata', [ProviderController::class, 'getdata']); 
Route::post('/create', [ProviderController::class, 'createsitemap']);
Route::get('/', [ProviderController::class, 'index']);
Route::any('download/', [ProviderController::class, 'getjobid']);
Route::get('csv/{provider}/{jobid}', [ProviderController::class, 'getjobid']);

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

