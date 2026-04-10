@push('styles')

{{--    <link href="/assets/css/bootstrap-timepicker.min.css" />--}}
{{--    <link href="/assets/css/bootstrap-colorpicker.min.css" rel="stylesheet">--}}
{{--    <link href="/assets/css/bootstrap-datepicker.min.css" rel="stylesheet">--}}
{{--    <link href="/assets/css/bootstrap-clockpicker.min.css" rel="stylesheet">--}}
{{--    <link href="/assets/css/daterangepicker.css" rel="stylesheet">--}}
@endpush

<div>
    <!-- End Row -->
    <div class="row">
        <div class="col-lg-3">
            <input type="checkbox" id="shift" wire:model="shift_22" >
            <label for="shift">shift de 22H30 06h30</label>
        </div>
    </div>
    <div class="row">

          {{--  interface du support, comptable et administrateur      --}}
        @if (Auth::user()->isAdmin() || Auth::user()->isSupport() || Auth::user()->isAccount() || Auth::user()->isAdministration())
            <div class="col-lg-4">
                <div class="select-style-1">
                    <label>Selectionner le chef de Guerite</label>
                    <div class="select-position">
                        <select wire:model="user_id">
                            <option selected value="" Selectionner le chef de Geurite>...</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        @endif
        <div class="col-lg-4">
            <div class="input-style-1">
                    <label>Périodicité du shift :</label>
                <input wire:model="startDate" type="date" />
            </div>
        </div>
        <div class="col-lg-4">
            <div class="input-style-1">
                <label>Au:</label>
                <input type="date" wire:model="endDate" />
            </div>
        </div>
        @if($shift_22)
            <div class="col-lg-2">
                <div class="input-style-1">
                    <label>De:</label>
                    <input type="time" wire:model="startHour" />
                </div>
            </div>
            <div class="col-lg-2">
                <div class="input-style-1">
                    <label>A:</label>
                    <input type="time" wire:model="endHour" />
                </div>
            </div>
        @endif

            <div class="col-lg-2 mb-2">
                <button wire:click="search" style="margin-top: 1.8rem!important;"
                    class="main-btn active-btn-outline rounded-md btn-hover" type="submit">Filtrer</button>
            </div>
            <div class="col-lg-2 mb-2 mr-2" style="margin-top: 1.8rem!important;">
                <button class="main-btn dark-btn-outline rounded-md btn-hover" wire:click="renitialize" type="submit">Rénitialiser</button>
            </div>


