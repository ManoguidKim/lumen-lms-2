<?php

namespace Modules\CourseAdministration\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Modules\CourseAdministration\Interfaces\TrainingBatchScheduleItemInterface;
use Modules\CourseAdministration\Models\TrainingBatchScheduleItem;

class TrainingBatchScheduleItemRepository implements TrainingBatchScheduleItemInterface
{
    public function handle() {}

    public function all(): Collection
    {
        return TrainingBatchScheduleItem::latest()->get();
    }

    public function create(array $data): TrainingBatchScheduleItem
    {
        return TrainingBatchScheduleItem::create($data);
    }

    public function findByUuid(string $uuid): TrainingBatchScheduleItem
    {
        return TrainingBatchScheduleItem::where('uuid', $uuid)->firstOrFail();
    }

    public function updateByUuid(string $uuid, array $data): TrainingBatchScheduleItem
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
