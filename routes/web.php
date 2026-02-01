<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LearnerController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use Modules\CourseAdministration\Http\Controllers\LearnerTrainingApplicationController;
use Modules\CourseAdministration\Http\Controllers\TrainingBatchController;
use Modules\CourseAdministration\Http\Controllers\TrainingBatchScheduleItemController;
use Modules\CourseAdministration\Http\Controllers\TrainingBatchStudentController;
use Modules\CourseAdministration\Http\Controllers\TrainingCourseController;
use Modules\CourseAdministration\Http\Controllers\TrainingScheduleItemController;
use Modules\Institution\Http\Controllers\CenterController;
use Modules\PerformanceAdministration\Http\Controllers\StudentBatchAttendanceController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/', [PageController::class, 'index'])->name('landing');

// Route::get('/flow', function () {
//     return view('flow', ['title' => 'Flowbite Test']);
// })->name('flow');

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // Institution Module Routes
    Route::get('/centers', [CenterController::class, 'index'])->name('centers.index');
    Route::get('/centers/create', [CenterController::class, 'create'])->name('centers.create');
    Route::post('/centers/store', [CenterController::class, 'store'])->name('centers.store');
    Route::get('/centers/{uuid}', [CenterController::class, 'show'])->name('centers.show');
    Route::get('/centers/{uuid}/edit', [CenterController::class, 'edit'])->name('centers.edit');
    Route::put('/centers/{uuid}/update', [CenterController::class, 'update'])->name('centers.update');
    Route::delete('/centers/{uuid}', [CenterController::class, 'destroy'])->name('centers.destroy');


    // Course Administration Module Routes
    // ---- Training Courses ----
    Route::get('/training-courses', [TrainingCourseController::class, 'index'])->name('training_courses.index');
    Route::get('/training-courses/create', [TrainingCourseController::class, 'create'])->name('training_courses.create');
    Route::post('/training-courses/store', [TrainingCourseController::class, 'store'])->name('training_courses.store');
    Route::get('/training-courses/{uuid}', [TrainingCourseController::class, 'show'])->name('training_courses.show');
    Route::get('/training-courses/{uuid}/edit', [TrainingCourseController::class, 'edit'])->name('training_courses.edit');
    Route::put('/training-courses/{uuid}/update', [TrainingCourseController::class, 'update'])->name('training_courses.update');
    Route::delete('/training-courses/{uuid}/delete', [TrainingCourseController::class, 'destroy'])->name('training_courses.destroy');
    // ---- Training Batches ----
    Route::get('/training-batches', [TrainingBatchController::class, 'index'])->name('training_batches.index');
    Route::get('/training-batches/create', [TrainingBatchController::class, 'create'])->name('training_batches.create');
    Route::post('/training-batches/store', [TrainingBatchController::class, 'store'])->name('training_batches.store');
    Route::get('/training-batches/{uuid}', [TrainingBatchController::class, 'show'])->name('training_batches.show');
    Route::get('/training-batches/{uuid}/edit', [TrainingBatchController::class, 'edit'])->name('training_batches.edit');
    Route::put('/training-batches/{uuid}/update', [TrainingBatchController::class, 'update'])->name('training_batches.update');
    Route::delete('/training-batches/{uuid}/delete', [TrainingBatchController::class, 'destroy'])->name('training_batches.destroy');
    // ---- Training Student Batches ----
    Route::get('/training-student-batches', [TrainingBatchStudentController::class, 'index'])->name('training_student_batches.index');
    Route::get('/training-student-batches/create', [TrainingBatchStudentController::class, 'create'])->name('training_student_batches.create');
    Route::post('/training-student-batches/store', [TrainingBatchStudentController::class, 'store'])->name('training_student_batches.store');
    Route::get('/training-student-batches/{uuid}', [TrainingBatchStudentController::class, 'show'])->name('training_student_batches.show');
    Route::get('/training-student-batches/{uuid}/edit', [TrainingBatchStudentController::class, 'edit'])->name('training_student_batches.edit');
    Route::put('/training-student-batches/{uuid}/update', [TrainingBatchStudentController::class, 'update'])->name('training_student_batches.update');
    Route::delete('/training-student-batches/{uuid}/delete', [TrainingBatchController::class, 'destroy'])->name('training_student_batches.destroy');

    // --- Training Schedule Items ----
    Route::get('/training-schedule-items', [TrainingScheduleItemController::class, 'index'])->name('training_schedule_items.index');
    Route::get('/training-schedule-items/create', [TrainingScheduleItemController::class, 'create'])->name('training_schedule_items.create');
    Route::post('/training-schedule-items/store', [TrainingScheduleItemController::class, 'store'])->name('training_schedule_items.store');
    Route::get('/training-schedule-items/{id}', [TrainingScheduleItemController::class, 'show'])->name('training_schedule_items.show');
    Route::get('/training-schedule-items/{id}/edit', [TrainingScheduleItemController::class, 'edit'])->name('training_schedule_items.edit');
    Route::put('/training-schedule-items/{id}/update', [TrainingScheduleItemController::class, 'update'])->name('training_schedule_items.update');
    Route::delete('/training-schedule-items/{id}/delete', [TrainingScheduleItemController::class, 'destroy'])->name('training_schedule_items.destroy');

    // --- Training Batch Schedule Items ----
    Route::get('/training-batch-schedule-items', [TrainingBatchScheduleItemController::class, 'index'])->name('training_batch_schedule_items.index');
    Route::get('/training-batch-schedule-items/create', [TrainingBatchScheduleItemController::class, 'create'])->name('training_batch_schedule_items.create');
    Route::post('/training-batch-schedule-items/store', [TrainingBatchScheduleItemController::class, 'store'])->name('training_batch_schedule_items.store');
    Route::get('/training-batch-schedule-items/{id}', [TrainingBatchScheduleItemController::class, 'show'])->name('training_batch_schedule_items.show');
    Route::get('/training-batch-schedule-items/{id}/edit', [TrainingBatchScheduleItemController::class, 'edit'])->name('training_batch_schedule_items.edit');
    Route::put('/training-batch-schedule-items/{id}/update', [TrainingBatchScheduleItemController::class, 'update'])->name('training_batch_schedule_items.update');
    Route::delete('/training-batch-schedule-items/{id}/delete', [TrainingBatchScheduleItemController::class, 'destroy'])->name('training_batch_schedule_items.destroy');


    // Perfomance Administration Module Routes
    Route::get('training_student_batch_attendances', [StudentBatchAttendanceController::class, 'index'])->name('training_student_batch_attendances.index');



    // User Routes
    Route::get('users', [UserController::class, 'index'])->name('users.index');

    // Learner Training Application Routes
    Route::get('learner-training-applications', [LearnerTrainingApplicationController::class, 'index'])->name('learner-training-applications.index');
    Route::get('learner-training-applications/create', [LearnerTrainingApplicationController::class, 'create'])->name('learner-training-applications.create');
    Route::get('learner-training-applications/{uuid}', [LearnerTrainingApplicationController::class, 'show'])->name('learner-training-applications.show');

    // Roles
    Route::get('roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('/roles/store', [RoleController::class, 'store'])->name('roles.store');
    Route::get('/roles/{id}', [RoleController::class, 'show'])->name('roles.show');
    Route::get('/roles/{id}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::put('/roles/{id}/update', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('/roles/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');




    // Learner Route
    Route::get('learner/profile', [LearnerController::class, 'index'])->name('learner.profile.index');



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
