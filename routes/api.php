<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api;

Route::name('warriors.')
    ->prefix('warriors/')
    ->group(function () {
        Route::get('/', Api\V1\RetrivedAllWarriors::class)->name('index');
        Route::get('/{warrior}', Api\V1\ShowWarrior::class)->name('show');
    });
