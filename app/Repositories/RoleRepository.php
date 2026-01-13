<?php

namespace App\Repositories;

use App\Interfaces\RoleInterface;
use Illuminate\Database\Eloquent\Collection;
use Spatie\Permission\Models\Role;

class RoleRepository implements RoleInterface
{
     public function handle() {}

     public function all(): Collection
     {
          return Role::latest()->get();
     }

     public function create(array $data): Role
     {
          return Role::create($data);
     }

     public function findById(string $id): Role
     {
          return Role::where('id', $id)->firstOrFail();
     }

     public function updateById(string $id, array $data): Role
     {
          $item = $this->findById($id);
          $item->update($data);

          return $item;
     }

     public function deleteById(string $id): bool
     {
          $item = $this->findById($id);
          return $item->delete();
     }
}
