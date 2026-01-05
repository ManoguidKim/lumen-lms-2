<?php

namespace App\Livewire\Institution;

use Livewire\Component;
use Modules\Institution\Models\Center;

class CenterLivewire extends Component
{
    public $search = '';
    public $perPage = 13;

    public function render()
    {
        $centers = Center::where('name', 'like', "%{$this->search}%")->paginate(13);
        return view('livewire.institution.center-livewire', compact('centers'));
    }
}
