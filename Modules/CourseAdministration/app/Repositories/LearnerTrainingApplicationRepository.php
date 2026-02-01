<?php

namespace Modules\CourseAdministration\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Modules\CourseAdministration\Interfaces\LearnerTrainingApplicationInterface;
use Modules\CourseAdministration\Models\LearnerTrainingApplication;

class LearnerTrainingApplicationRepository implements LearnerTrainingApplicationInterface
{
    public function handle() {}

    public function all(): Collection
    {
        return LearnerTrainingApplication::latest()->get();
    }

    public function create(array $data): LearnerTrainingApplication
    {
        return LearnerTrainingApplication::create($data);
    }

    public function findByUuid(string $uuid): LearnerTrainingApplication
    {
        return LearnerTrainingApplication::where('uuid', $uuid)->firstOrFail();
    }

    public function updateByUuid(string $uuid, array $data): LearnerTrainingApplication
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
