<div>
    <div class="form-elements-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <!-- input style start -->
                <div class="card-style mb-30">
                    <h6 class="mb-25">Facturation</h6>
                    <div class="row">
                        <div class="input-style-1">
                            <label>Reçu de <span class="text-danger" >*</span> <a wire:click="getCustomer" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#Modalfive">
                                    Ajouter un client</a> </label>
                            <input type="text" placeholder="Rechercher un client..." wire:model.debounce.500ms="customer" />

                            <div wire:loading.flex wire:target="customer">
                                <div class="d-flex justify-content-center">
                                    <div class="spinner-border" role="status">
                                        <span class="visually-hidden">chargement...</span>
                                    </div>
                                </div>
                            </div>

                            <div class="absolute z-10 mt-1 w-full text-sm overflow-auto px-2" wire:loading.remove>
                                <ul class="list-group">
                                    @if (empty($customers) && $customer != '')
                                        pas de resultat
                                    @else
                                        @if (!empty($customers) && $customer != '')
                                            @foreach ($customers as $i => $customer)
                                                <a href="javascript:void(0)"
                                                   wire:click="selectCustomer({{ $i }})"
                                                   class="list-group-item list-group-item-action"
                                                    {{ $hiddenCustomer }}>{{ $customer['label'] }}
                                                </a>
                                            @endforeach
                                        @endif
                                    @endif
                                </ul>
                            </div>

                            @error('customer')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <div class="input-style-1">
                                <label>N° Tracteur  <span class="text-danger" >*</span> <a wire:click="getTractor" href="javascript:void(0)" data-bs-toggle="modal"
                                                      data-bs-target="#ModalTree"> Ajouter un tracteur</a> </label>
                                <input type="text" placeholder="Rechercher le tracteur..." wire:model.debounce.500ms="tractor" />

                                <div wire:loading.flex wire:target="tractor">
                                    <div class="d-flex justify-content-center">
                                        <div class="spinner-border" role="status">
                                            <span class="visually-hidden">chargement...</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="absolute z-10 mt-1 w-full text-sm overflow-auto px-2" wire:loading.remove>
                                    <ul class="list-group">
                                        @if (empty($tractors) && $tractor != '')
                                            pas de resultat
                                        @else
                                            @if (!empty($tractors) && $tractor != '')
                                                @foreach ($tractors as $i => $tractor)
                                                    <a href="javascript:void(0)"
                                                       wire:click="selectTractor({{ $i }})"
                                                       class="list-group-item list-group-item-action"
                                                        {{ $hiddenTractor }}>{{ $tractor['label'] }}
                                                    </a>
                                                @endforeach
                                            @endif
                                        @endif
                                    </ul>
                                </div>
                                @error('tractor')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- <div class="col-md-6">
                            <div class="input-style-1">
                                <label>N° Remorque <a wire:click="getTrailer" href="javascript:void(0)" data-bs-toggle="modal"
                                                      data-bs-target="#Modalfour"> Ajouter une remorque</a> </label>
                                <input type="text" placeholder="Rechercher la remorque..." wire:model.debounce.500ms="trailer" />

                                <div wire:loading.flex wire:target="trailer">
                                    <div class="d-flex justify-content-center">
                                        <div class="spinner-border" role="status">
                                            <span class="visually-hidden">chargement...</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="absolute z-10 mt-1 w-full text-sm overflow-auto px-2">
                                    <ul class="list-group">
                                        @if (empty($trailers) && $trailer != '')
                                            pas de resultat
                                        @else
                                            @if (!empty($trailer) && $trailer != '')
                                                @foreach ($trailers as $i => $trailer)
                                                    <a href="javascript:void(0)"
                                                       wire:click="selectTrailer({{ $i }})"
                                                       class="list-group-item list-group-item-action"
                                                        {{ $hiddenTrailer }}>{{ $trailer['label'] }}
                                                    </a>
                                                @endforeach
                                            @endif
                                        @endif
                                    </ul>
                                </div>
                                @error('trailer')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div> -->
                        <div class="col-md-6">
                            <div class="input-style-1">
                                <label>
                                    N° Conteneur
                                    @if(Auth::user()->currentBridge == 5) <span class="text-danger" >*</span>  @endif 
                                    <a wire:click="getTrailer" href="javascript:void(0)" data-bs-toggle="modal"
                                       data-bs-target="#Modalfour"> Ajouter un conteneur
                                    </a>
                                </label>
                                <input type="text" placeholder="Rechercher la conteneur..." wire:model.debounce.500ms="trailer"
                                       @if(Auth::user()->currentBridge == 7) required @endif />

                                <div wire:loading.flex wire:target="trailer">
                                    <div class="d-flex justify-content-center">
                                        <div class="spinner-border" role="status">
                                            <span class="visually-hidden">chargement...</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="absolute z-10 mt-1 w-full text-sm overflow-auto px-2">
                                    <ul class="list-group">
                                        @if (empty($trailers) && $trailer != '')
                                            <li class="list-group-item">Pas de résultat</li>
                                        @else
                                            @if (!empty($trailer) && $trailer != '')
                                                @foreach ($trailers as $i => $trailer)
                                                    <a href="javascript:void(0)"
                                                       wire:click="selectTrailer({{ $i }})"
                                                       class="list-group-item list-group-item-action"
                                                       {{ $hiddenTrailer }}>{{ $trailer['label'] }}
                                                    </a>
                                                @endforeach
                                            @endif
                                        @endif
                                    </ul>
                                </div>
                                @error('trailer')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="select-style-1">
                                <label>Mode paiement  <span class="text-danger" >*</span></label>
                                <div class="select-position">
                                    <select wire:model="modePaymentId">
                                        <option value="" selected>Selectionner le mode</option>
                                        @foreach ($modePayments as $modePayment)
                                            <option value="{{ $modePayment->id }}">{{ $modePayment->label }}</option>
                                        @endforeach
                                    </select>
                                    @error('modePaymentId')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- end input -->
                        @if(Auth::user()->currentBridge == 7)

                            <div class="col-md-6">
                                <div class="select-style-1">
                                    <label>Selectionner le pont </label>
                                    <div class="select-position">
                                        <select wire:model="bridge_id">
                                            <option value="" selected>Selectionner le pont</option>
                                            @foreach ($bridges as $bridge)
                                                <option value="{{ $bridge->id }}">{{ $bridge->label }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('bridge_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="col-md-6">
                                <div class="input-style-1">
                                    <label>Pont bascule </label>
                                    <input type="text" wire:model="weighbridge" disabled />
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="select-style-1">
                                <label>Type de pesée  <span class="text-danger" >*</span></label>
                                <div class="select-position">
                                    <select wire:model="typeWeighing">
                                        <option value="" selected>Selectionner la pesée</option>
                                        @foreach ($listTypeWeighing as $type_weighing)
                                            <option value="{{ $type_weighing->id }}">{{ $type_weighing->label }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('typeWeighing')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-style-1">
                                <label>Montant versé</label>
                                <input type="number" min="0" wire:model="amountPaid" class="form-control"
                                    aria-label="Text input with checkbox" />
                            </div>
                            @error('amountPaid')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- <div class="col-md-6">
                            <div class="select-style-1">
                                <label>Montant versé (XAF)</label>
                                <div class="select-position">
                                    <select wire:model="amountPaid" class="form-control">
                                        <option value="">Sélectionner un montant</option>
                                        <option value="5965">5 965</option>
                                        <option value="6000">6 000</option>
                                        <option value="7000">7 000</option>
                                        <option value="10000">10 000</option>
                                        <option value="11925">11 925</option>
                                        <option value="11950">11 950</option>
                                        <option value="12000">12 000</option>
                                        <option value="15000">15 000</option>
                                        <option value="20000">20 000</option>
                                    </select>
                                </div>
                            </div>
                            @error('amountPaid')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div> -->
                    </div>
                    <!-- end input -->

                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-style-1">
                                <label>Montant HT</label>
                                <input type="number" disabled wire:model="subtotal" />
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input-style-1">
                                <label>Montant TTC</label>
                                <input type="number" disabled wire:model="total_amount" />
                            </div>
                        </div>
                    </div>

                    <div class="input-style-1">
                        <label>Reste à rembourser</label>
                        <input type="number" disabled wire:model="remains" />
                    </div>
                    <div class="form-check checkbox-style mb-20">
                        <input class="form-check-input" type="checkbox" wire:model="isRefunded" id="checkbox-1" />
                        <label class="form-check-label" for="checkbox-1">
                            Je rembourse</label>
                    </div>
                    <div class="text-center">
                        @if (Auth::user()->isChefGuerite())
                            <button wire:click="store" wire:loading.attr="disabled" class="main-btn   active-btn-outline rounded-md btn-hover">
                                <div class="spinner-border" wire:loading role="status" wire:target="store"></div>
                                <div wire:loading.remove  wire:target="store"> Imprimer </div>
                            </button>
                        @endif
                    </div>
                </div>
                <!-- end card -->
                @if (session()->has('message'))
                    <div id="alert-message" class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('message') }} </strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                @endif
                @if (session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session('error') }} </strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                @endif
            </div>
            <!-- end col  -->

            {{-- Fin depôt --}}
        </div>

        {{-- afficher la facture sans coupon --}}
        <div class="warning-modal">
            <div wire:ignore.self id="myModal" class="modal fade mod" data-bs-backdrop="static"
                data-bs-keyboard="false" id="ModalTwo" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog  modal-xl">
                    <div class="modal-content card-style">
                        <div class="modal-header px-0 border-0 d-flex justify-content-end ">
                            <button class="border-0 bg-transparent h2" wire:click="closeModal" data-bs-dismiss="modal">
                                <i class="lni lni-cross-circle"></i>
                            </button>
                        </div>
                        <div class="modal-body px-0">
                            @if (!is_null($id_invoice))
                                <iframe src="{{ route('show-pdf', $id_invoice) }}" width="100%"
                                    height="500px"></iframe>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- afficher la facture avec coupon --}}
        <div class="warning-modal">
            <div wire:ignore.self id="myModalWithCoupon" class="modal fade mod" data-bs-backdrop="static"
                 data-bs-keyboard="false" id="ModalTwo" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog  modal-xl">
                    <div class="modal-content card-style">
                        <div class="modal-header px-0 border-0 d-flex justify-content-end ">
                            <button class="border-0 bg-transparent h2" wire:click="closeModalWithCoupon" data-bs-dismiss="modal">
                                <i class="lni lni-cross-circle"></i>
                            </button>
                        </div>
                        <div class="modal-body px-0">
                            @if (!is_null($id_invoice_with_coupon))
                                <iframe src="{{ route('show-coupon', $id_invoice_with_coupon) }}" width="100%"
                                        height="500px"></iframe>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- nouveau tracteur --}}
        <div class="warning-modal">
            <div wire:ignore.self class="modal fade" data-bs-keyboard="false"
                id="ModalTree" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content card-style warning-card">
                        @if (session()->has('new-tractor'))
                            <div id="alert-message" class="alert alert-success alert-dismissible fade show"
                                role="alert">
                                <strong>{{ session('new-tractor') }} </strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        @if (session()->has('error-tractor'))
                            <div id="alert-message" class="alert alert-danger alert-dismissible fade show"
                                role="alert">
                                <strong>{{ session('error-tractor') }} </strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="modal-header">
                            <h5 class="modal-title">Nouveau tracteur</h5>
                        </div>
                        <div class="modal-body">
                            <div class="input-style-1">
                                <label>Tracteur</label>
                                <input type="text" wire:model.defer="newTractor" placeholder="" />
                                @error('newTractor')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="text-center">
                                {{-- <button class="main-btn danger-btn-outline rounded-md btn-hover"
                                    data-bs-dismiss="modal" wire:click="storeTractor">Fermer
                                </button> --}}
                                <button data-bs-dismiss="modal" class="main-btn active-btn-outline rounded-md btn-hover"
                                    wire:click="storeTractor">Ajouter
                                </button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- nouvelle remorque --}}
        <div class="warning-modal">
            <div wire:ignore.self class="modal fade"  data-bs-keyboard="false"
                id="Modalfour" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content card-style warning-card">
                        @if (session()->has('new-trailer'))
                            <div id="alert-message" class="alert alert-success alert-dismissible fade show"
                                role="alert">
                                <strong>{{ session('new-trailer') }} </strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        @if (session()->has('error-trailer'))
                            <div id="alert-message" class="alert alert-danger alert-dismissible fade show"
                                role="alert">
                                <strong>{{ session('error-trailer') }} </strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="modal-header">
                            <h5 class="modal-title">Nouvelle remorque</h5>
                        </div>
                        <div class="modal-body">
                            <div class="input-style-1">
                                <label>Conteneur</label>
                                <input type="text" wire:model.defer="newTrailer" placeholder="" />
                                @error('new-trailer')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="text-center">
                                {{-- <button class="main-btn danger-btn-outline rounded-md btn-hover"
                                    data-bs-dismiss="modal" wire:click="cancelTrailer">Fermer
                                </button> --}}
                                <button class="main-btn active-btn-outline rounded-md btn-hover"
                                data-bs-dismiss="modal"  wire:click="storeTrailer">Ajouter
                                </button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- nouveau client --}}
        <div class="warning-modal">
            <div wire:ignore.self class="modal fade"  data-bs-keyboard="false"
                id="Modalfive" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content card-style warning-card">
                        @if (session()->has('new-customer'))
                            <div id="alert-message" class="alert alert-success alert-dismissible fade show"
                                role="alert">
                                <strong>{{ session('new-customer') }} </strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        @if (session()->has('error-customer'))
                            <div id="alert-message" class="alert alert-danger alert-dismissible fade show"
                                role="alert">
                                <strong>{{ session('error-customer') }} </strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="modal-header">
                            <h5 class="modal-title">Nouveau client</h5>
                        </div>
                        <div class="modal-body">
                            <div class="input-style-1">
                                <label>Client</label>
                                <input type="text" wire:model.defer="newCustomer" placeholder="" />
                                @error('new-customer')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="text-center">
                                {{-- <button class="main-btn danger-btn-outline rounded-md btn-hover"
                                    data-bs-dismiss="modal" wire:click="cancelCustomer">Fermer
                                </button> --}}
                                <button data-bs-dismiss="modal" class="main-btn active-btn-outline rounded-md btn-hover"
                                    wire:click="storeCustomer">Ajouter
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@push('scripts')
    <script>
        document.addEventListener('closeAlert', closeAlert);

        document.addEventListener('invoiceWithCoupon',invoiceWithCoupon);

        function invoiceWithCoupon(){
            const myModal = new bootstrap.Modal(document.getElementById('myModalWithCoupon'));
            myModal.show();
        }

        function closeAlert() {

            setTimeout(() => {
                let alertNode = document.querySelector('#alert-message');
                let alert = new bootstrap.Alert(alertNode);
                alert.close()
            }, 6000)

            const myModal = new bootstrap.Modal(document.getElementById('myModal'));
            myModal.show();
            // window.open('".$url."', '_blank')
        }
    </script>
@endpush
