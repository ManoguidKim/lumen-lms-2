<?php

namespace Modules\CourseAdministration\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Modules\CourseAdministration\Models\LearnerTrainingApplication;

interface LearnerTrainingApplicationInterface
{
     public function all(): Collection;
     public function create(array $data): LearnerTrainingApplication;
     public function findByUuid(string $uuid): LearnerTrainingApplication;
     public function updateByUuid(string $uuid, array $data): LearnerTrainingApplication;
     public function deleteByUuid(string $uuid): bool;
}
