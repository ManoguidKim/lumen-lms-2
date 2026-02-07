<?php

namespace Modules\CourseAdministration\Interfaces;

use Illuminate\Support\Collection;
use Modules\CourseAdministration\Models\TrainingBatchStudent;

interface TrainingBatchStudentInterface
{
     public function all(): Collection;
     public function create(array $data): TrainingBatchStudent;
     public function findByUuid(string $uuid): TrainingBatchStudent;
     public function updateByUuid(string $uuid, array $data): TrainingBatchStudent;
     public function deleteByUuid(string $uuid): bool;
}
