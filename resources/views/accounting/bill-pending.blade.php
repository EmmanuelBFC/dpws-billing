@extends('layouts.app')

@section('content')
    <div class="col-lg-12">
        @if(session()->has('succès'))
            <div id="alert-message" class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{session('succès')}} </strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card-style mb-30">
            <h6 class="mb-10"></h6>
            <div class="table-wrapper table-responsive">
                <table class="table striped-table">
                    <thead>
                    <tr>
                        <th> <h6>Reçu de</h6> </th>
                        <th><h6>Facture N°</h6></th>
                        <th><h6>Tracteur N°</h6></th>
                        <th><h6>Mode Paiement</h6></th>
                        <th><h6>Montant versé</h6></th>
                        <th><h6>Montant payé</h6></th>
                        <th><h6>statut</h6></th>
                        <th><h6>Actions</h6></th>
                    </tr>
                    <!-- end table row-->
                    </thead>
                    <tbody>
                    @forelse($invoices as $invoice)
                        <tr>
                            <td>
                                <p>{{$invoice->customer->label}}</p>
                            </td>
                            <td>
                                <h6 class="text-sm">{{$invoice->invoice_no}}</h6>
                            </td>
                            <td>
                                <p>{{$invoice->myTractor->label}} </p>
                            </td>
                            <td>
                                <p>{{$invoice->modePayment->label}}</p>
                            </td>
                            <td>
                                <p>{{$invoice->amount_paid}}</p>
                            </td>
                            <td>
                                <p>{{$invoice->total_amount}}</p>
                            </td>
                            <td>
                                @if($invoice->approved == "pending")
                                <p> <span class="status-btn info-btn">En attente</span> </p>
                                @endif
                            </td>
                            <td>
                                <div class="action">
                                    <a href="{{route('accounting.edit',$invoice->id)}}">ok</a>

                                </div>
                            </td>
                        </tr>
                    @empty
                        Pas de facture en attente
                    @endforelse

                    </tbody>
                </table>
                <!-- end table -->
            </div>
        </div>
        <!-- end card -->
    </div>
@stop
