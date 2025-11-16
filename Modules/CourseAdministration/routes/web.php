<?php

use Illuminate\Support\Facades\Route;
use Modules\CourseAdministration\Http\Controllers\CourseAdministrationController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('courseadministrations', CourseAdministrationController::class)->names('courseadministration');
});
