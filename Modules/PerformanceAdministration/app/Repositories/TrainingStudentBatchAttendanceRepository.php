<?php

namespace Modules\PerformanceAdministration\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Modules\PerformanceAdministration\Models\StudentBatchAttendance;

class TrainingStudentBatchAttendanceRepository
{
    public function handle() {}

    public function all(): Collection
    {
        return StudentBatchAttendance::latest()->get();
    }

    public function create(array $data): StudentBatchAttendance
    {
        return StudentBatchAttendance::create($data);
    }

    public function findByUuid(string $uuid): StudentBatchAttendance
    {
        return StudentBatchAttendance::where('uuid', $uuid)->firstOrFail();
    }

    public function updateByUuid(string $uuid, array $data): StudentBatchAttendance
    {
        $item = $this->findByUuid($uuid);
        $item->update($data);

        return $item;
    }

    public function deleteByUuid(string $uuid): bool
    {
        $item = $this->findByUuid($uuid);
        return $item->delete();
    }
}
