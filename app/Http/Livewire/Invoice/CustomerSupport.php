<?php

namespace App\Http\Livewire\Invoice;

use App\Models\Tractor;
use App\Models\Trailer;
use Livewire\Component;
use App\Models\Customer;
use App\Models\ModePayment;
use App\Models\Weighbridge;
use App\Models\TypeWeighing;
use App\Services\InvoiceService;
use Illuminate\Support\Facades\Auth;


class CustomerSupport extends Component
{
    public ?int
            $modePaymentId = null,
            $weighbridgeId = null,
            $tax_amount = 0,
            $subtotal = 0,
            $total_amount = 0;


    public $amountPaid = null ,
           $remains = 0,
           $weighedTest = false,
           $id_invoice= null,
           $newTractor = null,
           $newTrailer = null,
           $newCustomer = null,
           $tractor = '',
           $trailer = '',
           $customer = '',
           $weighbridge = null,
           $listTypeWeighing = null,
           $typeWeighing = null,
           $type = null,
           $test = null,
           $hiddenCustomer = "",
           $hiddenTractor = "",
           $hiddenTrailer = "",
           $selectedTrailer = null,
           $selectedTractor = null,
           $who_paid_back = "",
           $deposit = false
           ;

    public bool  $isRefunded = true ;

    public array $tractors = [],
                 $trailers = [],
                 $customers = [];

    public int   $selectedCustomer = 0,
                 $bridge_id = 0;


    public function render()
    {
        return view('livewire.invoice.customer-support',[
            'modePayments' => ModePayment::orderByDesc('created_at')->get(),

        ]);
    }


    public function selectTractor($id = null)
    {
        $tractor = $this->tractors[$id] ?? null;

        if ($tractor) {
            $this->tractor = $tractor['label'];
            $this->selectedTractor = $tractor['id'];

            // on masque la liste group
            $this->hiddenTractor = "hidden";
        }
    }
    public function selectTrailer($id = null)
    {

        $trailer = $this->trailers[$id] ?? null;

        if ($trailer) {
            $this->trailer = $trailer['label'];
            $this->selectedTrailer = $trailer['id'];

            // on masque la liste group
            $this->hiddenTrailer = "hidden";
        }
    }

    public function selectCustomer($id = null)
    {

        $customer = $this->customers[$id] ?? null;

        if ($customer) {
            $this->customer = $customer['label'];
            $this->selectedCustomer = $customer['id'];

            // on masque la liste group
            $this->hiddenCustomer = "hidden";
        }
    }

    public function updatedTractor()
    {
        //en cas de modification on l'affiche
        $this->hiddenTractor = "";
        $this->tractors = Tractor::where('label', 'like', '%' . strtoupper($this->tractor). '%')
            ->take(4)
            ->get()
            ->toArray();

        if ($this->tractor != null){
            $this->selectedTractor = null;
        }
    }

    public function updatedTrailer()
    {
        //en cas de modification on l'affiche
        $this->hiddenTrailer = "";

        $this->trailers = Trailer::where('label', 'like', '%' . strtoupper($this->trailer). '%')
            ->take(4)
            ->get()
            ->toArray();

        if ($this->trailer != null){
            $this->selectedTrailer = null;
        }
    }

    public function updatedCustomer()
    {
        //en cas de modification on l'affiche
        $this->hiddenCustomer = "";

        $this->customers = Customer::where('label', 'like', '%' . strtoupper($this->customer). '%')
            ->take(7)
            ->get()
            ->toArray();
        if ($this->customer != null){
            $this->selectedCustomer = 0;
        }
    }

    public function updatedDeposit(){

        $this->tax_amount = 0;
        $this->subtotal = 0;
        $this->total_amount = 0;
        $this->type = null;
       // $this->deposit = true;
    }

    public function mount()
    {
        if(Auth::user()->isAdmin() || Auth::user()->isAdministration()){
            $this->weighbridge = '';
        }else{
            $bridge = Weighbridge::where('label','Direction')->first();
            $this->weighbridge = $bridge->label;
            $this->bridge_id = $bridge->id;
        }
            $this->listTypeWeighing = TypeWeighing::where('type','Direction')->orderByDesc('created_at')->get();
    }



    public function updatedTypeWeighing()
    {

        if($this->typeWeighing === ""){
            $this->reset(['tax_amount','subtotal','total_amount']);
            return 0;
        }

        $this->type = TypeWeighing::where('id',$this->typeWeighing)->first();

        $this->subtotal = $this->type->price;
        $this->tax_amount = $this->type->tax_amount;
        $this->total_amount = $this->type->total_amount;

        if ($this->amountPaid != "" )
            $this->remains =  $this->amountPaid - $this->total_amount;

    }

    public function updatedAmountPaid(){

        if ($this->deposit)
            return 0;

        if ($this->amountPaid != "" )
            $this->remains =  $this->amountPaid - $this->total_amount;
    }

    public function updatedisRefunded(){

        if ($this->isRefunded)
            $this->remains = 0;

        if (!$this->isRefunded)
            $this->remains =  $this->amountPaid - $this->total_amount;
    }
    public function updated(){

        if ($this->amountPaid == "")
            $this->remains = 0;

        if ($this->bridge_id == "")
            exit();
    }

    // le tractor et le trailer ne sont plus obligatoire
    protected $rules = [
        'customer' => 'required',
        // 'tractor' => 'required',
        // 'trailer' => 'required',
        'modePaymentId' => 'required',
        'amountPaid' => 'required',
        'typeWeighing' => 'required',
    ];

