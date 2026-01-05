<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
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
