<?php

use App\Http\Controllers\Car\CarController;
use App\Http\Controllers\Car\SearchController;
use App\Http\Controllers\Car\UnavailableDayController;
use App\Http\Controllers\Driver\DriverController;
use App\Http\Controllers\User\ComfortLevelController;
use App\Http\Controllers\User\PositionController;
use App\Http\Controllers\User\SyncComfortPositionController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

Route::apiResource('/user', UserController::class);
Route::apiResource('/driver', DriverController::class);
Route::apiResource('/position', PositionController::class);
Route::apiResource('/comfort-level', ComfortLevelController::class);
Route::apiResource('/car', CarController::class);
Route::apiResource('/unavailable-day', UnavailableDayController::class);

Route::post('/sync-comfort-with-position', SyncComfortPositionController::class);
Route::post('/search', SearchController::class);
