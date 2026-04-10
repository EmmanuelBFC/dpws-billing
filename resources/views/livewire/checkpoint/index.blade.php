<div>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('success') }} </strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="col-md-6 col-sm-12 col-lg-12">
        <div class="card-style">
            <h6 class="mb-25">Rechercher par le tracteur, n° conteneur, remorque</h6>
            <div class="row">
                <div class="input-style-1">
                    <input type="text" placeholder="Rechercher par le tracteur/remorque n° conteneur..." wire:model.debounce.500ms="search" />
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-12 mt-2">
            {{-- check controle pour les factures acquittées --}}
            @if ($type === 'invoice')
                @foreach ($invoices as $invoice)
                    @if ($invoice->seen_entry_control === null)
                    <div class="card-style mb-3">
                            <span class="status-btn success-btn">Facture acquittée</span>
                            <p class="text-muted">Nom client :
                                {{ $invoice->customer->label }} </p>
                            <p class="text-muted">Tracteur : {{ $invoice->myTractor->label }}</p>
                            <p class="text-muted">Remorque : {{ optional($invoice->myTrailer)->label }}</p>
                            <p class="text-muted">Chef de guerite : {{ $invoice->user->name }}</p>
                            <p class="text-muted">Facturé le : {{ $invoice->created_at->format('d/m/Y H:i:s') }}</p>
                            <a href="{{ route('checkpoint.detail', $invoice) }}" class="stretched-link"></a>
                        </div>
                    @endif

                    {{-- affiche en jaune si controle entrée ok --}}
                    @if ($invoice->seen_exit_control === null && $invoice->seen_entry_control != null)
                        <div class="card-style mb-3" style="background-color: rgb(243, 186, 13)">
                            <p class="text-muted" style="color: white !important">Nom client :
                                {{ $invoice->customer->label }} </p>
                            <p style="color: white !important">Tracteur : {{ $invoice->myTractor->label }}</p>
                            <p style="color: white !important">Remorque : {{ optional($invoice->myTrailer)->label }}</p>
                            <p style="color: white !important">Chef de guerite : {{ $invoice->user->name }}</p>
                            <p style="color: white !important">Facturé le :
                                {{ $invoice->created_at->format('d/m/Y H:i:s') }}</p>
                            <a href="{{ route('checkpoint.detail', $invoice) }}" class="stretched-link"></a>
                        </div>
                    @endif

                    {{-- entrée et sortie ok --}}
                    @if ($invoice->seen_exit_control != null && $invoice->seen_entry_control != null)
                        <div class="card-style mb-3" style="background-color: rgb(19, 97, 49)">
                            <p class="text-muted" style="color: white !important">Nom client :
                                {{ $invoice->customer->label }} </p>
                            <p class="text-muted" style="color: white !important">Tracteur :
                                {{ $invoice->myTractor->label }}</p>
                            <p class="text-muted" style="color: white !important">Remorque :
                                {{ optional($invoice->myTrailer)->label }}</p>
                            <p class="text-muted" style="color: white !important">Chef de guerite :
                                {{ $invoice->user->name }}</p>
                            <p class="text-muted" style="color: white !important">Facturé le :
                                {{ $invoice->created_at->format('d/m/Y H:i:s') }}</p>
                            <a href="{{ route('checkpoint.detail', $invoice) }}" class="stretched-link"></a>
                        </div>
                    @endif
                @endforeach
            @endif

            {{-- controle pour les conteneurs --}}
            @if ($type === 'container')
                @foreach ($invoices as $invoice)
                  
                    <div class="card-style mb-3">
                        <span class="status-btn success-btn">Prévision</span>
                        <p class="text-muted">Vehicule : {{ $invoice->tractor }}</p>
                        <p class="text-muted">Remorque : {{ $invoice->trailer }}</p>
                        <p class="text-muted">Conteneur : {{ $invoice->container_number }}</p>
                        <p class="text-muted">Plomb : {{ $invoice->seal_number }}</p>
                        {{-- <p class="text-muted">Plomb : {{ $container->seal_number }}</p> --}}
                        <a href="{{ route('container.detail', [$invoice,$checkpoint_and_container]) }}" class="stretched-link"></a>
                    </div>
                 

                    {{-- affiche en noir si controle entrée ok --}}
                    {{-- @if ($invoice->seen_exit_control === null && $invoice->seen_entry_control != null)
                        <div class="card-style mb-3" style="background-color: rgb(243, 186, 13)">
                            <p class="text-muted" style="color: white !important">Nom client :
                                {{ $invoice->customer->label }} </p>
                            <p style="color: white !important">Tracteur : {{ $invoice->myTractor->label }}</p>
                            <p style="color: white !important">Remorque : {{ optional($invoice->myTrailer)->label }}</p>
                            <p style="color: white !important">Chef de guerite : {{ $invoice->user->name }}</p>
                            <p style="color: white !important">Facturé le :
                                {{ $invoice->created_at->format('d/m/Y H:i:s') }}</p>
                            <a href="{{ route('checkpoint.detail', $invoice) }}" class="stretched-link"></a>
                        </div>
                    @endif --}}

                    {{-- entrée sortie ok --}}
                    {{-- @if ($invoice->seen_exit_control != null && $invoice->seen_entry_control != null)
                        <div class="card-style mb-3" style="background-color: rgb(19, 97, 49)">
                            <p class="text-muted" style="color: white !important">Nom client :
                                {{ $invoice->customer->label }} </p>
                            <p class="text-muted" style="color: white !important">Tracteur :
                                {{ $invoice->myTractor->label }}</p>
                            <p class="text-muted" style="color: white !important">Remorque :
                                {{ optional($invoice->myTrailer)->label }}</p>
                            <p class="text-muted" style="color: white !important">Chef de guerite :
                                {{ $invoice->user->name }}</p>
                            <p class="text-muted" style="color: white !important">Facturé le :
                                {{ $invoice->created_at->format('d/m/Y H:i:s') }}</p>
                            <a href="{{ route('checkpoint.detail', $invoice) }}" class="stretched-link"></a>
                        </div>
                    @endif --}}
                @endforeach
            @endif
        </div>
    </div>


    
