<?php

use Illuminate\Support\Facades\Route;
use Modules\PerformanceAdministration\Http\Controllers\PerformanceAdministrationController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('performanceadministrations', PerformanceAdministrationController::class)->names('performanceadministration');
});
