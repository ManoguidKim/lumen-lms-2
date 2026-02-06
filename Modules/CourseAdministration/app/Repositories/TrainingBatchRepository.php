<?php

namespace Modules\CourseAdministration\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Modules\CourseAdministration\Interfaces\TrainingBatchInterface;
use Modules\CourseAdministration\Models\TrainingBatch;

class TrainingBatchRepository implements TrainingBatchInterface
{
    public function handle() {}

    public function all(): Collection
    {
        return TrainingBatch::latest()->get();
    }

    public function create(array $data): TrainingBatch
    {
        return TrainingBatch::create($data);
    }

    public function findByUuid(string $uuid): TrainingBatch
    {
        return TrainingBatch::where('uuid', $uuid)->firstOrFail();
    }

    public function updateByUuid(string $uuid, array $data): TrainingBatch
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

    public function getBatchByCourse($courseId)
    {
        return TrainingBatch::query()
            ->where('status', 'open')
            ->where('training_course_id', $courseId)
            ->get();
    }
}
