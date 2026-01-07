<?php

namespace Modules\CourseAdministration\Repositories;

use Modules\CourseAdministration\Interfaces\TrainingScheduleItemInterface;
use Modules\CourseAdministration\Models\TrainingScheduleItem;
use Illuminate\Database\Eloquent\Collection;

class TrainingScheduleItemRepository implements TrainingScheduleItemInterface
{
    public function handle() {}

    public function all(): Collection
    {
        return TrainingScheduleItem::latest()->get();
    }

    public function create(array $data): TrainingScheduleItem
    {
        return TrainingScheduleItem::create($data);
    }

    public function findByUuid(string $uuid): TrainingScheduleItem
    {
        return TrainingScheduleItem::where('uuid', $uuid)->firstOrFail();
    }

    public function updateByUuid(string $uuid, array $data): TrainingScheduleItem
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
