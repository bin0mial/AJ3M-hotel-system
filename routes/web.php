<?php

use App\Http\Controllers\ReceptionistController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', function () {
    return view('layouts.admin');
});

Route::prefix("manager")->group(function (){
    Route::get('/index', [ReceptionistController::class, 'index'])->name('manager.index');
    Route::get('/create', [ReceptionistController::class, 'create'])->name('manager.create');
    Route::post('/', [ReceptionistController::class, 'store'])->name('manager.store');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

