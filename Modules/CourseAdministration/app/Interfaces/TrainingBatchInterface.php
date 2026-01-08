<?php

namespace Modules\CourseAdministration\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Modules\CourseAdministration\Models\TrainingBatch;

interface TrainingBatchInterface
{
     public function all(): Collection;
     public function create(array $data): TrainingBatch;
     public function findByUuid(string $uuid): TrainingBatch;
     public function updateByUuid(string $uuid, array $data): TrainingBatch;
     public function deleteByUuid(string $uuid): bool;
}
