<div>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('success') }} </strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="col-md-6 col-sm-12 col-lg-12">
        <div class="card-style">
            <h6 class="mb-25">Rechercher le n° conteneur</h6>
            <div class="row">
                <div class="input-style-1">
                    <input type="text" placeholder="Rechercher conteneur/remorque/tracteur..."
                        wire:model.debounce.500ms="search" />
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-12 mt-2">
            @foreach ($containers as $container)
                    <div class="card-style mb-3">
                        @if ($container->weighing_in == 'oui')
                        <p class="text-warning fw-bold mb-2">Pesée en entrée</p>
                        @endif
                        <p class="text-muted">Vehicule : {{ $container->tractor }}</p>
                        <p class="text-muted">Remorque : {{ $container->trailer }}</p>
                        <p class="text-muted">Conteneur : {{ $container->container_number }}</p>
                        <p class="text-muted">Plomb : {{ $container->seal_number }}</p>
                        {{-- <p class="text-muted">Plomb : {{ $container->seal_number }}</p> --}}
                        <a href="{{ route('container.detail', $container) }}" class="stretched-link"></a>
                    </div>

                {{-- @if ($container->weighing_in === null)
                    <div class="card-style mb-3">
                        <p class="text-muted">Nom client :
                            {{ $container->customer->label }} </p>
                        <p class="text-muted">Tracteur : {{ $container->myTractor->label }}</p>
                        <p class="text-muted">Remorque : {{ optional($container->myTrailer)->label }}</p>
                        <p class="text-muted">Chef de guerite : {{ $container->user->name }}</p>
                        <p class="text-muted">Facturé le : {{ $container->created_at->format('d/m/Y H:i:s') }}</p>
                        <a href="{{ route('checkpoint.detail', $container) }}" class="stretched-link"></a>
                    </div>
                @endif --}}

                {{-- affiche en noir si controle entrée ok --}}
                {{-- @if ($container->seen_exit_control === null && $container->seen_entry_control != null)
                    <div class="card-style mb-3" style="background-color: rgb(243, 186, 13)">
                        <p class="text-muted" style="color: white !important">Nom client :
                            {{ $container->customer->label }} </p>
                        <p style="color: white !important">Tracteur : {{ $container->myTractor->label }}</p>
                        <p style="color: white !important">Remorque : {{ optional($container->myTrailer)->label }}</p>
                        <p style="color: white !important">Chef de guerite : {{ $container->user->name }}</p>
                        <p style="color: white !important">Facturé le :
                            {{ $container->created_at->format('d/m/Y H:i:s') }}</p>
                        <a href="{{ route('checkpoint.detail', $container) }}" class="stretched-link"></a>
                    </div>
                @endif --}}

                {{-- entrée sortie ok --}}
                {{-- @if ($container->seen_exit_control != null && $container->seen_entry_control != null)
                    <div class="card-style mb-3" style="background-color: rgb(19, 97, 49)">
                        <p class="text-muted" style="color: white !important">Nom client :
                            {{ $container->customer->label }} </p>
                        <p class="text-muted" style="color: white !important">Tracteur :
                            {{ $container->myTractor->label }}</p>
                        <p class="text-muted" style="color: white !important">Remorque :
                            {{ optional($container->myTrailer)->label }}</p>
                        <p class="text-muted" style="color: white !important">Chef de guerite :
                            {{ $container->user->name }}</p>
                        <p class="text-muted" style="color: white !important">Facturé le :
                            {{ $container->created_at->format('d/m/Y H:i:s') }}</p>
                        <a href="{{ route('checkpoint.detail', $container) }}" class="stretched-link"></a>
                    </div>
                @endif --}}
            @endforeach
        </div>
    </div>
