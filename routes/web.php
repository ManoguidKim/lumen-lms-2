<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use Modules\CourseAdministration\Http\Controllers\TrainingCourseController;
use Modules\Institution\Http\Controllers\CenterController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/', [PageController::class, 'index'])->name('landing');

Route::get('/flow', function () {
    return view('flow', ['title' => 'Flowbite Test']);
})->name('flow');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {

    // Institution Module Routes
    Route::get('/centers', [CenterController::class, 'index'])->name('centers.index');
    Route::get('/centers/create', [CenterController::class, 'create'])->name('centers.create');
    Route::post('/centers/store', [CenterController::class, 'store'])->name('centers.store');
    Route::get('/centers/{uuid}', [CenterController::class, 'show'])->name('centers.show');
    Route::get('/centers/{uuid}/edit', [CenterController::class, 'edit'])->name('centers.edit');
    Route::put('/centers/{uuid}/update', [CenterController::class, 'update'])->name('centers.update');
    Route::delete('/centers/{uuid}', [CenterController::class, 'destroy'])->name('centers.destroy');


    // Course Administration Module Routes
    Route::get('/training-courses', [TrainingCourseController::class, 'index'])->name('training_courses.index');
    Route::get('/training-courses/create', [TrainingCourseController::class, 'create'])->name('training_courses.create');
    Route::post('/training-courses/store', [TrainingCourseController::class, 'store'])->name('training_courses.store');
    Route::get('/training-courses/{uuid}', [TrainingCourseController::class, 'show'])->name('training_courses.show');
    Route::get('/training-courses/{uuid}/edit', [TrainingCourseController::class, 'edit'])->name('training_courses.edit');
    Route::put('/training-courses/{uuid}/update', [TrainingCourseController::class, 'update'])->name('training_courses.update');
    Route::delete('/training-courses/{uuid}/delete', [TrainingCourseController::class, 'destroy'])->name('training_courses.destroy');


    // Perfomance Administration Module Routes



    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('user-password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});
