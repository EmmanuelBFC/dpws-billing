<div>
    @php
        $i = 1
    @endphp
    <div class="row">
        <div class="col-lg-12">
            <div class="tab-style-1">
                <nav class="nav " id="nav-tab">
                    <button wire:ignore class="active" id="tab-1-1" data-bs-toggle="tab" data-bs-target="#tabContent-1-1">
                        En attente
                    </button>
                    <button wire:ignore id="tab-1-2" data-bs-toggle="tab" data-bs-target="#tabContent-1-2">
                        Remboursé par
                    </button>
                </nav>
                <div class="tab-content" id="nav-tabContent1">
                    <div class="tab-pane fade show active" wire:ignore.self id="tabContent-1-1">
                        <div class="card-style mb-30">
                            <div class="table-wrapper table-responsive">
                                <table class="table striped-table">
                                    <thead>
                                    <tr>
                                        <th>
                                            <h6>N° Facture</h6>
                                        </th>
                                        <th>
                                            <h6>Date</h6>
                                        </th>
                                        <th>
                                            <h6>Montant versé</h6>
                                        </th>
                                        <th>
                                            <h6>A rembourser</h6>
                                        </th>
                                        <th>
                                            <h6>Nom client</h6>
                                        </th>
                                        <th>
                                            <h6>Tracteur</h6>
                                        </th>
                                        <th>
                                            <h6>Remorque</h6>
                                        </th>
                                        <th>
                                            <h6>Pont</h6>
                                        </th>
                                        <th>
                                            <h6>Mode de paiement</h6>
                                        </th>
                                        <th>
                                            <h6>Type de pesée</h6>
                                        </th>
                                    </tr>
                                    <!-- end table row-->
                                    </thead>
                                    <tbody>

                                    @forelse($refunds as $refund )
                                        <tr>
                                            <td>
                                                <p>{{ $refund->invoice_no }}</p>
                                            </td>
                                            <td>
                                                <p>{{ $refund->created_at->format('d/m/y H:i:s') }}</p>
                                            </td>
                                            <td>
                                                <p>{{ $refund->amount_paid }}</p>
                                            </td>
                                            <td>
                                                <p>{{ $refund->remains }}</p>
                                            </td>
                                            <td>
                                                <p>{{ $refund->customer->label }}</p>
                                            </td>
                                            <td>
                                                <p>{{ optional($refund->myTractor)->label }}</p>
                                            </td>
                                            <td>
                                                <p>{{ optional($refund->myTrailer)->label }}</p>
                                            </td>
                                            <td>
                                                <p>{{ $refund->weighbridge->label }}</p>
                                            </td>
                                            <td>
                                                <p>{{ $refund->modePayment->label }}</p>
                                            </td>
                                            <td>
                                                <p>{{ optional($refund->typeWeighing)->label }}</p>
                                            </td>
                                        </tr>
                                    @empty
                                        <p>Aucun remboursement pour le moment</p>
                                    @endforelse

                                    </tbody>
                                </table>
                                <!-- end table -->
                            </div>
                            <div class="pt-10 d-flex flex-wrap justify-content-between ">
                                <div class="left">
                                    <p class="text-sm text-gray">
                                </div>
                                <div class="">
                                    {{ $refunds->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @php
                        $j = 1
                    @endphp
                    <div class="tab-pane fade" id="tabContent-1-2" wire:ignore.self >
                        <div class="card-style mb-30">
                            <div class="table-wrapper table-responsive">
                                <table class="table striped-table">
                                    <thead>
                                    <tr>
                                        <th>
                                            <h6>Remboursé par</h6>
                                        </th>
                                        <th>
                                            <h6>En date du</h6>
                                        </th>
                                        <th>
                                            <h6>N° Facture</h6>
                                        </th>
                                        <th>
                                            <h6>Date</h6>
                                        </th>
                                        <th>
                                            <h6>Montant versé</h6>
                                        </th>
                                        <th>
                                            <h6>Montant remboursé</h6>
                                        </th>
                                        <th>
                                            <h6>Nom client</h6>
                                        </th>
                                        <th>
                                            <h6>Tracteur</h6>
                                        </th>
                                        <th>
                                            <h6>Remorque</h6>
                                        </th>
                                        <th>
                                            <h6>Pont</h6>
                                        </th>
                                        <th>
                                            <h6>Mode de paiement</h6>
                                        </th>
                                        <th>
                                            <h6>Type de pesée</h6>
                                        </th>
                                    </tr>
                                    <!-- end table row-->
                                    </thead>
                                    <tbody>

                                    @forelse($refunded as $ref )
                                        <tr>
                                            <td>
                                                <p>{{ $ref->who_paid_back }}</p>
                                            </td>
                                            <td>
                                                <p>{{ $ref->date_payback }}</p>
                                            </td>
                                            <td>
                                                <p>{{ $ref->invoice_no }}</p>
                                            </td>
                                            <td>
                                                <p>{{ $ref->created_at->format('d/m/y H:i:s') }}</p>
                                            </td>
                                            <td>
                                                <p>{{ $ref->amount_paid }}</p>
                                            </td>
                                            <td>
                                                <p>{{ $ref->remains }}</p>
                                            </td>
                                            <td>
                                                <p>{{ $ref->customer->label }}</p>
                                            </td>
                                            <td>
                                                <p>{{ optional($ref->myTractor)->label }}</p>
                                            </td>
                                            <td>
                                                <p>{{ optional($ref->myTrailer)->label }}</p>
                                            </td>
                                            <td>
                                                <p>{{ $ref->bridge_that_paid_off }}</p>
                                            </td>
                                            <td>
                                                <p>{{ $ref->modePayment->label }}</p>
                                            </td>
                                            <td>
                                                <p>{{ optional($ref->typeWeighing)->label }}</p>
                                            </td>
                                        </tr>
                                    @empty
                                        <p>Aucun remboursement pour le moment</p>
                                    @endforelse

                                    </tbody>
                                </table>

                                <!-- end table -->
                            </div>
                            <div class="pt-10 d-flex flex-wrap justify-content-between ">
                                <div class="left">
                                    <p class="text-sm text-gray">
                                </div>
                                <div class="">
                                    {{ $refunded->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
</div>
