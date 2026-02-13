<?php

namespace App\Livewire\Institution;

use Livewire\Component;
use Modules\Institution\Models\TrainerCenter;

class CenterTrainerLivewire extends Component
{
    public $search = '';
    public $pageCount = 10;

    public function render()
    {
        $trainerCenters = TrainerCenter::query()
            ->select([
                'centers.id as center_id',
                'centers.name as center_name',
                'centers.code as center_code',
                'users.id as user_id',
                'users.full_name_searchable',
            ])
            ->join('centers', 'centers.id', '=', 'trainer_centers.center_id')
            ->join('users', 'users.id', '=', 'trainer_centers.trainer_id')

            ->when($this->search, function ($query) {
                $query->where('users.full_name_searchable', 'like', '%' . $this->search . '%');
            })
            ->paginate($this->pageCount);

        return view('livewire.institution.center-trainer-livewire', ['trainerCenters' => $trainerCenters]);
    }
}
