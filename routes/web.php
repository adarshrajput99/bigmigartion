<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\copy;
use App\Http\Controllers\order_id;

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
Route::get('/migrate2', [copy::class,'index']);

Route::get('/migrate', [copy::class,'copy2']);
Route::get('/', [order_id::class,'index']);