<?php

use App\Http\Controllers\ReceptionistController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ManagerController;
use Illuminate\Support\Facades\Auth;

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

Route::get('/reservations', function () {
    return view('reservations.index');
});

Route::group(['middleware' => 'auth'],function () {
    Route::prefix("managers")->middleware(["role:admin"])->group(function (){
        Route::get('/', [ManagerController::class, 'index'])->name('managers.index');
        Route::get('/create', [ManagerController::class, 'create'])->name('managers.create');
        Route::post('/', [ManagerController::class, 'store'])->name('managers.store');
        Route::get("/{manager}", [ManagerController::class, 'show'])->name('managers.show');
        Route::get('/{manager}/edit', [ManagerController::class, 'edit'])->name('managers.edit');
        Route::put("/{manager}", [ManagerController::class, 'update'])->name('managers.update');
        Route::delete('/{manager}', [ManagerController::class, 'destroy'])->name('managers.destroy');
    });


    Route::prefix("receptionist")->group(function (){
        Route::get('/index', [ReceptionistController::class, 'index'])->name('receptionist.index');
        Route::get('/create', [ReceptionistController::class, 'create'])->name('receptionist.create');
        Route::post('/', [ReceptionistController::class, 'store'])->name('receptionist.store');
        Route::get('/{receptionist}/edit', [ReceptionistController::class, 'edit'])
            ->name('receptionist.edit');
        Route::put('/{receptionist_id}', [ReceptionistController::class, 'update'])
            ->name('receptionist.update');
        Route::delete('/{receptionist_id}' , [ReceptionistController::class, 'destroy'])->name('receptionist.destroy');
    });

    Route::prefix("reservations")->middleware(["role:client"])->group(function () {
        Route::get('/index', [ClientReservationController::class, 'index'])->name('reservations.index');
        Route::get('/create', [ClientReservationController::class, 'create'])->name('reservations.create');

    });

});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

