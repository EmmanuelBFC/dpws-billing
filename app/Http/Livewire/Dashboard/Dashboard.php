<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Weighbridge;
use Livewire\Component;

class Dashboard extends Component
{
    public $weighbridges;
    public function render()
    {
        return view('livewire.dashboard.dashboard');
    }

    public function mount(){

        $this->weighbridges = Weighbridge::all()->reject(function($bridge){
            return $bridge->label == "P05";
        });
    }
}