{{--                <div class="col-lg-2 ">--}}
{{--                    <button wire:click="searchCG" style="margin-top: 1.8rem!important;"--}}
{{--                       class="main-btn active-btn-outline rounded-md btn-hover" type="submit">Filtrer--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--                <div class="col-lg-2 ">--}}
{{--                    <div class="col-lg-2 mb-2 mr-2" style="margin-top: 1.8rem!important;">--}}
{{--                        <button class="main-btn dark-btn-outline rounded-md btn-hover" wire:click="renitialize" type="submit">Rénitialiser le filtre</button>--}}
{{--                    </div>--}}
{{--                </div>--}}

        {{-- <div class="col-lg-2 justify-content-end mb-2">
            <button style="margin-top: 1.8rem!important;" class="main-btn dark-btn-outline rounded-md btn-hover"
                wire:click="exportCG">Exporter</button>
        </div> --}}
    </div>

    @php
        $i = 1;
    @endphp

    <div class="row">
        <div class="col-lg-12">
            @isset($invoices)
                <div class="row">

                    <div class="col-lg-2">
                        <div class="select-style-1 text-center">
                            <label>Nombre de facture</label>
                            <span class="text-bold mb-10">{{ $number_invoice }} </span>
                        </div>
                    </div>

                    <div class="col-lg-2">
                        <div class="select-style-1 text-center">
                            <label>Espèce</label>
                                <span class="text-bold mb-10">({{$numberCashMoney}})
                                    {{\App\Helpers\Numbers\MoneyHelper::number($cashMoney) }} </span>
                        </div>
                    </div>

                    <div class="col-lg-2">
                        <div class="select-style-1 text-center">
                            <label>Paiement mobile</label>
                            <span class="text-bold mb-10">({{$numberMobileMoney}})
                                {{ \App\Helpers\Numbers\MoneyHelper::number($mobileMoney )    }}</span>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="select-style-1 text-center">
                            <label>Facture annulée</label>
                            <span class="text-bold mb-10">({{ $numberCancelledInvoice }})
                                 {{ \App\Helpers\Numbers\MoneyHelper::number($amountCancelledInvoice ) }}</span>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="select-style-1 text-center">
                            <label>Remboursé</label>
                            <span class="text-bold mb-10">({{$numberRemains}})
                                {{\App\Helpers\Numbers\MoneyHelper::number($payback) }}</span>
                        </div>
                    </div>
                    {{-- on n'a plus besoin du montant total a supprimer --}}
                    {{-- <div class="col-lg-2">
                        <div class="select-style-1 text-center">
                            <label>Montant total</label>
                            <span class="text-bold mb-10">{{\App\Helpers\Numbers\MoneyHelper::price($total_amount)}}</span>
                        </div>
                    </div> --}}
                    <div class="col-lg-2">
                        <div class="select-style-1 text-center">
                            <label>Surplus en caisse</label>
                            <span class="text-bold mb-10">{{\App\Helpers\Numbers\MoneyHelper::price($excessAmount)}}</span>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="select-style-1 text-center">
                            <label>Montant net</label>
                            <span class="text-bold mb-10">{{\App\Helpers\Numbers\MoneyHelper::price($totalValue)}}</span>
                        </div>
                    </div>
                </div>
                {{-- <small class="text-muted">Montant net = (montant total + surplus en caisse) - (facture annulées + remboursement)</small> --}}
            @endisset
            {{-- fin statistique --}}
    </div>
</div>
{{-- tab etat facture   --}}

        <div class="tab-style-1 mt-4">
            <nav class="nav " id="nav-tab">
                <button wire:ignore class="active" id="tab-1-1" data-bs-toggle="tab" data-bs-target="#tabContent-1-1">
                    Factures
                </button>
                <button wire:ignore id="tab-1-2" data-bs-toggle="tab" data-bs-target="#tabContent-1-2">
                    Factures remboursées
                </button>
                <button id="tab-1-3" data-bs-toggle="tab" data-bs-target="#tabContent-1-3">
                    Factures annulées
                </button>
            </nav>
            <div class="tab-content" id="nav-tabContent1">
                <div class="tab-pane fade show active" wire:ignore.self id="tabContent-1-1">
                    <div class="card-style mb-30">
                        <div class="table-wrapper table-responsive">
                            <table class="table striped-table">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>
                                        <h6>N° Facture</h6>
                                    </th>
                                    <th>
                                        <h6>Nom client</h6>
                                    </th>
                                    <th>
                                        <h6>Initiée par</h6>
                                    </th>
                                    <th>
                                        <h6>Tracteur</h6>
                                    </th>
                                    <th>
                                        <h6>N°Conteneur</h6>
                                    </th>
                                    <th>
                                        <h6>Mode de paiement</h6>
                                    </th>
                                    <th>
                                        <h6>Montant versé</h6>
                                    </th>
                                    <th>
                                        <h6>Montant TTC</h6>
                                    </th>
                                    <th>
                                        <h6>Pont</h6>
                                    </th>
                                     <th>
                                        <h6>Type de pesée</h6>
                                     </th>
                                    <th>
                                        <h6>Date</h6>
                                    </th>
                                </tr>
                                <!-- end table row-->
                                </thead>
                                <tbody>

                                @empty(!$invoices)
                                    @foreach ($invoices as $invoice)
                                        <tr>
                                            <td>
                                                <h6 class="text-sm">{{ $i++ }}</h6>
                                            </td>
                                            <td>
                                                <p>{{ $invoice->invoice_no }} </p>
                                            </td>
                                            <td>
                                                <p>{{ $invoice->customer->label }}</p>
                                            </td>
                                            <td>
                                                <p>{{ $invoice->user->name }} </p>
                                            </td>
                                            <td>
                                                <p>{{ optional($invoice->myTractor)->label }}</p>
                                            </td>
                                            <td>
                                                <p>{{ optional($invoice->myTrailer)->label }}</p>
                                            </td>
                                            <td>
                                                <p>{{ $invoice->modePayment->label }}</p>
                                            </td>
                                            <td>
                                                <p>{{ \App\Helpers\Numbers\MoneyHelper::number($invoice->amount_paid) }}</p>
                                            </td>
                                            <td>
                                                <p>{{ \App\Helpers\Numbers\MoneyHelper::number($invoice->total_amount) }}</p>
                                            </td>
                                            <td>
                                                <p>{{ $invoice->weighbridge->label }}</p>
                                            </td>
                                            <td>
                                                
                                                @if($invoice->typeWeighing)
                                                    <p>{{ $invoice->typeWeighing->label ?? ' ' }}</p>
                                                @else
                                                    <p> </p>
                                                @endif
                                            </td>
                                            <td>
                                                <p>{{ $invoice->created_at->format('d/m/y H:i:s') }}</p>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endempty


                                </tbody>
                            </table>
                            <!-- end table -->
                        </div>
                    </div>
                </div>
                @php
                    $j = 1
                @endphp
                <div class="tab-pane fade" id="tabContent-1-2" wire:ignore.self >
                    <div class="card-style mb-30">
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
                                    <h6>Conteneur</h6>
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

                            @empty(!$paybacks)
                                @foreach ($paybacks as $paid_back)
                                    <tr>
                                        <td>
                                            <p>{{ $paid_back->who_paid_back }} </p>
                                        </td>

                                        <td>
                                            <p>{{ $paid_back->date_payback }}</p>
                                        </td>
                                        <td>
                                            <p>{{ $paid_back->invoice_no }} </p>
                                        </td>
                                        <td>
                                            <p>{{ $paid_back->created_at->format('d/m/y H:i:s') }}</p>
                                        </td>
                                        <td>
                                            <p>{{ \App\Helpers\Numbers\MoneyHelper::number($paid_back->amount_paid) }}</p>
                                        </td>
                                        <td>
                                            <p>{{ \App\Helpers\Numbers\MoneyHelper::number($paid_back->remains) }}</p>
                                        </td>
                                        <td>
                                            <p>{{ $paid_back->customer->label }}</p>
                                        </td>
                                        <td>
                                            <p>{{ optional($paid_back->myTractor)->label }}</p>
                                        </td>
                                        <td>
                                            <p>{{ optional($paid_back->myTrailer)->label }}</p>
                                        </td>
                                        <td>
                                            <p>{{ $paid_back->bridge_that_paid_off }}</p>
                                        </td>
                                        <td>
                                            <p>{{ $paid_back->modePayment->label }}</p>
                                        </td>
                                        <td>
                                            <p>{{ optional($paid_back->typeWeighing)->label }}</p>
                                        </td>
                                    </tr>
                                @endforeach
                            @endempty
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="tabContent-1-3">
                    <div class="card-style mb-30">
                        <div class="table-wrapper table-responsive">
                            <table class="table striped-table">
                                <thead>
                                <tr>
                                    <th>
                                        <h6>N° Facture</h6>
                                    </th>
                                    <th>
                                        <h6>Nom client</h6>
                                    </th>
                                    <th>
                                        <h6>Tracteur</h6>
                                    </th>
                                    <th>
                                        <h6>Conteneur</h6>
                                    </th>
                                    <th>
                                        <h6>Mode de paiement</h6>
                                    </th>
                                    <th>
                                        <h6>Montant versé</h6>
                                    </th>
                                    <th>
                                        <h6>Montant à rembourser</h6>
                                    </th>
                                    <th>
                                        <h6>Pont</h6>
                                    </th>
                                    <th>
                                        <h6>Type de pesée</h6>
                                    </th>
                                    <th>
                                        <h6>Date</h6>
                                    </th>
                                </tr>
                                <!-- end table row-->
                                </thead>
                                <tbody>

                                @empty(!$cancelledInvoices)
                                    @foreach ($cancelledInvoices as $cancelledInvoice)
                                        <tr>
                                            <td>
                                                <p>{{ $cancelledInvoice->invoice_no }} </p>
                                            </td>
                                            <td>
                                                <p>{{ $cancelledInvoice->customer->label }}</p>
                                            </td>
                                            <td>
                                                <p>{{ optional($cancelledInvoice->myTractor)->label }}</p>
                                            </td>
                                            <td>
                                                <p>{{ optional($cancelledInvoice->myTrailer)->label }}</p>
                                            </td>
                                            <td>
                                                <p>{{ $cancelledInvoice->modePayment->label }}</p>
                                            </td>
                                            <td>
                                                <p>{{ \App\Helpers\Numbers\MoneyHelper::number($cancelledInvoice->amount_paid) }}</p>
                                            </td>
                                            <td>
                                                <p>{{ \App\Helpers\Numbers\MoneyHelper::number($cancelledInvoice->remains) }}</p>
                                            </td>
                                            <td>
                                                <p>{{ $cancelledInvoice->weighbridge->label }}</p>
                                            </td>
                                            <td>
                                                <!-- <p>{{ $cancelledInvoice->typeWeighing->label }}</p> -->
                                                
                                                @if($cancelledInvoice->typeWeighing)
                                                    <p>{{ $cancelledInvoice->typeWeighing->label ?? ' ' }}</p>
                                                @else
                                                    <p> </p>
                                                @endif
                                            </td>
                                            <td>
                                                <p>{{ $cancelledInvoice->created_at->format('d/m/y H:i:s') }}</p>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endempty

                                </tbody>
                            </table>
                            <!-- end table -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

</div>
@push('scripts')
{{--    <script src="/assets/js/jquery.min.js"></script>--}}
{{--    <script src="/assets/js/moment.js"></script>--}}
{{--    <script src="/assets/js/bootstrap-timepicker.js"></script>--}}
{{--    <script src="/assets/js/bootstrap-colorpicker.min.js"></script>--}}
{{--    <script src="/assets/js/bootstrap-datepicker.min.js"></script>--}}
{{--    <script src="/assets/js/bootstrap-clockpicker.min.js"></script>--}}
{{--    <script src="/assets/js/daterangepicker.js"></script>--}}
{{--    <script src="/assets/js/jquery.form-pickers.init.js"></script>--}}

@endpush
