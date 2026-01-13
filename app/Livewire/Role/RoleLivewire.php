<?php

namespace App\Livewire\Role;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleLivewire extends Component
{
    public $search = '';
    public $perPage = 13;

    public function render()
    {
        $permissions = Permission::all();
        $roles = Role::with('permissions')
            ->where('name', 'like', '%' . $this->search . '%')
            ->paginate($this->perPage);

        return view('livewire.role.role-livewire', [
            'roles' => $roles,
            'permissions' => $permissions
        ]);
    }
}
