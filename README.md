# LUMEN Learner Monitoring System

# Purpose

1. Monitor trainee performance.
2. Schedule training schedules.

# Deployment for Development

## System Requirements

This application is developed and optimized for a server with the following specifications:

-   Operating System: Ubuntu 24.04

-   Database: MySQL

-   SMTP: Mailhog

-   PHP 8.3 or later

-   Composer

-   NPM

## Basic Instructions

1. Create a fork in Github to your own account.

2. Clone the fork to your local development unit.

3. Install necessary packages in Composer and NPM.

4. Copy the .env.example to .env and update the necessary variables.

5. Run migration and development seeders.

6. Run `composer dev`.

## Style

-   Use Livewire within views used by Controller methods. Do **not** route directly to Livewire classes.

-   The project uses [Laravel Modules](https://laravelmodules.com/) to segregate large chunks of files into functional groups.

    -   Migrations, models, controllers, and policies must be placed in their respective module folders. However, frontend files (e.g., Livewire classes and view files) shall be placed in corresponding module folders in the app folder, not in their module folders. For example, the Training model which is part of the Training module will be in `modules\Training\app\models\Training` while the Livewire files CreateTrainingLivewire.php and create-training-livewire.php files will be in `app\Livewire\Training` and `resources\views\livewire\training` folders, respectively.

    -   See [here](https://laravelmodules.com/docs/12/getting-started/introduction) for documentation on how to use Laravel Modules.

-   Models that will be accessible via URL (whether for show or edit) shall be identified using UUID. Make sure to include uuid column in migration with uuid method (e.g., `$table->uuid('uuid')->unique()`). In the model, add `use AdditionalUuid;`. Make sure `use App\Traits\AdditionalUuid;` is added in the model file reference. In both methods and in the routes, identify the model that will be called via uuid (e.g., `public function show ($userUuid)` ).

## Modules

Except for the original model and migration files of Laravel, the model, controller, policy, and migration files are arranged according to modules as follows:

1. Institution Module - This refers to files related to centers of the training institution.

    a. Center

    b. TrainerCenter

2. CourseAdministration Module - This refers to files related to administration of training courses.

    a. TrainingCourse

    b. TrainingRequirements

    c. TrainingScheduleItems

    d. TrainingBatch

    d. TrainingBatchStudent

    e. TrainingBatchScheduleItems

3. PerformanceManagement Module - This refers to data related to actual performance of learners when they attend trainings through Trainining Batches

    a. StudentBatchAttendance

    b. StudentBatchPerformanceRecord

    c.

4. Assessment Module

    a. TrainingCourseAssessmentRequirements

    b. StudentAssessmentPerformance

5. Employer Module

    a. Employer

    b. JobOpening
