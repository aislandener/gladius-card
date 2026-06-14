<?php

use App\Http\Controllers\Api;
use Illuminate\Support\Facades\Route;

Route::name('warriors.')
    ->prefix('warriors/')
    ->group(function () {
        Route::get('/', Api\V1\RetrivedAllWarriors::class)->name('index');
        Route::get('/{warrior}', Api\V1\ShowWarrior::class)->name('show');
    });
