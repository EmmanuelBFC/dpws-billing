<?php

namespace App\Http\Livewire\Apurement;

use App\Models\Prediction;
use Livewire\Component;

class SearchContainer extends Component
{
    public $search;
    public function render()
    {

        return view('livewire.apurement.search-container',[
            'containers' => Prediction::where(function($q){
                        $q->orWhere('container_number', 'LIKE', strtoupper("%$this->search%"));
                        $q->orWhere('trailer', 'LIKE', strtoupper("%$this->search%"));
                        $q->orWhere('tractor', 'LIKE', strtoupper("%$this->search%"));
            })->where('weighing_status','En attente')
            ->paginate(10),
        ]);
    }
}
