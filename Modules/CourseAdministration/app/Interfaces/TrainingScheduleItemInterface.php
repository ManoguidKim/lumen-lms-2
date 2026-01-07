<?php

namespace Modules\CourseAdministration\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Modules\CourseAdministration\Models\TrainingScheduleItem;

interface TrainingScheduleItemInterface
{
     public function all(): Collection;
     public function create(array $data): TrainingScheduleItem;
     public function findByUuid(string $uuid): TrainingScheduleItem;
     public function updateByUuid(string $uuid, array $data): TrainingScheduleItem;
     public function deleteByUuid(string $uuid): bool;
}
