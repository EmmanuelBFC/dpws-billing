<?php

namespace App\Http\Livewire\Checkpoint;

use Carbon\Carbon;
use App\Models\Invoice;
use App\Models\Prediction;
use Livewire\Component;

class Index extends Component
{
    public $search, $invoice, $entry, $exit, $type, $checkpoint_and_container = 'oui';
    public function render()
    {
        
        $query = Invoice::whereHas('myTractor', function ($query) {
                 $query->where('label', 'LIKE', strtoupper("%$this->search%"));
                 })->orWhereHas('myTrailer', function ($query) {
                $query->where('label', 'LIKE', strtoupper("%$this->search%"));
             })->orderByDesc('updated_at')->paginate(10);
        
        $this->type = 'invoice';
             if ($query->count() == 0){
                $query = Prediction::where(function($q){
                $q->orWhere('container_number', 'LIKE', strtoupper("%$this->search%"));
                        $q->orWhere('trailer', 'LIKE', strtoupper("%$this->search%"));
                        $q->orWhere('tractor', 'LIKE', strtoupper("%$this->search%"));
                 })->orderByDesc('updated_at')->paginate(10);
                 $this->type = 'container';
             }  


        return view('livewire.checkpoint.index', [
            'invoices' => $query
        ]);
    }

    public function mount()
    {
        $this->invoice = '';
        $this->fill(['entry' => 'entree', 'exit' => 'sortie']);
    }
    public function getId($id)
    {

        $this->invoice = '';
        $invoice = Invoice::where('id', $id)->first();
      //  dd($invoice);
        if (is_null($invoice))
            throw new \Exception("impossible de retrouver cette facture", 1);

        $this->invoice = $invoice;
    }

    public function storeEntry()
    {
        $update =    tap($this->invoice)->update([
            'seen_entry_control' => 'oui',
            'name_controleur_input' => auth()->user()->name,
            'date_entry' => Carbon::now(),
        ]);
        $this->invoice = '';
        dd($update);
        session()->flash('success', 'validé en entrée');
    }

    public function storeExit(){
            tap($this->invoice)->update([
                'seen_exit_control' => 'oui',
                'name_controleur_ouput' => auth()->user()->name,
                'date_exit' => Carbon::now(),
            ]);
            $this->invoice = '';
        session()->flash('success', 'Validé en sortie');
    }
}
