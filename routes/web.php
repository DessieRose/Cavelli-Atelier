<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;

Route::view('/', 'index')->name('login');

Route::post('login', LoginController::class);
Route::get('dashboard', DashboardController::class)->middleware('auth');