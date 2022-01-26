<?php

use App\Http\Controllers\RaffleController;
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
    return view('index');
})->name('home');

Route::resource('raffle', RaffleController::class)->only('index', 'create', 'store', 'edit', 'update');
Route::get('raffle/pick', [RaffleController::class, 'pick'])->name('raffle.pick');

Route::post('ajax/raffle/winners', [RaffleController::class, 'winners'])->name('ajax.raffle.winner');

