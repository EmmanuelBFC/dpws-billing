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
            @if (!empty($param) && $param == 'oui')
                <a href="{{ route('checkpoint.index') }}" class="main-btn primary-btn-outline mb-2">Retour</a>
            @else
                <a href="{{ route('search.container') }}" class="main-btn primary-btn-outline mb-2">Retour</a>
            @endif

            <div class="card-style">
                <h6 class="mb-25">Détails</h6>
                <div class="row mb-3">
                    @if ($prediction->weighing_in == 'oui')
                        <p class="text-success fw-bold">Pesée entrée : {{ $prediction->weighing_in }}</p>
                    @else
                        <p class="text-danger fw-bold">Pesée entrée : {{ $prediction->weighing_in }}</p>
                    @endif
                    @if ($prediction->weighing_out == 'oui')
                        <p class="text-success fw-bold">Pesée sortie : {{ $prediction->weighing_out }}</p>
                    @else
                        <p class="text-danger fw-bold">Pesée sortie : {{ $prediction->weighing_out }}</p>
                    @endif
                    @if (!empty($param) && $param == 'oui')
                        @if ($prediction->seen_entry_control != null)
                            <p class="text-success fw-bold">Vu contrôle entrée : {{ $prediction->seen_entry_control }}</p>
                        @else
                            <p class="text-danger fw-bold">Vu contrôle entrée : {{ $prediction->seen_entry_control }}</p>
                        @endif
                        @if ($prediction->seen_exit_control != null)
                            <p class="text-success fw-bold">Vu contrôle sortie : {{ $prediction->seen_exit_control }}</p>
                        @else
                            <p class="text-danger fw-bold">Vu contrôle sortie : {{ $prediction->seen_exit_control }}</p>
                        @endif
                    @endif
                </div>

                <div class="row">
                    <p class="text-muted">Partenaire : {{ $prediction->partenaire }} </p>
                    <p class="text-muted">Tracteur : {{ $prediction->tractor }}</p>
                    <p class="text-muted">Remorque : {{ $prediction->trailer }}</p>
                    <p class="text-muted">N° Plomb : {{ $prediction->seal_number }}</p>
                    <p class="text-muted">N° Conteneur : {{ $prediction->container_number }}</p>
                    <p class="text-muted">Chargeur : {{ $prediction->loader }}</p>
                    <p class="text-muted">Produit : {{ $prediction->product }}</p>
                    <p class="text-muted">Chef de guerite entrée : {{ $prediction->head_guerite_entry }}</p>
                    <p class="text-muted">Pont entrée : {{ $prediction->guerite_entry }}</p>
                    <p class="text-muted">Date pesée entrée
                        {{ optional($prediction->date_weighing_entry)->format('d/m/Y H:i:s') }}</p>

                    <p class="text-muted">Chef de guerite sortie : {{ $prediction->head_geurite_output }}</p>
                    <p class="text-muted">Pont sortie : {{ $prediction->geurite_output }}</p>
                    <p class="text-muted">Date pesée sortie
                        {{ optional($prediction->date_weighing_output)->format('d/m/Y H:i:s') }}</p>
                </div>
                @if (!empty($param) && $param == 'oui')
                    <div class="row">
                        <p class="fw-bold">Pont controleur entrée : {{ $prediction->weighbridge_entry }}</p>
                        <p class="fw-bold">Date contrôle entrée :
                            {{ optional($prediction->date_entry)->format('d/m/Y H:i:s') }}</p>
                        <p class="fw-bold">Nom controleur entrée : {{ $prediction->name_controleur_input }}</p>
                        <p class="fw-bold">Pont controleur entrée : {{ $prediction->weighbridge_exit }}</p>
                        <p class="fw-bold">Date contrôle sortie :
                            {{ optional($prediction->date_exit)->format('d/m/Y H:i:s') }}
                        </p>
                        <p class="fw-bold">Nom controleur sortie : {{ $prediction->name_controleur_ouput }} </p>
                    </div>
                @endif

                @if (!empty($param) && $param == 'oui')

                    @if ($prediction->seen_entry_control === null && $prediction->weighing_in != null)
                        <div class="col-xs-12 col-sm-12 col-lg-12">
                            <a class="main-btn active-btn-outline rounded-md btn-hover"
                                href="{{ route('apure.entry', [$prediction, $param]) }}"> Vu entrée
                            </a>
                        </div>
                    @endif
                    @if ($prediction->seen_exit_control === null &&
                        $prediction->seen_entry_control != null &&
                        $prediction->weighing_out != null)
                        <div class="col-xs-12 col-sm-12 col-lg-12">
                            <a class="main-btn active-btn-outline rounded-md btn-hover"
                                href="{{ route('apure.exit', [$prediction, $param]) }}">Vu sortie
                            </a>
                        </div>
                    @endif
                @else
                    {{-- si c'est pas un OP mais plutot un CG --}}
                    @if ($prediction->weighing_in === null)
                        <div class="col-xs-12 col-sm-12 col-lg-12">
                            <a class="main-btn active-btn-outline rounded-md btn-hover"
                                href="{{ route('apure.entry', $prediction) }}"> Apurer en Entrée
                            </a>
                        </div>
                    @endif
                    @if ($prediction->weighing_out === null && $prediction->weighing_in != null)
                        <div class="col-xs-12 col-sm-12 col-lg-12">
                            <a class="main-btn active-btn-outline rounded-md btn-hover"
                                href="{{ route('apure.exit', $prediction) }}">Apurer en sortie
                            </a>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
@stop