    protected $messages = [
        'customer.required' => 'veuillez saisir le nom du client',
        // 'tractor.required' => 'veuillez saisir le numero du tracteur',
        // 'trailer.required' => 'veuillez saisir le numero de la remorque',
        'modePaymentId.required' => 'veuillez selectionner le mode de paiement',
        'amountPaid.required' =>    'veuillez saisir le montant',
        'typeWeighing.required' => 'veuillez selectionner la pesée',
    ];



    public function store() {

        if ($this->deposit){
            $this->validate([
                'customer' => 'required',
                'modePaymentId' => 'required',
                'amountPaid' => 'required',
            ]);
        }else{
         $this->validate();
        }

                if ($this->selectedCustomer == 0)
                    return $this->addError('customer', '.veuillez selectionner le client sur la liste déroulante et non ecrire le nom client');


                $this->id_invoice =  InvoiceService::storeInvoice($this->subtotal,
                                                                  $this->tax_amount,
                                                                  $this->total_amount,
                                                                  $this->modePaymentId,
                                                                  $this->bridge_id,
                                                                  $this->amountPaid,
                                                                  $this->remains,
                                                                  auth()->id(),
                                                                  $this->selectedCustomer,
                                                                  is_null(optional($this->type)->id) ? 0 : $this->type->id, // type de pesée
                                                                  $this->isRefunded,
                                                                  $this->selectedTrailer,
                                                                  $this->selectedTractor,
                                                                  $this->who_paid_back,
                                                                  true,
                                                                  $this->deposit);

                session()->flash('message', 'facture enregistreé avec succès.');
                $this->dispatchBrowserEvent('closeAlert');
                $this->emptyField();

    }

    public function cancelCustomer(){

        $this->customer = '';
    }
    public function cancelTractor(){

        $this->newTractor = "";
    }
    public function cancelTrailer(){

        $this->newTrailer = "";
    }

    public function storeTractor(){

        if ($this->newTractor == "")
            return 0;
        try {
           $data = Tractor::create(['label' => strtoupper($this->newTractor)]);
            $this->newTractor = "";
            $this->tractors[] = $data;

            session()->flash('new-tractor', 'Tracteur enregistré avec succès.');

        }catch (\Illuminate\Database\QueryException $e){

            if ($e->getCode() == 23505)
                session()->flash('error-tractor', 'vous essayez d\'ajouter un client qui existe déjà, si besoin actualiser le navigateur.');

            if ($e->getCode() != 23505)
                session()->flash('error-tractor', 'une erreur est survenu, veuillez actualiser le navigateur si besoin rapprochez-vous d\'un IT.');
        }
        catch(\Exception $e){
            session()->flash('error-tractor', 'une erreur est survenu, veuillez actualiser le navigateur si besoin rapprochez-vous d\'un IT.');
        }

}

    public function storeTrailer(){

    try {

        if ($this->newTrailer == "")
            return 0;

        $data = Trailer::create(['label'=> strtoupper($this->newTrailer)]);
        $this->newTrailer = "";
        $this->trailers[] = $data;
        session()->flash('new-trailer', 'remorque enregistré avec succès.');
    }catch (\Illuminate\Database\QueryException $e){

        if ($e->getCode() == 23505)
            session()->flash('error-trailer', 'vous essayez d\'ajouter un client qui existe déjà, si besoin actualiser le navigateur.');

        if ($e->getCode() != 23505)
            session()->flash('error-trailer', 'une erreur est survenu, veuillez actualiser le navigateur si besoin rapprochez-vous d\'un IT.');
    }
    catch(\Exception $e){
        session()->flash('error-trailer', 'une erreur est survenu, veuillez actualiser le navigateur si besoin rapprochez-vous d\'un IT.');
    }

}

    public function storeCustomer(){

    try {
        if ($this->newCustomer == "")
            return 0;

        $data = Customer::create(['label'=> strtoupper($this->newCustomer)]);
        $this->newCustomer = "";
        $this->customers[] = $data;
        session()->flash('new-customer', 'client enregistré avec succès.');

    }catch (\Illuminate\Database\QueryException $e){

        if ($e->getCode() == 23505)
              session()->flash('error-customer', 'vous essayez d\'ajouter un client qui existe déjà, si besoin actualiser le navigateur.');

        if ($e->getCode() != 23505)
            session()->flash('error-customer', 'une erreur est survenu, veuillez actualiser le navigateur si besoin rapprochez-vous d\'un IT.');
    }
    catch(\Exception $e){
        session()->flash('error-customer', 'une erreur est survenu, veuillez actualiser le navigateur si besoin rapprochez-vous d\'un IT.');
    }
}

    public function closeModal(){

        $this->id_invoice = null;
    }

    public function getCustomer(){

        if ($this->selectedCustomer == 0){
            $this->newCustomer = $this->customer;
        }
        if($this->selectedCustomer != 0){
            $this->newCustomer = '';
        }
    }
    public function getTractor(){

        if ($this->selectedTractor == 0){
            $this->newTractor = $this->tractor;
        }
        if($this->selectedTractor != 0){
            $this->newTractor = '';
        }
    }
    public function getTrailer(){

        if ($this->selectedTrailer == null){
            $this->newTrailer = $this->trailer;
        }
        if ($this->selectedTrailer != 0){
            $this->newTrailer = '';
        }
    }

    protected function emptyField(){

        $this->reset(['tax_amount','subtotal']);

        $this->reset(['tax_amount','subtotal']);

        $this->modePaymentId = null;
        $this->weighbridgeId = null;
        $this->amountPaid = null;
        $this->remains = null;
        $this->tractors = [];
        $this->customers = [];
        $this->trailers = [];
        $this->tractor = '';
        $this->trailer = '';
        $this->customer = '';
        $this->selectedTractor = null;
        $this->selectedTrailer = null;
        $this->selectedCustomer = 0;
        $this->typeWeighing = null;
        $this->total_amount = 0;
      //  $this->isRefunded = true;
    }
}
