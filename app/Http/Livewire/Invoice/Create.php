<?php

namespace App\Http\Livewire\Invoice;


use App\Helpers\Numbers\MoneyHelper;
use App\Models\Tractor;
use App\Models\Trailer;
use App\Models\TypeWeighing;
use Livewire\Component;
use App\Models\Customer;
use App\Models\ModePayment;
use App\Models\Weighbridge;
use App\Services\InvoiceService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class Create extends Component
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
           $id_invoice_with_coupon = null,
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
           $selectedTrailer = null;

    public bool  $isRefunded = false ;

    public array $tractors = [],
                 $trailers = [],
                 $customers = []
                ;

    public int   $selectedTractor = 0,
                 $selectedCustomer = 0,
                 $highlightIndex = 0,
                 $highlightIndexTrailer = 0,
                 $highlightIndexCustomer = 0,
                 $bridge_id = 0;

    public bool  $showDropdown1 = true,
                 $showDropdown2 = true,
                 $showDropdown3 = true;

    // public function render()
    // {
    //     return view('livewire.invoice.create',[
    //         'modePayments' => ModePayment::all()->reject(function($mode){
    //             return $mode->label == "Virement Bancaire";}),

    //         'recups' => Customer::where('label','like', '%' . strtoupper($this->trailer). '%')->first(),
    //         'bridges' => Weighbridge::whereIn('label', ['P18', 'P19'])->get()

    //         ]);
    // }

    public function render()
    {
        // Vérifier si l'utilisateur est un Chef Guerite
        if (Auth::user()->isChefGuerite()) {
            $modePayments = ModePayment::all()->reject(function ($mode) {
                return $mode->label == "Virement Bancaire" || $mode->label == "Paiement Mobile";
            });
        } else {
            $modePayments = ModePayment::all()->reject(function ($mode) {
                return $mode->label == "Virement Bancaire";
            });
        }

        return view('livewire.invoice.create', [
            'modePayments' => $modePayments,
            'recups' => Customer::where('label', 'like', '%' . strtoupper($this->trailer) . '%')->first(),
            'bridges' => Weighbridge::whereIn('label', ['P18', 'P19'])->get(),
        ]);
    }

    //hiden dropdown customer
    public function hideDropdown1()
    {
        $this->showDropdown1 = false;
    }
    //hiden dropdown tractor
   public function hideDropdown2()
    {
        $this->showDropdown2 = false;
    }
   // hiden dropdown trailer
   public function hideDropdown3()
    {
        $this->showDropdown3 = false;
    }


    public function incrementHighlight()
    {
        if ($this->highlightIndex === count($this->tractors) - 1) {
            $this->highlightIndex = 0;
            return;
        }
        $this->highlightIndex++;
    }
    public function incrementHighlightTrailer()
    {
        if ($this->highlightIndexTrailer === count($this->trailers) - 1) {
            $this->highlightIndexTrailer = 0;
            return;
        }
        $this->highlightIndexTrailer++;
    }

    public function incrementHighlightCustomer()
    {
        if ($this->highlightIndexCustomer === count($this->customers) - 1) {
            $this->highlightIndexCustomer = 0;
            return;
        }
        $this->highlightIndexCustomer++;
    }



    public function decrementHighlight()
    {
        if ($this->highlightIndex === 0) {
            $this->highlightIndex = count($this->tractors) - 1;
            return;
        }

        $this->highlightIndex--;
    }

    public function decrementHighlightTrailer()
    {
        if ($this->highlightIndexTrailer === 0) {
            $this->highlightIndexTrailer = count($this->trailers) - 1;
            return;
        }

        $this->highlightIndexTrailer--;
    }


    public function decrementHighlightCustomer()
    {
        if ($this->highlightIndexCustomer === 0) {
            $this->highlightIndexCustomer = count($this->customers) - 1;
            return;
        }

        $this->highlightIndexCustomer--;
    }


    public function selectTractor($id = null)
    {
        $id = $id ?: $this->highlightIndex;

        $tractor = $this->tractors[$id] ?? null;

        if ($tractor) {
            $this->showDropdown2 = true;
            $this->tractor = $tractor['label'];
            $this->selectedTractor = $tractor['id'];

            // on masque la liste group
            $this->hiddenTractor = "hidden";
        }
    }
    public function selectTrailer($id = null)
    {
        $id = $id ?: $this->highlightIndexTrailer;

        $trailer = $this->trailers[$id] ?? null;

        if ($trailer) {
            $this->showDropdown3 = true;
            $this->trailer = $trailer['label'];
            $this->selectedTrailer = $trailer['id'];

            // on masque la liste group
            $this->hiddenTrailer = "hidden";
        }
    }

    public function selectCustomer($id = null)
    {
        $id = $id ?: $this->highlightIndexCustomer;

        $customer = $this->customers[$id] ?? null;

        if ($customer) {
            $this->showDropdown1 = true;
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
            $this->selectedTractor = 0;
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

    public function mount()
    {
        if(Auth::user()->isAdmin() || Auth::user()->isAdministration()){
            $this->weighbridge = '';
        }else{
            $bridge = Weighbridge::where('id',Auth::user()->currentBridge)->first();
            $this->weighbridge = $bridge->label;
            $this->bridge_id = $bridge->id;
        }
            $this->listTypeWeighing = TypeWeighing::where('type','Port')->orderByDesc('created_at')->get();
    }

    public function updatedTypeWeighing()
    {

        if($this->typeWeighing == ""){
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
           return 0;
    }

    protected $rules = [
        'customer' => 'required',
        'tractor' => 'required',
        // 'trailer' => 'required',
        'modePaymentId' => 'required',
        'amountPaid' => 'required',
        'typeWeighing' => 'required',
    ];

    protected $messages = [
        'customer.required' => 'veuillez saisir le nom du client',
        'tractor.required' => 'veuillez saisir le numero du tracteur',
        // 'trailer.required' => 'veuillez saisir le numero de la remorque',
        'modePaymentId.required' => 'veuillez selectionner le mode de paiment',
        'amountPaid.required' => 'veuillez saisir le montant',
        'typeWeighing.required' => 'veuillez selectionner la pesée',

    ];

    public function store(){
        $this->validate();

                if ($this->bridge_id == 5 && empty($this->trailer)) {
                    return $this->addError('trailer', 'Veuillez saisir le numéro du conteneur.');
                }

                if ($this->selectedCustomer == 0)
                    return $this->addError('customer', '.veuillez selectionner le client sur la liste déroulante et non ecrire le nom client');

                if ($this->selectedTractor == 0)
                    return $this->addError('tractor', 'veuillez selectionner le tracteur sur la liste déroulante et non ecrire le nom du tracteur');

                if ($this->remains < 0)
                    return $this->addError('amountPaid', 'veuillez saisir un montant correct');


              //  dd($this->id_invoice);
                if(!$this->isRefunded && $this->remains !=0)
                {
                    $this->id_invoice_with_coupon =  InvoiceService::storeInvoice($this->subtotal,
                                                                                $this->tax_amount,
                                                                                $this->total_amount,
                                                                                $this->modePaymentId,
                                                                                $this->bridge_id,
                                                                                $this->amountPaid,
                                                                                $this->remains,
                                                                                auth()->id(),
                                                                                $this->selectedCustomer,
                                                                                $this->type->id,
                                                                                $this->isRefunded,
                                                                                $this->selectedTrailer,
                                                                                $this->selectedTractor,
                                                                                false );
                    $this->dispatchBrowserEvent('invoiceWithCoupon');
                    session()->flash('message', 'facture enregistrée avec succès.');
                    $this->emptyField();
                }else{
                    $this->id_invoice =  InvoiceService::storeInvoice($this->subtotal,
                                                                        $this->tax_amount,
                                                                        $this->total_amount,
                                                                        $this->modePaymentId,
                                                                        $this->bridge_id,
                                                                        $this->amountPaid,
                                                                        $this->remains,
                                                                        auth()->id(),
                                                                        $this->selectedCustomer,
                                                                        $this->type->id,
                                                                        $this->isRefunded,
                                                                        $this->selectedTrailer,
                                                                        $this->selectedTractor,
                                                                        false );
                    $this->dispatchBrowserEvent('closeAlert');
                    session()->flash('message', 'facture enregistrée avec succès .');
                    $this->emptyField();
                }

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
            $data = Tractor::create(['label' => str_replace(" ",'',strtoupper($this->newTractor))]);
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

            $data = Trailer::create(['label'=> str_replace(" ",'',strtoupper($this->newTrailer))]);
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
    public function closeModalWithCoupon(){

        $this->id_invoice_with_coupon = null;
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

        $this->modePaymentId = null;
        $this->weighbridgeId = null;
        $this->amountPaid = null;
        $this->remains = null;
        $this->tractors = [];
        $this->customers = [];
        $this->trailers = [];
        $this->highlightIndex = 0;
        $this->highlightIndexTrailer = 0;
        $this->highlightIndexCustomer = 0;
        $this->tractor = '';
        $this->trailer = '';
        $this->customer = '';
        $this->selectedTractor = 0;
        $this->selectedTrailer = null;
        $this->selectedCustomer = 0;
        $this->showDropdown1 = true;
        $this->showDropdown2 = true;
        $this->showDropdown3 = true;
        $this->typeWeighing = null;
        $this->total_amount = 0;
        $this->isRefunded = false;
    }
}
