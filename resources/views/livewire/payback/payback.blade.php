<div>
    <div class="tables-wrapper">
        <div class="row">
            <div class="col-lg-12">
                @if (session()->has('succès'))
                    <div id="alert-message" class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('succès') }} </strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session('error') }} </strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="card-style mb-30">
                    <div class="d-flex flex-wrap justify-content-between align-items-center py-3">
                        <div class="left">

                            <p>Afficher <span>10</span> factures</p>
                        </div>
                        <div class="right">
                            <div class="table-search d-flex">
                                <form action="#">
                                    <input type="text" wire:model.debounce.500ms="search_invoice_no_tractor_trailer"
                                        placeholder="Entrer le n° tracteur" />
                                    <button><i class="lni lni-search-alt"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="table-wrapper table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="lead-info">
                                        <h6>N° facture</h6>
                                    </th>
                                    <th class="lead-info">
                                        <h6>Emise le</h6>
                                    </th>
                                    <th class="lead-email">
                                        <h6>N° tracteur</h6>
                                    </th>
                                    <th class="lead-company">
                                        <h6>Pont bascule</h6>
                                    </th>
                                    <th class="lead-phone">
                                        <h6>Montant versé</h6>
                                    </th>
                                    <th class="lead-phone">
                                        <h6>Reste</h6>
                                    </th>
                                    <th class="lead-company">
                                        <h6>Facturé par</h6>
                                    </th>
                                    <th>
                                        <h6>Actions</h6>
                                    </th>
                                </tr>
                                <!-- end table row-->
                            </thead>
                            <tbody>
                                @forelse ($refunds as $refund)
                                    <tr>
                                        <td>
                                            <p>{{ $refund->invoice_no }}</p>
                                        </td>
                                        <td>
                                            <p>{{ $refund->created_at->format('d/m/y H:i:s') }}</p>
                                        </td>
                                        <td>
                                            <p>{{ $refund->myTractor->label }}</p>
                                        </td>
                                        <td>
                                            <p>{{ $refund->weighbridge->label }}</p>
                                        </td>
                                        <td>
                                            <p>{{ $refund->amount_paid }}</p>
                                        </td>
                                        <td>
                                            <p>{{ $refund->remains }}</p>
                                        </td>
                                        <td>
                                            <p>{{ $refund->user->name }}</p>
                                        </td>
                                        <td>
                                            @if(Auth::user()->isChefGuerite() || Auth::user()->isAccount() || Auth::user()->isSupport())
                                                <div class="action justify-content-end">
                                                    <button class="more-btn ml-10 dropdown-toggle" id="moreAction1"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="lni lni-more-alt"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end"
                                                        aria-labelledby="moreAction1">
                                                        <li class="dropdown-item">
                                                            <a href="javascript:void(0)"
                                                                wire:click="getId({{ $refund->id }})"
                                                                data-bs-toggle="modal" data-bs-target="#ModalTree"
                                                                class="text-gray">Rembourser</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <p>pas d'enregistrement</p>
                                @endforelse
                                <!-- end table row -->
                            </tbody>
                        </table>
                        <!-- end table -->
                    </div>
                    <div class="pt-10 d-flex flex-wrap justify-content-between ">
                        <div class="left">
                            <p class="text-sm text-gray">
                        </div>
                        <div class="">
                            {{ $refunds->links() }}
                        </div>
                    </div>
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <div class="warning-modal">
        <div wire:ignore.self class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="ModalTree"
            tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content card-style warning-card text-center">
                    <div class="modal-header px-0 border-0 d-flex justify-content-end ">
                        <button wire:click="cancel" class="border-0 bg-transparent h1" data-bs-dismiss="modal">
                            <i class="lni lni-cross-circle"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                    @empty(!$invoice)
                        <h2 class="mb-15"> Remboursement </h2>
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
                                    <input type="text" value="{{ optional($invoice->myTrailer)->label }}"
                                        disabled />
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
                                    <input type="number" value="{{ $invoice->amount_paid }}" disabled />
                                </div>
                            </div>
                        </div>
                        <div class="input-style-1">
                            <label>Reste à rembourser</label>
                            <input type="number" disabled value="{{ $invoice->remains }}" />
                        </div>
                        <div class="text-center">
                            @if (Auth::user()->isChefGuerite())
                                <button wire:click="payback" data-bs-dismiss="modal"
                                    class="main-btn active-btn-outline rounded-md btn-hover">Rembourser</button>
                            @endif
                        </div>
                    @endempty
                </div>
            </div>
        </div>
    </div>
 {{-- afficher la facture --}}
{{-- <div class="warning-modal">--}}
{{--    <div wire:ignore.self id="myModal" class="modal fade mod" data-bs-backdrop="static"--}}
{{--        data-bs-keyboard="false" id="ModalTwo" tabindex="-1" aria-hidden="true">--}}
{{--        <div class="modal-dialog  modal-xl">--}}
{{--            <div class="modal-content card-style">--}}
{{--                <div class="modal-header px-0 border-0 d-flex justify-content-end ">--}}
{{--                    <button wire:click="cancel" class="border-0 bg-transparent h2" data-bs-dismiss="modal">--}}
{{--                        <i class="lni lni-cross-circle"></i>--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--                <div class="modal-body px-0">--}}
{{--                    @if (!is_null($id_invoice))--}}
{{--                        <iframe src="{{ route('show-pdf', $id_invoice) }}" width="100%"--}}
{{--                            height="500px"></iframe>--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

<!-- Button trigger modal -->
{{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
    Launch static backdrop modal
  </button> --}}

  <!-- Modal -->
  {{-- <div class="modal fade" id="closeRemains" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Fermer</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          voulez-vous fermer ?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary">Oui</button>
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Non</button>
        </div>
      </div>
    </div>
  </div> --}}

</div>
@push('scripts')
    <script>
        document.addEventListener('closeAlert', closeAlert);

        function closeAlert() {

            setTimeout(() => {
                let alertNode = document.querySelector('#alert-message');
                let alert = new bootstrap.Alert(alertNode);
                alert.close()
            }, 7000)

            const myModal = new bootstrap.Modal(document.getElementById('myModal'));
            myModal.show();

            const myModal2 = new bootstrap.Modal(document.getElementById('ModalTree'));
            myModal2.hide();
        }

        function closeModal() {

            // window.open('".$url."', '_blank')
        }

        function closeInvoice(){
            confirm("Etes vous sûr de vouloir fermer cette fenêtre ?");
        }
    </script>
@endpush
