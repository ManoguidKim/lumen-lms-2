<?php

namespace Modules\CourseAdministration\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Modules\CourseAdministration\Models\TrainingBatchScheduleItem;

interface TrainingBatchScheduleItemInterface
{
     public function all(): Collection;
     public function create(array $data): TrainingBatchScheduleItem;
     public function findByUuid(string $uuid): TrainingBatchScheduleItem;
     public function updateByUuid(string $uuid, array $data): TrainingBatchScheduleItem;
     public function deleteByUuid(string $uuid): bool;
}
