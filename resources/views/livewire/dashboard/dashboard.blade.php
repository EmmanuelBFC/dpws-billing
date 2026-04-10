<div>
    <div class="col-md-6 col-lg-3 col-xl-6 col-xxl-3">
        <div class="card-style mb-30">
            <div
                class="
                    title
                    d-flex
                    flex-wrap
                    align-items-center
                    justify-content-between
                    mb-10
                  "
            >
                <div class="left">
                    <h6 class="text-medium mb-2">Chiffre d'affaires / Guerite</h6>
                </div>
            </div>
            <!-- End Title -->

            <div class="select-style-1 mb-2">
                <div class="select-position select-sm">
                    <select class="radius-30">
                        <option value="">Aujourd'hui</option>
                        <option value="">Semaine passée</option>
                        <option value="">Mois</option>
                    </select>
                </div>
            </div>
            <!-- end select -->

            <div class="table-responsive">
                <table class="table sell-order-table">
                    <thead>
                    <tr>
                        <th>
                            <h6 class="text-sm fw-500">Guerite</h6>
                        </th>
{{--                        <th>--}}
{{--                            <h6 class="text-sm fw-500">Evaluation</h6>--}}
{{--                        </th>--}}
                        <th class="text-end">
                            <h6 class="text-sm fw-500">Total</h6>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($weighbridges as $weighbridge)
                        <tr>
                            <td>
                                <p class="text-sm fw-500 text-gray">{{$weighbridge->label}}</p>
                            </td>
    {{--                        <td>--}}
    {{--                            <p class="text-sm fw-500 text-gray">--}}
    {{--                            <p class="text-success"> +23.4%</p>--}}
    {{--                            </p>--}}
    {{--                        </td>--}}
                            <td class="text-end">
                                <p class="text-sm fw-500 text-gray"></p>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
