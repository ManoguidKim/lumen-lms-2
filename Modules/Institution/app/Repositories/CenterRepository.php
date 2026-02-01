<?php

namespace Modules\Institution\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Modules\Institution\Models\Center;

class CenterRepository
{
    public function handle() {}

    public function all(): Collection
    {
        return Center::latest()->get();
    }

    public function create(array $data): Center
    {
        return Center::create($data);
    }

    public function findByUuid(string $uuid): Center
    {
        return Center::where('uuid', $uuid)->firstOrFail();
    }

    public function updateByUuid(string $uuid, array $data): Center
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
