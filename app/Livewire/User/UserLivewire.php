<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Modules\Institution\Models\Center;
use Spatie\Permission\Models\Role;

class UserLivewire extends Component
{
    public $search = null;
    public $perPage = 13;

    public function render()
    {
        // $users = User::role(['Super Admin', 'Trainer'])->paginate($this->perPage);
        $users = User::role(['Super Admin', 'Trainer', 'Center Admin'])->paginate($this->perPage);
        $roles = Role::all();

        $centers = Center::all();

        return view('livewire.user.user-livewire', [
            'users' => $users,
            'rolelists' => $roles,
            'centers' => $centers
        ]);
    }

    public function saveUser() {}
}
