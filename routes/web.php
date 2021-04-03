<?php

use \App\Http\Controllers\ManagerController;
use App\Http\Controllers\ReceptionistController;
use App\Http\Controllers\FloorController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ClientReservationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientAuthController;
use App\Http\Controllers\ClientController;

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

Route::group(['middleware' => ['logs-out-banned-user', 'forbid-banned-user']], function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('welcome');

    Route::get('/home', function () {
        return view('layouts.admin');
    });


    Route::get('/clientHome', [ClientReservationController::class, 'index'])->name('clientHome.index');
    Route::get('/client/register', [ClientAuthController::class, 'register'])->middleware('guest')->name('clientRegister');
    Route::post('/clients', [ClientAuthController::class, 'store'])->name('client.store');


    Auth::routes();

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/client', [ClientAuthController::class, 'index'])->middleware('guest')->name('clientLogin');


});


Route::group(['middleware' => ['auth', 'logs-out-banned-user', 'forbid-banned-user']], function () {

    Route::prefix("/reservations")->group(function () {
        Route::get('/rooms/{room}', [ClientReservationController::class, 'reserve'])->name('clientHome.reserve');
        Route::post('/{room}', [ClientReservationController::class, 'store'])->name("clientHome.store");
        Route::post('/{room}/payment', [ClientReservationController::class, 'store'])->name("clientHome.pay");
        Route::get('/{room}/success', [ClientReservationController::class, 'successReserve'])->name("clientHome.successReserve");
    });


    Route::prefix("users")->group(function () {
        Route::get("/{user}/edit", [UserController::class, "edit"])->name("users.edit");
        Route::put("/{user}", [UserController::class, "update"])->name("users.update");
    });

    Route::prefix("admin")->middleware(["role:admin|manager|receptionists"])->group(function () {
        Route::get("/", function () {
            return view('dashboard_welcome');
        })->name("admin.dashboard");


        Route::prefix("managers")->middleware(["role:admin"])->group(function () {
            Route::get('/', [ManagerController::class, 'index'])->name('managers.index');
            Route::get('/create', [ManagerController::class, 'create'])->name('managers.create');
            Route::post('/', [ManagerController::class, 'store'])->name('managers.store');
            Route::get('/{manager}/edit', [ManagerController::class, 'edit'])->name('managers.edit');
            Route::put("/{manager}", [ManagerController::class, 'update'])->name('managers.update');
            Route::delete('/{manager}', [ManagerController::class, 'destroy'])->name('managers.destroy');
        });


        Route::prefix("receptionists")->middleware(["role:admin|manager"])->group(function () {

            Route::get('/', [ReceptionistController::class, 'index'])
                ->name('receptionists.index');

            Route::get('/create', [ReceptionistController::class, 'create'])
                ->name('receptionists.create');

            Route::post('/', [ReceptionistController::class, 'store'])
                ->name('receptionists.store');

            Route::get('/{receptionist}/edit', [ReceptionistController::class, 'edit'])
                ->name('receptionists.edit');


            Route::put('/{receptionist}', [ReceptionistController::class, 'update'])
                ->name('receptionists.update');

            Route::delete('/{receptionist}', [ReceptionistController::class, 'destroy'])
                ->name('receptionists.destroy');

            Route::put('/{receptionist}/ban', [ReceptionistController::class, 'ban'])
                ->name('receptionists.ban');

        });

        Route::prefix("floors")->middleware(["role:admin|manager"])->group(function () {
            Route::get('/', [FloorController::class, 'index'])->name('floors.index');

            Route::get('/create', [FloorController::class, 'create'])->name('floors.create');

            Route::get('/{floor}/edit', [FloorController::class, 'edit'])->name('floors.edit');

            Route::put('/{floor}', [FloorController::class, 'update'])->name('floors.update');

            Route::delete('/{floor}', [FloorController::class, 'destroy'])->name('floors.destroy');

            Route::post('/', [FloorController::class, 'store'])->name('floors.store');

        });

        Route::prefix("rooms")->middleware(["role:admin|manager"])->group(function () {

            Route::get('/', [RoomController::class, 'index'])->name('rooms.index');

            Route::get('/create', [RoomController::class, 'create'])->name('rooms.create');

            Route::get('/{room}/edit', [RoomController::class, 'edit'])->name('rooms.edit');

            Route::put('/{room}', [RoomController::class, 'update'])->name('rooms.update');

            Route::delete('/{room}', [RoomController::class, 'destroy'])->name('rooms.destroy');

            Route::post('/', [RoomController::class, 'store'])->name('rooms.store');

        });

        Route::prefix("clients")->group(function () {
            Route::get('/', [ClientController::class, 'index'])->name('client.index');
            Route::get('/pending', [ClientController::class, 'pending'])->name('client.pending');
            Route::get('/{client}/accept', [ClientController::class, 'accept'])->name('client.accept');
            Route::put('/{client}', [ClientController::class, 'update'])->name('client.update');
            Route::get('/reservation', [ClientController::class, 'get_reservation'])->name('client.reservation');

        });
    });


});



