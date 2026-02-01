<?php

namespace Modules\Institution\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Modules\Institution\Models\Center;

interface CenterInterface
{
     public function all(): Collection;
     public function create(array $data): Center;
     public function findByUuid(string $uuid): Center;
     public function updateByUuid(string $uuid, array $data): Center;
     public function deleteByUuid(string $uuid): bool;
}
