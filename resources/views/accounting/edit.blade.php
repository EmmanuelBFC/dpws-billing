@extends('layouts.app')

@section('content')
    <div class="card-style mb-30">
        <form method="POST" action="{{route('accounting.update', $bill->id)}}">
            @csrf
            @method('PATCH')
            <div class="row mt-3">
                <div class="col-md-6">
                    <div class="input-style-1">
                        <label>Reçu de</label>
                        <input type="text" disabled value="{{$bill->customer->label}}" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-style-1">
                        <label>N° Tracteur</label>
                        <input type="text" disabled value="{{$bill->myTractor->label}}" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-style-1">
                        <label>N° Remorque</label>
                        <input type="text" disabled value="{{optional($bill->myTrailer)->label}}" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-style-1">
                        <label>Mode de paiment </label>
                        <input type="text" disabled value="{{$bill->modePayment->label}}" />
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="input-style-1">
                        <label>Point de paiement </label>
                        <input type="text" disabled value="{{$bill->weighbridge->label}}" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-style-1">
                        <label>Montant versé </label>
                        <input type="text"  disabled value="{{$bill->amount_paid}}" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-style-1">
                        <label>Montant HT </label>
                        <input type="text" disabled value="{{$bill->subtotal}}" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-style-1">
                        <label>Montant TVA (19.25) </label>
                        <input type="text" disabled value="{{$bill->tax_amount}}" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-style-1">
                        <label>Montant TTC </label>
                        <input type="text" disabled value="{{$bill->total_amount}}" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-style-1">
                        <label>Reste à rembourser </label>
                        <input type="text" disabled value="{{$bill->remains}}" />
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="input-style-1">
                    <label>Emis par </label>
                    <input type="text" disabled value="{{$bill->user->name}}" />
                </div>
            </div>
            <div class="col-md-12">
                <div class="select-style-1">
                    <label>Opération</label>
                    <div class="select-position">
                        <select name="approved">
                            <option selected disabled>Selectionner une Opération</option>
                            <option value="validated">approuver la facture</option>
                            <option value="cancellation">Annuler la facture</option>

                        </select>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <button type="submit"
                        class="main-btn active-btn-outline rounded-md btn-hover">Valider
                </button>
            </div>
        </form>
    </div>
@stop
