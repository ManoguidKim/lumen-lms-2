<?php

use Illuminate\Support\Facades\Route;
use Modules\CourseAdministration\Http\Controllers\CourseAdministrationController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('courseadministrations', CourseAdministrationController::class)->names('courseadministration');
});
