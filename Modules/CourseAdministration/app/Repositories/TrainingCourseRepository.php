<?php

namespace Modules\CourseAdministration\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Modules\CourseAdministration\Interfaces\TrainingCourseInterface;
use Modules\CourseAdministration\Models\TrainingCourse;

class TrainingCourseRepository implements TrainingCourseInterface
{
    public function handle() {}

    public function all(): Collection
    {
        return TrainingCourse::latest()->get();
    }

    public function create(array $data): TrainingCourse
    {
        return TrainingCourse::create($data);
    }

    public function findByUuid(string $uuid): TrainingCourse
    {
        return TrainingCourse::where('uuid', $uuid)->firstOrFail();
    }

    public function updateByUuid(string $uuid, array $data): TrainingCourse
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

    public function findByCenterId($centerId)
    {
        return TrainingCourse::where('center_id', $centerId)->get();
    }
}
