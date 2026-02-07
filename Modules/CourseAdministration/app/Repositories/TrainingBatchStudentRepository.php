<?php

namespace Modules\CourseAdministration\Repositories;

use Illuminate\Support\Collection;
use Modules\CourseAdministration\Interfaces\TrainingBatchStudentInterface;
use Modules\CourseAdministration\Models\TrainingBatchStudent;

class TrainingBatchStudentRepository implements TrainingBatchStudentInterface
{
    public function handle() {}

    public function all(): Collection
    {
        return TrainingBatchStudent::latest()->get();
    }

    public function create(array $data): TrainingBatchStudent
    {
        return TrainingBatchStudent::create($data);
    }

    public function findByUuid(string $uuid): TrainingBatchStudent
    {
        return TrainingBatchStudent::where('uuid', $uuid)->firstOrFail();
    }

    public function updateByUuid(string $uuid, array $data): TrainingBatchStudent
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
