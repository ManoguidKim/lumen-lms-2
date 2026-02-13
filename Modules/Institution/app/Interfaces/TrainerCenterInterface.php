<?php

namespace Modules\Institution\Interfaces;

use Illuminate\Support\Collection;
use Modules\Institution\Models\TrainerCenter;

interface TrainerCenterInterface
{
     public function all(): Collection;
     public function create(array $data): TrainerCenter;
     public function findByUuid(string $uuid): TrainerCenter;
     public function updateByUuid(string $uuid, array $data): TrainerCenter;
     public function deleteByUuid(string $uuid): bool;
}
