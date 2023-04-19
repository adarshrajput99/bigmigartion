<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\copy;
use App\Http\Controllers\oid_ip;
use App\Http\Controllers\order_id;
use App\Http\Controllers\resource_id_finder;
use App\Http\Controllers\resource_oid;
use App\Http\Controllers\watchdog_message;
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

Route::get('/copy_watchdogs', [copy::class,'index']);
Route::get('/copy_rws_resource', [copy::class,'copy3']);
Route::get('/copy_rws', [copy::class,'copy2']);
Route::get('/fetch_order_id_from_message', [order_id::class,'index']);
Route::get('/res_id_filler', [resource_id_finder::class,'res_id']);
Route::get('/fill_oid_resource',[resource_oid::class,'oid_ip_filler']);
#Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/fill_ip_table', [App\Http\Controllers\ip_filler::class, 'filler']);
Route::get('/filler_ip_resource', [App\Http\Controllers\ip_filler::class, 'fill_ip_from_resource']);

Route::get('/get_oid_ip_filler',[App\Http\Controllers\oid_ip::class,'oid_ip_filler']);
Route::get('/backend/view-revision-resource/{res_id}/{opt?}', [watchdog_message::class,'show']);
