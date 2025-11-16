<?php

use Illuminate\Support\Facades\Route;
use Modules\PerformanceAdministration\Http\Controllers\PerformanceAdministrationController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('performanceadministrations', PerformanceAdministrationController::class)->names('performanceadministration');
});
