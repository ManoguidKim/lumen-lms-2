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
    public bool $isOpenModal = false;

    public $userName = null;
    public $userEmail = null;
    public $userPassword = null;
    public $userRole = null;

    public function toggleModal()
    {
        if ($this->isOpenModal === true) $this->isOpenModal = false;
        else $this->isOpenModal = true;
    }

    public function render()
    {
        if (auth()->user()->role('Super Admin')) {
            $users = User::role(['Super Admin', 'Trainer'])->paginate($this->perPage);
            $roles = Role::all();
        }

        $centers = Center::all();

        return view('livewire.user.user-livewire', [
            'users' => $users,
            'rolelists' => $roles,
            'centers' => $centers
        ]);
    }
}
