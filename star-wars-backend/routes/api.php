<?php

use App\Http\Controllers\SwapiPeopleController;
use App\Http\Controllers\SwapiFilmsController;
use App\Http\Controllers\StatsController;

Route::get('/people', [SwapiPeopleController::class, 'index']);
Route::get('/people/{id}', [SwapiPeopleController::class, 'show']);
Route::get('/films/{id}', [SwapiFilmsController::class, 'show']);
Route::get('/stats', [StatsController::class, 'index']);