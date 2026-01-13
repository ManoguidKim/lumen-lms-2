<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Spatie\Permission\Models\Role;

interface RoleInterface
{
    public function all(): Collection;
    public function create(array $data): Role;
    public function findById(string $id): Role;
    public function updateById(string $id, array $data): Role;
    public function deleteById(string $id): bool;
}
