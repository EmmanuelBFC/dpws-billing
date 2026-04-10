<?php

// namespace App\Http\Livewire\Invoice;

// use App\Models\Invoice;
// use Livewire\Component;
// use Illuminate\Support\Facades\Log;
// use Livewire\WithPagination;
namespace App\Http\Livewire\Invoice;
use App\Exports\InvoicesExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Invoice;
use Livewire\Component;
use Illuminate\Support\Facades\Log;
use Livewire\WithPagination;
use Carbon\Carbon;

class AllInvoices extends Component
{
    // use WithPagination;
    // protected $paginationTheme = 'bootstrap';
    // public  $search_invoice_no_tractor_trailer, $data;
    // public function render()
    // {

    //     $query = Invoice::query();

    //     $searchTerm = strtoupper($this->search_invoice_no_tractor_trailer);

    //     if ($searchTerm) {
    //         // Vérification si le terme correspond à une date au format "22/08/24"
    //         if (preg_match('/^\d{2}(\/\d{2})?(\/\d{2})?$/', $searchTerm)) {
    //             // Séparer les différentes parties de la date
    //             $dateParts = explode('/', $searchTerm);

    //             // Récupérer le jour
    //             $day = $dateParts[0];

    //             // Utiliser le mois courant si non spécifié
    //             $month = isset($dateParts[1]) ? $dateParts[1] : date('m');

    //             // Utiliser l'année courante si non spécifiée, en ajoutant "20" pour obtenir une année complète
    //             $year = isset($dateParts[2]) ? '20' . $dateParts[2] : date('Y');

    //             $formattedDate = "$year-$month-$day"; // Format "Y-m-d"

    //             // Recherche par date de création avec "LIKE"
    //             $query->where('created_at', 'LIKE', "%$formattedDate%");
    //         } elseif (strtolower($searchTerm) === 'paiement mobile') {
    //             // Filtrer par mode de paiement : Paiement Mobile (mode_payment_id = 1)
    //             $query->where('mode_payment_id', 1);
    //         } elseif (in_array(strtolower($searchTerm), ['espèce', 'espece']))  {
    //             // Filtrer par mode de paiement : Espèce (mode_payment_id = 2)
    //             $query->where('mode_payment_id', 2);
    //         } else {
    //             // Recherche par tracteur, client ou numéro de facture
    //             $query->whereHas('myTractor', function ($query) use ($searchTerm) {
    //                 $query->where('label', 'LIKE', "%$searchTerm%");
    //             })
    //             ->orWhereHas('customer', function ($query) use ($searchTerm) {
    //                 $query->where('label', 'LIKE', "%$searchTerm%");
    //             })
    //             ->orWhere('invoice_no', 'LIKE', "%$searchTerm%");
    //         }
    //     }

    //     return view('livewire.invoice.all-invoices',[
    //         'invoices' => $query->orderBy('created_at','DESC')->paginate(10),
    //     ]);
    // }
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    // public $search_invoice_no_tractor_trailer;
    use WithPagination;
    public $search_invoice_no_tractor_trailer = '', $data;
    public $startDate;
    public $endDate;

    public function render()
    {
        // $this->search_invoice_no_tractor_trailer = '';
        // $query = Invoice::query();

        // // $searchTerm = strtoupper(trim($this->search_invoice_no_tractor_trailer));
        // $searchTerm = strtoupper(trim($this->search_invoice_no_tractor_trailer ?? ''));

        // // Filtrage par date
        // if ($this->startDate && $this->endDate) {
        //     $start = Carbon::parse($this->startDate)->startOfDay();
        //     $end = Carbon::parse($this->endDate)->endOfDay();
        //     $query->whereBetween('created_at', [$start, $end]);
        // }
        $query = Invoice::query();

        $searchTerm = strtoupper(trim($this->search_invoice_no_tractor_trailer));

        // Filtrage par date
        if ($this->startDate && $this->endDate) {
            $start = Carbon::parse($this->startDate)->startOfDay();
            $end = Carbon::parse($this->endDate)->endOfDay();
            $query->whereBetween('created_at', [$start, $end]);
        }

        // Filtrage par mot-clé
        if (!empty($searchTerm)) {
            $query->where(function ($q) use ($searchTerm) {
                if (preg_match('/^\d{2}\/\d{2}(\/\d{2})?$/', $searchTerm)) {
                    // Format date (ex: 28/08 ou 28/08/23)
                    $parts = explode('/', $searchTerm);
                    $day = $parts[0];
                    $month = $parts[1] ?? date('m');
                    $year = isset($parts[2]) ? '20' . $parts[2] : date('Y');
                    $formatted = "$year-$month-$day";

                    $q->whereDate('created_at', $formatted);
                } elseif (strtolower($searchTerm) === 'paiement mobile') {
                    $q->where('mode_payment_id', 1);
                } elseif (in_array(strtolower($searchTerm), ['espèce', 'espece'])) {
                    $q->where('mode_payment_id', 2);
                } else {
                    // Recherche générique
                    $q->where('invoice_no', 'like', "%$searchTerm%")
                    ->orWhereHas('myTractor', fn($subQ) => $subQ->where('label', 'like', "%$searchTerm%"))
                    ->orWhereHas('myTrailer', fn($subQ) => $subQ->where('label', 'like', "%$searchTerm%"))
                    ->orWhereHas('customer', fn($subQ) => $subQ->where('label', 'like', "%$searchTerm%"));
                }
            });
        }

        return view('livewire.invoice.all-invoices', [
            'invoices' => $query->orderBy('created_at', 'DESC')->paginate(10),
        ]);
    }

    public function renitialize()
    {
        $this->startDate = null;
        $this->endDate = null;
        $this->search_invoice_no_tractor_trailer = '';
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

    public function exportExcel(){
        $query = Invoice::query();
        // $searchTerm = strtoupper(trim($this->search_invoice_no_tractor_trailer));
        $searchTerm = strtoupper(trim($this->search_invoice_no_tractor_trailer ?? ''));

        if ($this->startDate && $this->endDate) {
            $start = Carbon::parse($this->startDate)->startOfDay();
            $end = Carbon::parse($this->endDate)->endOfDay();
            $query->whereBetween('created_at', [$start, $end]);
        }

        if (!empty($searchTerm)) {
            $query->where(function ($q) use ($searchTerm) {
                if (preg_match('/^\d{2}\/\d{2}(\/\d{2})?$/', $searchTerm)) {
                    $parts = explode('/', $searchTerm);
                    $day = $parts[0];
                    $month = $parts[1] ?? date('m');
                    $year = isset($parts[2]) ? '20' . $parts[2] : date('Y');
                    $formatted = "$year-$month-$day";

                    $q->whereDate('created_at', $formatted);
                } elseif (strtolower($searchTerm) === 'paiement mobile') {
                    $q->where('mode_payment_id', 1);
                } elseif (in_array(strtolower($searchTerm), ['espèce', 'espece'])) {
                    $q->where('mode_payment_id', 2);
                } else {
                    $q->where('invoice_no', 'like', "%$searchTerm%")
                        ->orWhereHas('myTractor', fn($subQ) => $subQ->where('label', 'like', "%$searchTerm%"))
                        ->orWhereHas('customer', fn($subQ) => $subQ->where('label', 'like', "%$searchTerm%"));
                }
            });
        }

        return Excel::download(new InvoicesExport($query), 'invoices.xlsx');
    }
}
