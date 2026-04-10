<div>
    <div class="tables-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="card-style mb-30">
                    <!-- <small class=" text-black">facture annulée en rouge</small>
                    <div class="d-flex flex-wrap justify-content-between align-items-center py-3">
                        <div class="left">
                            <p>Afficher <span>10</span> factures</p>
                        </div>
                        <div class="right">
                            <div class="table-search d-flex">
                                <form action="#">
                                    <input type="text" wire:model.debounce.500ms="search_invoice_no_tractor_trailer"
                                    placeholder="Entrer le n° facture, n° tracteur ou Le Client" />
                                    <button><i class="lni lni-search-alt"></i></button>
                                </form>
                            </div>
                        </div>
                    </div> -->
                    <div class="left">
                        <small class=" text-black">facture annulée en rouge</small>
                        <p>Afficher <span>10</span> factures</p>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4">
                            <input type="text" class="form-control" placeholder="Rechercher facture / tracteur / client / Conteneur"
                                wire:model.debounce.1000ms="search_invoice_no_tractor_trailer">
                        </div>
                
                        <div class="col-md-2">
                            <input type="date" class="form-control" wire:model="startDate">
                        </div>
                
                        <div class="col-md-2">
                            <input type="date" class="form-control" wire:model="endDate">
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-success" wire:click="exportExcel">
                                Exporter Excel
                            </button>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-secondary" wire:click="renitialize">Réinitialiser</button>
                        </div>
                    </div>
                    <div class="table-wrapper table-responsive">
                        <table class="table striped-table">
                            <thead>
                                <tr>
                                    <th class="lead-info">
                                        <h6>Clé</h6>
                                    </th>
                                    <th class="lead-info">
                                        <h6>N° facture</h6>
                                    </th>
                                    <th class="lead-info">
                                        <h6>Reçu de</h6>
                                    </th>
                                    <th class="lead-info">
                                        <h6>Date</h6>
                                    </th>
                                    <th class="lead-company">
                                        <h6>Montant TTC</h6>
                                    </th>
                                    <th class="lead-info">
                                        <h6>Facturé par</h6>
                                    </th>
                                    <th class="lead-company">
                                        <h6>Mode paiement</h6>
                                    </th>
                                    <th class="lead-info">
                                        <h6>Code Transaction</h6>
                                    </th>
                                    <th class="lead-email">
                                        <h6>N° tracteur</h6>
                                    </th>
                                    <th class="lead-email">
                                        <h6>N° Conteneur</h6>
                                    </th>
                                    <th class="lead-phone">
                                        <h6>Statut facture</h6>
                                    </th>

                                    <th class="lead-company">
                                        <h6>Pont bascule</h6>
                                    </th>
                                    <th class="lead-company">
                                        <h6>Type de pesée</h6>
                                    </th>
                                    {{-- <th class="lead-company">
                                        <h6>Montant</h6>
                                    </th> --}}
                                    <th>
                                        <h6>Actions</h6>
                                    </th>
                                </tr>
                                <!-- end table row-->
                            </thead>
                            <tbody>
                                @forelse ($invoices as $invoice)
                                    @if ($invoice->status_invoice == 'cancelling')
                                        <tr class="table-danger">
                                            <td>
                                                <p>{{ $invoice->id }}</p>
                                            </td>
                                            <td>
                                                <p>{{ $invoice->invoice_no }}</p>
                                            </td>
                                            <td>
                                                <p>{{ optional($invoice->customer)->label }}</p>
                                            </td>
                                            <td>
                                                <p>{{ $invoice->created_at->format('d/m/y H:i:s') }}</p>
                                            </td>
                                            <td>
                                                <p>{{ $invoice->total_amount }}</p>
                                            </td>
                                            <td>
                                                <p>{{ $invoice->user->name }}</p>
                                            </td>
                                            <td>
                                                <p>{{ $invoice->modePayment->label }}</p>
                                            </td>
                                            <td>
                                                <p>{{ $invoice->who_paid_back }}</p>
                                            </td>
                                            <td>
                                                <p>{{ optional($invoice->myTractor)->label }}</p>
                                            </td>
                                            <td>
                                                <p>{{ optional($invoice->myTrailer)->label }}</p>
                                            </td>
                                            <td>
                                                <p>{{ $invoice->status_invoice }}</p>
                                            </td>

                                            <td>
                                                <p>{{ $invoice->weighbridge->label }}</p>
                                            </td>
                                            <td>
                                                <p>{{ optional($invoice->typeWeighing)->label }}</p>
                                            </td>
                                            {{-- <td>
                                                <p>{{ $invoice->total_amount }}</p>
                                            </td> --}}
                                            <td>
                                                <div class="action justify-content-end">
                                                    <div class="action">
                                                        <a class="text-primary" target="_blank"
                                                            href="{{ route('show-pdf', $invoice->id) }}">
                                                            <i class="lni lni-printer"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td>
                                                <p>{{ $invoice->id }}</p>
                                            </td>
                                            <td>
                                                <p>{{ $invoice->invoice_no }}</p>
                                            </td>
                                            <td>
                                                <p>{{ optional($invoice->customer)->label }}</p>
                                            </td>
                                            <td>
                                                <p>{{ $invoice->created_at->format('d/m/y H:i:s') }}</p>
                                            </td>
                                            <td>
                                                <p>{{ $invoice->total_amount }}</p>
                                            </td>
                                            <td>
                                                <p>{{ $invoice->user->name }}</p>
                                            </td>
                                            <td>
                                                <p>{{ $invoice->modePayment->label }}</p>
                                            </td>
                                            <td>
                                                <p>{{ $invoice->who_paid_back }}</p>
                                            </td>
                                            <td>
                                                <p>{{ optional($invoice->myTractor)->label }}</p>
                                            </td>
                                            <td>
                                                <p>{{ optional($invoice->myTrailer)->label }}</p>
                                            </td>
                                            <td>
                                                <p>{{ $invoice->status_invoice }}</p>
                                            </td>

                                            <td>
                                                <p>{{ $invoice->weighbridge->label }}</p>
                                            </td>

                                            <td>
                                                <p>{{ optional($invoice->typeWeighing)->label }}</p>
                                            </td>
                                            {{-- <td>
                                                <p>{{ $invoice->total_amount }}</p>
                                            </td> --}}
                                            <td>
                                                <div class="action justify-content-end">
                                                    <button class="more-btn ml-10 dropdown-toggle" id="moreAction1"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="lni lni-more-alt"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end"
                                                        aria-labelledby="moreAction1">
                                                        <li class="dropdown-item">
                                                            <a style="color:grey" class="link-primary" target="_blank"
                                                                href="{{ route('show-pdf', $invoice->id) }}">Imprimer
                                                                la
                                                                facture</a>
                                                        </li>
                                                        {{--                                                        @if ($invoice->user_id == Auth::user()->id) --}}
                                                        {{--                                                        <li class="dropdown-item"> --}}
                                                        {{--                                                            <a href="javascript:void(0)" --}}
                                                        {{--                                                                wire:click="getInvoice({{ $invoice->id }})" --}}
                                                        {{--                                                                data-bs-toggle="modal" data-bs-target="#ModalTree" --}}
                                                        {{--                                                                class="text-gray">Annuler la facture</a> --}}
                                                        {{--                                                        </li> --}}
                                                        {{--                                                        @endif --}}
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif

                                @empty
                                @endforelse
                                <!-- end table row -->
                            </tbody>
                        </table>
                        <!-- end table -->
                    </div>
                    <div class="pt-10 d-flex flex-wrap justify-content-between ">
                        <div class="left">
                            <p class="text-sm text-gray">
                        </div>
                        <div class="">
                            {{ $invoices->links() }}
                        </div>
                    </div>
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
</div>
{{-- modale d'annulation d'une facture --}}
<div class="warning-modal">
    <div wire:ignore.self class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="ModalTree"
        tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content card-style warning-card text-center">
                <div class="modal-header px-0 border-0 d-flex justify-content-end ">
                    <button wire:click="cancel" class="border-0 bg-transparent h1" data-bs-dismiss="modal">
                        <i class="lni lni-cross-circle"></i>
                    </button>
                </div>
                <div class="modal-body">
                @empty(!$data)
                    <div class="icon text-danger mb-20">
                        <i class="lni lni-warning"></i>
                    </div>
                    <div class="content mb-30">
                        <h2 class="mb-15"> Souhaitez vous vraiment annuler cette facture ? </h2>

                        <div class="row">
                            <div class="col-md-4">
                                <p><strong>Facture N°</strong> {{ $data->invoice_no }}</p>
                            </div>
                            <div class="col-md-4">
                                <p><strong>Client</strong> {{ $data->customer->label }}</p>
                            </div>
                            <div class="col-md-4">
                                <p><strong>N° Tracteur</strong> {{ optional($data->myTractor)->label }}</p>
                            </div>
                            <div class="col-md-4">
                                <p><strong>N° Remorque </strong> {{ optional($data->myTrailer)->label }}</p>
                            </div>
                            <div class="col-md-4">
                                <p><strong>Crée par</strong> {{ $data->user->name }}</p>
                            </div>
                            <div class="col-md-4">
                                <p><strong>Mode de paiement</strong> {{ $data->modePayment->label }}</p>
                            </div>
                            <div class="col-md-4">
                                <p><strong>Pont bascule</strong> {{ $data->weighbridge->label }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="action d-flex flex-wrap justify-content-center">
                        <button wire:click="cancelInvoice" data-bs-dismiss="modal"
                            class="main-btn danger-btn btn-hover m-1"> Annuler la facture
                        </button>
                    </div>
                @endempty
            </div>
        </div>
    </div>
</div>
</div>

</div>
