<?php

namespace App\Http\Livewire\Invoice;


use App\Models\Invoice;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;
class MyInvoices extends Component
{
    use WithPagination;

    public $search_invoice_no_tractor_trailer, $data, $test;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['destroy'];


    public function render()
    {
        $id = auth()->user()->id;
        // $query = Invoice::where('user_id',$id);
        // $query->whereHas('myTractor', function($query){
        //     $query->where('label','LIKE',strtoupper("%$this->search_invoice_no_tractor_trailer%") );
        // })
        // ->orWhere(function($query) use ($id) {
        //     $query->where('invoice_no','LIKE',"%$this->search_invoice_no_tractor_trailer%");
        //     $query->where('user_id',$id);
        // });

        $query = Invoice::where('user_id',$id);

        // $searchTerm = strtoupper($this->search_invoice_no_tractor_trailer);
        if ($this->search_invoice_no_tractor_trailer !== null) {
            $searchTerm = strtoupper($this->search_invoice_no_tractor_trailer);
        } else {
            // Gérer le cas où la variable est null
            $searchTerm = ''; // ou une valeur par défaut, selon ton besoin
        }

        if ($searchTerm) {
            // Vérification si le terme correspond à une date au format "22/08/24"
            if (preg_match('/^\d{2}(\/\d{2})?(\/\d{2})?$/', $searchTerm)) {
                // Séparer les différentes parties de la date
                $dateParts = explode('/', $searchTerm);

                // Récupérer le jour
                $day = $dateParts[0];

                // Utiliser le mois courant si non spécifié
                $month = isset($dateParts[1]) ? $dateParts[1] : date('m');

                // Utiliser l'année courante si non spécifiée, en ajoutant "20" pour obtenir une année complète
                $year = isset($dateParts[2]) ? '20' . $dateParts[2] : date('Y');

                $formattedDate = "$year-$month-$day"; // Format "Y-m-d"

                // Recherche par date de création avec "LIKE"
                $query->where('created_at', 'LIKE', "%$formattedDate%");
            } elseif (strtolower($searchTerm) === 'paiement mobile') {
                // Filtrer par mode de paiement : Paiement Mobile (mode_payment_id = 1)
                $query->where('mode_payment_id', 1);
            } elseif (in_array(strtolower($searchTerm), ['espèce', 'espece']))  {
                // Filtrer par mode de paiement : Espèce (mode_payment_id = 2)
                $query->where('mode_payment_id', 2);
            } else {
                // Recherche par tracteur, client ou numéro de facture
                $query->whereHas('myTractor', function ($query) use ($searchTerm) {
                    $query->where('label', 'LIKE', "%$searchTerm%");
                })
                ->orWhereHas('customer', function ($query) use ($searchTerm) {
                    $query->where('label', 'LIKE', "%$searchTerm%");
                })
                ->orWhere('invoice_no', 'LIKE', "%$searchTerm%");
            }
        }


        return view('livewire.invoice.my-invoices',[

            'invoices' => $query->orderBy('created_at','DESC')->paginate(10),
        ]);
    }

    public function updating($name , $value)
    {
        if ($name === 'search_invoice_no_tractor_trailer')
           $this->resetPage();
    }

    public function mount(){

        $this->data = '';
    }
    public function getInvoice($id){

        $this->data = Invoice::where('id',$id)->first();

    }

    public function cancelInvoice(){

        try{
            tap($this->data)->update(['status_invoice' => 'cancelling']);
            $this->dispatchBrowserEvent('closeAlert');
            session()->flash('message', 'facture annulée.');
        }catch(\Exception $e){
            Log::error(sprintf('%d'.$e->getMessage(), __METHOD__));
            session()->flash('error', 'Une erreur c\'est produite lors de l\'annulation de la facture veuillez essayer à nouveau.');
        }
    }

    public function cancel(){

       $this->reset('data');
    }
}
