<?php

use Illuminate\Support\Facades\Route;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\LossEventController;
use App\Http\Controllers\BrowsingHistoryController;

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

Route::resource('vehicles', VehicleController::class);

Route::resource('loss_events', LossEventController::class);

Route::resource('browsing_histories', BrowsingHistoryController::class);

Route::get('/', function () {
    return view('home');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();
