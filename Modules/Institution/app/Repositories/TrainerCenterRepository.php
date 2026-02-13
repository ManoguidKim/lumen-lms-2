<?php

namespace Modules\Institution\Repositories;

use Illuminate\Support\Collection;
use Modules\Institution\Models\TrainerCenter;

class TrainerCenterRepository
{
    public function handle() {}

    public function all(): Collection
    {
        return TrainerCenter::latest()->get();
    }

    public function create(array $data): TrainerCenter
    {
        return TrainerCenter::create($data);
    }

    public function findByUuid(string $uuid): TrainerCenter
    {
        return TrainerCenter::where('uuid', $uuid)->firstOrFail();
    }

    public function updateByUuid(string $uuid, array $data): TrainerCenter
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
