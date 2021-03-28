<?php

use App\Http\Controllers\ManagerController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', function () {
    return view('layouts.admin');
});

Route::get('manager/index', [ManagerController::class, 'index'])->name('manager.index');
Route::get('manager/create', [ManagerController::class, 'create'])->name('manager.create');
Route::post('manager', [ManagerController::class, 'store'])->name('manager.store');
