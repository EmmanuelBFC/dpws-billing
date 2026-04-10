@extends('layouts.app')

@section('content')
    <div class="row">
        @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ session('error') }} </strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="col-md-12 col-sm-12 col-lg-12">
            <a href="{{ route('checkpoint.index') }}" class="main-btn primary-btn-outline mb-2">Retour</a>
            <div class="card-style">
                <h6 class="mb-25">Détails</h6>
                <div class="row mb-4">
                    @if ($invoice->seen_entry_control != null)
                      <p class="text-success fw-bold">Vu contrôle entrée : {{ $invoice->seen_entry_control }}</p>
                      @else
                       <p class="text-danger fw-bold">Vu contrôle entrée : {{ $invoice->seen_entry_control }}</p>
                    @endif
                    @if ($invoice->seen_exit_control != null)
                       <p class="text-success fw-bold">Vu contrôle sortie : {{ $invoice->seen_exit_control }}</p>
                       @else
                       <p class="text-danger fw-bold">Vu contrôle sortie : {{ $invoice->seen_exit_control }}</p>
                    @endif
                </div>
                <div class="row">
                    <p class="text-muted">Nom client : {{ optional($invoice->customer)->label }} </p>
                    <p class="text-muted">Tracteur : {{ $invoice->myTractor->label }}</p>
                    <p class="text-muted">Remorque : {{ optional($invoice->myTrailer)->label }}</p>
                    <p class="text-muted">Chef de guerite : {{ $invoice->user->name }}</p>
                    <p class="text-muted">Pont : {{ $invoice->weighbridge->label }}</p>
                    <p class="text-muted">Date facture : {{ $invoice->created_at->format('d/m/Y H:i:s') }}</p>
                    <p class="text-muted">Vu contrôle entrée : {{ $invoice->seen_entry_control }}</p>
                    <p class="text-muted">Pont controleur entrée : {{ $invoice->weighbridge_entry }}</p>
                    <p class="text-muted">Date contrôle entrée :
                        {{ optional($invoice->date_entry)->format('d/m/Y H:i:s') }}</p>
                    <p class="text-muted">Nom controleur entrée : {{ $invoice->name_controleur_input }}</p>
                    <p class="text-muted">Vu contrôle sortie : {{ $invoice->seen_exit_control }}</p>
                    <p class="text-muted">Pont controleur entrée : {{ $invoice->weighbridge_exit }}</p>
                    <p class="text-muted">Date contrôle sortie : {{ optional($invoice->date_exit)->format('d/m/Y H:i:s') }}
                    </p>
                    <p class="text-muted">Nom controleur sortie : {{ $invoice->name_controleur_ouput }} </p>
                </div>
                @if ($invoice->seen_entry_control === null)
                    <div class="col-xs-12 col-sm-12 col-lg-12">
                        <a class="main-btn active-btn-outline rounded-md btn-hover"
                            href="{{ route('checkpoint.updateEntry', $invoice) }}">Vu entrée
                        </a>
                    </div>
                @endif
                @if ($invoice->seen_exit_control === null && $invoice->seen_entry_control != null)
                    <div class="col-xs-12 col-sm-12 col-lg-12">
                        <a class="main-btn active-btn-outline rounded-md btn-hover"
                            href="{{ route('checkpoint.updateExit', $invoice) }}">Vu sortie
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@stop
