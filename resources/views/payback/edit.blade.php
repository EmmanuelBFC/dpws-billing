@extends('layouts.app')

@section('content')
    <div class="form-elements-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <!-- input style start -->
                <div class="card-style mb-30">
                    <h6 class="mb-25">Rembourser</h6>
                    <div class="row">
                        <form action="{{ route('payback.update', $invoice->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="input-style-1">
                                <label>Reçu de </label>
                                <input type="text" value="{{ $invoice->customer->label }}" disabled />
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-style-1">
                                        <label>N° Tracteur </label>
                                        <input type="text" value="{{ $invoice->mytractor->label }}" disabled />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-style-1">
                                        <label>N° Remorque </label>
                                        <input type="text" value="{{ optional($invoice->myTrailer)->label }}" disabled />
                                    </div>
                                </div>
                            </div>
                            <!-- end input -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-style-1">
                                        <label>Mode de paiement </label>
                                        <input type="text" value="{{ $invoice->modePayment->label }}" disabled />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-style-1">
                                        <label>Pont bascule </label>
                                        <input type="text" value="{{ $invoice->weighbridge->label }}" disabled />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-style-1">
                                        <label>Type de pesée</label>
                                        <input type="text" value="{{ $invoice->typeWeighing->label }}" disabled />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-style-1">
                                        <label>Montant versé</label>
                                        <input type="number" value="{{ $invoice->amount_paid }}" disabled
                                             />
                                    </div>
                                </div>
                            </div>
                            <div class="input-style-1">
                                <label>Reste à rembourser</label>
                                <input type="number" disabled value="{{ $invoice->remains }}" />
                            </div>
                            <div class="form-check checkbox-style mb-20">
                                <input class="form-check-input" type="checkbox" name="isRefunded" id="checkbox-1" />
                                <label class="form-check-label" for="checkbox-1">
                                    Rembourser</label>
                            </div>
                            <div class="text-center">
                                @if (Auth::user()->isChefGuerite())
                                    <button wire:click="store"
                                        class="main-btn active-btn-outline rounded-md btn-hover">Rembourser</button>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @stop
