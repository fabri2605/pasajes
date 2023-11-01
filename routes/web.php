<?php

use App\Http\Controllers\ListItemController;
use App\Http\Controllers\ViajeController;
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
    return redirect('/login');
});


Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/sarasa', function () {
        return view('home');
    })->name('sarasa');

    Route::get('/viajes', [ViajeController::class, 'index'])
        ->name('viaje.index');

    Route::post('/viajes', [ViajeController::class, 'store'])
        ->name('viaje.store');

    Route::get('/viajes/calculos', [ViajeController::class, 'showCalculus'])
        ->name('viaje.create');

    Route::get('/viajes/create', [ViajeController::class, 'create'])
        ->name('viaje.create');

    Route::get('/viajes/{id}', [ViajeController::class, 'show'])
        ->name('viaje.show');
});
