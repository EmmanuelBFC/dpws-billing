<div>
    <div class="form-elements-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <!-- input style start -->
                <div class="card-style mb-30">
                    <h6 class="mb-25">Facturation</h6>
                    <div class="row">
                        <!-- <div class="input-style-1"> -->
                        <div class="col-md-6">
                            <div class="input-style-1">
                                <label>Reçu de <span class="text-danger" >*</span> <a wire:click="getCustomer" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#Modalfive">
                                        Ajouter un client</a> </label>
                                <input type="text" placeholder="Rechercher un client..." wire:model="customer" />

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
                        </div>
                        <div class="col-md-6">
                            <div class="input-style-1">
                                <label>N° Tracteur <a wire:click="getTractor" href="javascript:void(0)" data-bs-toggle="modal"
                                        data-bs-target="#ModalTree"> Ajouter un tracteur</a> </label>
                                <input type="text" placeholder="Rechercher le tracteur..." wire:model="tractor" />

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

                        <div class="col-md-6">
                            <div class="input-style-1">
                                <label>N° Conteneur <a wire:click="getTrailer" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#Modalfour"> Ajouter un conteneur</a> </label>
                                <input type="text" placeholder="Rechercher le conteneur..." wire:model="trailer" />

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
                        </div>
                        <div class="col-md-6">
                            <div class="select-style-1">
                                <label>Mode paiement <span class="text-danger" >*</span> </label>
                                <div class="select-position">
                                    <select wire:model.defer="modePaymentId">
                                        <option value="" selected>Selectionner le mode</option>
                                        @foreach ($modePayments as $modePayment)
                                            <option value="{{ $modePayment->id }}">{{ $modePayment->label }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('modePaymentId')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- end input -->
                        <!-- <div class="col-md-6">
                            <div class="input-style-1">
                                <label>Pont bascule </label>
                                <input type="text" wire:model="weighbridge" disabled />
                            </div>
                        </div> -->
                    </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-style-1">
                                    <label>Code Transaction </label>
                                    <input type="text" placeholder="Entrez le code alphanumérique" wire:model.defer="who_paid_back" />
                                    @error('who_paid_back') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-style-1">
                                    <label>Pont bascule </label>
                                    <input type="text" wire:model="weighbridge" disabled />
                                </div>
                            </div>

                        </div>
                        

                    
                    <div class="row">

                        @if(!$deposit)
                            <div class="col-md-6">
                                <div class="select-style-1">
                                    <label>Type de pesée <span class="text-danger" >*</span> </label>
                                    <div class="select-position">
                                        <select wire:model="typeWeighing">
                                            <option value="" selected>Selectionner la pesée</option>
                                            @foreach ($listTypeWeighing as $type_weighing)
                                                <option value="{{ $type_weighing->id }}">
                                                    {{ $type_weighing->label }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('typeWeighing')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="col-md-6">
                            <div class="input-style-1">
                                <label>Montant versé <span class="text-danger" >*</span> </label>
                                <div class="input-group ">
                                    <div style="background: gray !important" class="input-group-text">
                                        <input data-bs-toggle="tooltip" data-bs-placement="top"
                                               data-bs-custom-class="custom-tooltip"
                                               title="Cliquer ici pour activer la pesée test "
                                               class="form-check-input mt-0" type="checkbox"
                                               wire:model="deposit" aria-label="Checkbox for following text input">
                                    </div>
                                    <input type="number" min="0" wire:model ="amountPaid" class="form-control" aria-label="Text input with checkbox">
                                </div>
                                @if ($deposit)
                                    <small style="color: green" >Déposit activé</small>
                                @else
                                    <span><small>pour activer le déposit, cliquer sur le carré gris</small></span>
                                @endif

                                @error('amountPaid') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <!-- end input -->

                    @if(!$deposit)
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
                    @endif

                    <div class="text-center">
                        @if (Auth::user()->isSupport() || Auth::user()->isAccount())
                            <button wire:click="store" wire:loading.attr="disabled"
                                class="main-btn active-btn-outline rounded-md btn-hover">
                                <div class="spinner-border" wire:loading role="status" wire:target="store"></div>
                                <div wire:loading.remove wire:target="store"> Imprimer </div>
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
        {{-- afficher la facture --}}
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
                        <div class="modal-header">
                            <h5 class="modal-title">Nouveau tracteur</h5>
                        </div>
                        <div class="modal-body">
                            <div class="input-style-1">
                                <label>Tracteur</label>
                                <input type="text" wire:model.defer="newTractor" placeholder="Ajouter un nouveau tracteur" />
                                @error('newTractor')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="text-center">
                                <button data-bs-dismiss="modal" class="main-btn active-btn-outline rounded-md btn-hover"
                                    wire:click="storeTractor">Ajouter
                                </button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- nouveau Conteneur --}}
        <div class="warning-modal">
            <div wire:ignore.self class="modal fade" data-bs-keyboard="false"
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
                        <div class="modal-header">
                            <h5 class="modal-title">Nouveau conteneur</h5>
                        </div>
                        <div class="modal-body">
                            <div class="input-style-1">
                                <label>Conteneur</label>
                                <input type="text" wire:model.defer="newTrailer" placeholder="Ajouter un nouveau conteneur" />
                                @error('new-trailer')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="text-center">
                                <button data-bs-dismiss="modal" class="main-btn active-btn-outline rounded-md btn-hover"
                                    wire:click="storeTrailer">Ajouter
                                </button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- nouveau client --}}
        <div class="warning-modal">
            <div wire:ignore.self class="modal fade" data-bs-keyboard="false"
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
                        <div class="modal-header">
                            <h5 class="modal-title">Nouveau client</h5>
                        </div>
                        <div class="modal-body">
                            <div class="input-style-1">
                                <label>Client</label>
                                <input type="text" wire:model.defer="newCustomer" placeholder="Ajouter un nouveau client" />
                                @error('new-customer')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="text-center">
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

        function closeAlert() {

            setTimeout(() => {
                let alertNode = document.querySelector('#alert-message');
                let alert = new bootstrap.Alert(alertNode);
                alert.close()
            }, 5000)

            const myModal = new bootstrap.Modal(document.getElementById('myModal'));
            myModal.show();
        }
    </script>
@endpush
