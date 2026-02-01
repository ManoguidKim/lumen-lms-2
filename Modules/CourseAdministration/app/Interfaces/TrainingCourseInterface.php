<?php

namespace Modules\CourseAdministration\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Modules\CourseAdministration\Models\TrainingCourse;

interface TrainingCourseInterface
{
     public function all(): Collection;
     public function create(array $data): TrainingCourse;
     public function findByUuid(string $uuid): TrainingCourse;
     public function updateByUuid(string $uuid, array $data): TrainingCourse;
     public function deleteByUuid(string $uuid): bool;
}
