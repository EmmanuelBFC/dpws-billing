@push('styles')
    <style>
        .table> :not(caption)>*>* {
            padding: 15px 0;
            border-bottom-color: #efefef;
            border-bottom-width: 1px !important;
            vertical-align: middle;
        }
    </style>
@endpush
<div>
    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="card-style">
        <div x-data="{ isUpoloading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
            x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false"
            x-on:livewire-upload-progress="progress = $event.detail.progress">
            <div class="col">
                <div class="mb-3">
                    <input x-on:click="$wire.clear()" class="form-control" wire:model="file_excel" type="file"
                        id="formFile{{ $iteration }}">
                </div>
            </div>
            <div x-show="isUploading" class="progress mb-3">
                <div class="progress-bar progress-bar-striped" role="progressbar" aria-label="Default striped example"
                    x-bind:style="`width:${progress}%`" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
        @if (!empty($file_excel))
            <button wire:click="preview" wire:loading.attr="disabled" class="btn btn-primary">
                <div class="spinner-border" wire:loading role="status" wire:target="preview"></div>
                <div wire:loading.remove  wire:target="preview"> Afficher le fichier </div>
            </button>
        @endif
    </div>
    <div>
        {{-- @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif --}}

    </div>
    @if (!empty($predictions))
        <div class="card-style mt-3">
            <div class="table-wrapper table-responsive">
                <table class="table striped-table">
                    <thead>
                        <tr>
                            <th>Partenaires</th>
                            <th>Vehicules</th>
                            <th>Remorques</th>
                            <th>N° conteneur</th>
                            <th>N° plomb</th>
                            <th>Chargeur</th>
                            <th>Produit</th>
                            <th>Opérations</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($predictions as $row)
                            <tr>
                                @foreach ($row as $key => $value)
                                    <td>
                                        <p>{{ $value }}</p>
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <button wire:click="import" wire:loading.attr="disabled" class="btn btn-primary mt-3">
                <div class="spinner-border" wire:loading role="status" wire:target="import"></div>
                <div wire:loading.remove wire:target="import">Importer</div>
            </button>
        </div>
    @endif
    {{-- conteneur rejetés   --}}
    @if (!empty($existingItems) && count($existingItems) > 0)

        <div class="card-style mb-30 mt-3">
            <h6 class="mb-10 text-danger">Conteneurs rejetés</h6>
            <p class="text-sm mb-20">
                Ces conteneurs ont déja été enregistrés
            </p>
            <div class="table-wrapper table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="lead-info">
                                <h6>Partenaire</h6>
                            </th>
                            <th class="lead-info">
                                <h6>Véhicule</h6>
                            </th>
                            <th class="lead-email">
                                <h6>Remorque</h6>
                            </th>
                            <th class="lead-company">
                                <h6>N° conteneur</h6>
                            </th>
                            <th class="lead-phone">
                                <h6>N° plomb</h6>
                            </th>
                            <th class="lead-phone">
                                <h6>Chargeur</h6>
                            </th>
                            <th class="lead-company">
                                <h6>Produit</h6>
                            </th>
                            <th class="lead-company">
                                <h6>Opération</h6>
                            </th>
                            <th class="lead-company">
                                <h6>Chef de geurite entrée</h6>
                            </th>
                            <th class="lead-company">
                                <h6>Pont entrée</h6>
                            </th>
                            <th class="lead-company">
                                <h6>Date pesée entrée</h6>
                            </th>
                            <th class="lead-company">
                                <h6>Chef guerite sortie</h6>
                            </th>
                            <th class="lead-company">
                                <h6>Pont sortie</h6>
                            </th>
                            <th class="lead-company">
                                <h6>Date pesée sortie</h6>
                            </th>
                            <th class="lead-company">
                                <h6>Statut pesée</h6>
                            </th>
                            <th class="lead-company">
                                <h6>Ajouté par</h6>
                            </th>
                            <th class="lead-company">
                                <h6>Ajouté le</h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($existingItems as $key => $item)
                            <tr>
                                <td>
                                    <p>{{ $item->partenaire  }}</p>
                                </td>
                                <td>
                                    <p>{{ $item->tractor  }}</p>
                                </td>
                                <td>
                                    <p>{{ $item->trailer  }}</p>
                                </td>
                                <td>
                                    <p>{{ $item->container_number  }}</p>
                                </td>
                                <td>
                                    <p>{{ $item->seal_number  }}</p>
                                </td>
                                <td>
                                    <p>{{ $item->loader  }}</p>
                                </td>
                                <td>
                                    <p>{{ $item->product  }}</p>
                                </td>
                                <td>
                                    <p>{{ $item->operation  }}</p>
                                </td>
                                <td>
                                    <p>{{ $item->head_guerite_entry  }}</p>
                                </td>
                                <td>
                                    <p>{{ $item->guerite_entry  }}</p>
                                </td>
                                <td>
                                    <p>{{ $item->date_weighing_entry  }}</p>
                                </td>
                                <td>
                                    <p>{{ $item->head_geurite_output  }}</p>
                                </td>
                                <td>
                                    <p>{{ $item->geurite_output  }}</p>
                                </td>
                                <td>
                                    <p>{{ $item->date_weighing_output  }}</p>
                                </td>
                                <td>
                                    <p>{{ $item->weighing_status  }}</p>
                                </td>
                                <td>
                                    <p>{{ optional($item->user)->name  }}</p>
                                </td>
                                <td>
                                    <p>{{ $item->created_at->format('d/m/y H:i:s') }}</p>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    @endif


    {{-- éléments enregistrés avec succès  --}}
    @if (!empty($newItems) && count($newItems) > 0)

        <div class="card-style mb-30 mt-3">
            <h6 class="mb-10 text-success">Conteneurs enregistrés avec succès</h6>
            <div class="table-wrapper table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="lead-info">
                                <h6>Partenaire</h6>
                            </th>
                            <th class="lead-info">
                                <h6>Véhicule</h6>
                            </th>
                            <th class="lead-email">
                                <h6>Remorque</h6>
                            </th>
                            <th class="lead-company">
                                <h6>N° conteneur</h6>
                            </th>
                            <th class="lead-phone">
                                <h6>N° plomb</h6>
                            </th>
                            <th class="lead-phone">
                                <h6>Chargeur</h6>
                            </th>
                            <th class="lead-company">
                                <h6>Produit</h6>
                            </th>
                            <th class="lead-company">
                                <h6>Opération</h6>
                            </th>
                            <th class="lead-company">
                                <h6>Ajouté par</h6>
                            </th>
                            <th class="lead-company">
                                <h6>Ajouté le</h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($newItems as $key => $item)
                            <tr>
                                <td>
                                    <p>{{ $item->partenaire }}</p>
                                </td>
                                <td>
                                    <p>{{ $item->tractor }}</p>
                                </td>
                                <td>
                                    <p>{{ $item->trailer }}</p>
                                </td>
                                <td>
                                    <p>{{ $item->container_number }}</p>
                                </td>
                                <td>
                                    <p>{{ $item->seal_number }}</p>
                                </td>
                                <td>
                                    <p>{{ $item->loader }}</p>
                                </td>
                                <td>
                                    <p>{{ $item->product }}</p>
                                </td>
                                <td>
                                    <p>{{ $item->operation }}</p>
                                </td>
                                <td>
                                    <p>{{ optional($item->user)->name }}</p>
                                </td>
                                <td>
                                    <p>{{ $item->created_at->format('d/m/y H:i:s') }}</p>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    @endif

</div>
@push('scripts')
    <script defer src="{{asset('assets/js/alpinejs.min.js')}}"></script>
@endpush
