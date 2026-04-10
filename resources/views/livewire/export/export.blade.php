<div>
    <div class="card-style mb-30">
        <div class="table-wrapper table-responsive">
            {{-- <button type="button" id="export_button" wire:click="markexport"
                class="btn btn-success btn-sm">
                <div class="spinner-border" wire:loading role="status" wire:target="store"></div>
                <span wire:loading.remove>Exporter</span>
            </button> --}}

            <button id="export_button" wire:click="markexport" wire:loading.attr="disabled"    class="main-btn success-btn square-btn btn-hover">
                <div class="spinner-border" wire:loading role="status"></div>
                <div wire:loading.remove  wire:target="store"> Export </div>
            </button>

            <table id="employee_data" class="table striped-table">
                <thead>
                <tr>
                    <th>
                        <h6>Partenaires</h6>
                    </th>
                    <th>
                        <h6>Vehicule</h6>
                    </th>
                    <th>
                        <h6>Remorque</h6>
                    </th>
                    <th>
                        <h6>N° Conteneur</h6>
                    </th>
                    <th>
                        <h6>N° Plomb</h6>
                    </th>
                    <th>
                        <h6>Chargeur</h6>
                    </th>
                    <th>
                        <h6>Produit</h6>
                    </th>
                    <th>
                        <h6>Chef de Guerite</h6>
                    </th>
                    <th>
                        <h6>Guerite entrée</h6>
                    </th>
                    <th>
                        <h6>Statut de la pesée</h6>
                    </th>
                    <th>
                        <h6>Pesée d'entrée</h6>
                    </th>
                    <th>
                        <h6>Date</h6>
                    </th>
                    <th>
                        <h6>Heure</h6>
                    </th>
                </tr>
                <!-- end table row-->
                </thead>
                <tbody>
                    @foreach ($invoices as $invoice)
                        <tr>
                            <td>
                                <p>{{ $invoice->customer->label }} </p>
                            </td>
                            <td>
                                <p>{{ optional($invoice->myTractor)->label }} </p>
                            </td>
                            <td>
                                <p>{{ optional($invoice->myTrailer)->label }} </p>
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <p>{{ $invoice->user->name }} </p>
                            </td>
                            <td>
                                <p>{{ $invoice->weighbridge->label }} </p>
                            </td>
                            <td></td> {{-- statut de la pesée  --}}
                            <td>OUI</td> {{-- pesee entree  --}}
                            <td>
                                <p>{{ $invoice->created_at->format('d/m/y') }} </p>
                            </td>
                            <td>
                                
                                <p>{{ $invoice->created_at->format('H:i:s') }} </p>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>

            <!-- end table -->
        </div>
    </div>
</div>
