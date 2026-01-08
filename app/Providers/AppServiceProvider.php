<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\CourseAdministration\Interfaces\TrainingBatchInterface;
use Modules\CourseAdministration\Interfaces\TrainingBatchScheduleItemInterface;
use Modules\CourseAdministration\Interfaces\TrainingScheduleItemInterface;
use Modules\CourseAdministration\Repositories\TrainingBatchRepository;
use Modules\CourseAdministration\Repositories\TrainingBatchScheduleItemRepository;
use Modules\CourseAdministration\Repositories\TrainingScheduleItemRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            // Bind interfaces to their implementations
            TrainingBatchInterface::class,
            TrainingBatchRepository::class,

            TrainingBatchScheduleItemInterface::class,
            TrainingBatchScheduleItemRepository::class,

            TrainingScheduleItemInterface::class,
            TrainingScheduleItemRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
