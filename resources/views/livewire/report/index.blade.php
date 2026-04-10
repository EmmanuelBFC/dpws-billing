<div>
    <div>
        <div class="tables-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    @if (session()->has('message'))
                        <div id="alert-message" class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('message') }} </strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ session('error') }} </strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="card-style mb-30">
                        <div class="d-flex flex-wrap justify-content-between align-items-center py-3">
                            <div class="left">
                                <p>Afficher <span>10</span> rapports</p>
                            </div>
                            <div class="right">
                                <div class="table-search d-flex">
                                    <form action="#">
                                        <input type="text"
                                            wire:model.debounce.500ms="search_invoice_no_tractor_trailer"
                                            placeholder="..." />
                                        <button><i class="lni lni-search-alt"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="table-wrapper table-responsive">
                            <table class="table striped-table">
                                <thead>
                                    <tr>
                                        <th>
                                            <h6>Date</h6>
                                        </th>
                                        <th>
                                            <h6>shift</h6>
                                        </th>
                                        <th>
                                            <h6>Coordo</h6>
                                        </th>
                                        <th>
                                            <h6>Commentaire production</h6>
                                        </th>
                                        <th>
                                            <h6>Commentaire incident</h6>
                                        </th>
                                        <th>
                                            <h6>Nombre d'incidents</h6>
                                        </th>
                                        <th>
                                            <h6>Actions</h6>
                                        </th>
                                    </tr>
                                    <!-- end table row-->
                                </thead>
                                <tbody>
                                    @forelse ($reports as $report)
                                        <tr>
                                            <td>
                                                <p>{{ $report->created_at->format('d-m-y H:m:s') }}</p>
                                            </td>
                                            <td>
                                                <p>{{ $report->shift }}</p>
                                            </td>
                                            <td>
                                                <p>GOBE</p>
                                            </td>
                                            <td>
                                                <p>{{ $report->production_comment }}</p>
                                            </td>
                                            <td>
                                                <p>{{ $report->incidental_comment }}</p>
                                            </td>
                                            <td>
                                                <p>{{ $report->number_incident }}</p>
                                            </td>
                                            <td>
                                                <div class="action">
                                                    <button class="more-btn ml-10 dropdown-toggle" id="moreAction1"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="lni lni-more-alt"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end"
                                                        aria-labelledby="moreAction1">
                                                        <li class="dropdown-item">
                                                            <a style="color:grey" class="link-primary"
                                                                href="{{ route('reporting.show', $report->id) }}">voir</a>
                                                        </li>
                                                        <li class="dropdown-item">
                                                            <a style="color:grey" class="link-primary"
                                                                href="{{ route('reporting.show', $report->id) }}">Modifier</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
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
                                {{ $reports->links() }}
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('closeAlert', closeAlert);

        function closeAlert() {
            setTimeout(() => {
                let alertNode = document.querySelector('#alert-message');
                let alert = new bootstrap.Alert(alertNode);
                alert.close()
            }, 5000)
        }
    </script>
@endpush

</div>
