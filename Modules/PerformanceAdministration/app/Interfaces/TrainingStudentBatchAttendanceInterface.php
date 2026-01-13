<?php

namespace Modules\PerformanceAdministration\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Modules\PerformanceAdministration\Models\StudentBatchAttendance;

interface TrainingStudentBatchAttendanceInterface
{
     public function all(): Collection;
     public function create(array $data): StudentBatchAttendance;
     public function findByUuid(string $uuid): StudentBatchAttendance;
     public function updateByUuid(string $uuid, array $data): StudentBatchAttendance;
     public function deleteByUuid(string $uuid): bool;
}
