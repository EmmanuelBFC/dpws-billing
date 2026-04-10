@extends('layouts.app')

@section('content')
 <div class="row">
        @if (Auth::user()->isSupport() || Auth::user()->isAdmin()
        || Auth::user()->isAccount() ||Auth::user()->isAdministration())
             <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="icon-card mb-30">
                    <div class="content">
                        <h6 class="mb-10">Nombre facture </h6>
                            <h6 class="text-bold mb-10"> {{$number_invoices}} </h6>
                    </div>
                </div>
                <!-- End Icon Cart -->
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="icon-card mb-30">
                    <div class="content">
                        <h6 class="mb-10">Encaissement</h6>
                        <h6 class="text-bold mb-10">{{\App\Helpers\Numbers\MoneyHelper::price($total_amount_month)}}</h6>
                    </div>
                </div>
                <!-- End Icon Cart -->
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="icon-card mb-30">
                    <div class="content">
                        <h6 class="mb-10">Factures annulées</h6>
                        <h6 class="text-bold mb-10">({{ $cancelled_invoice}}) {{\App\Helpers\Numbers\MoneyHelper::price($amount_cancelled_invoice)}} </h6>
                    </div>
                </div>
                <!-- End Icon Cart -->
            </div>
        @endif
    </div>

{{-- <!-- End Row -->--}}
{{-- <div class="row">--}}
{{--     <div class="col-lg-7">--}}
{{--         <div class="card-style mb-30">--}}
{{--             <div class="title d-flex flex-wrap justify-content-between">--}}
{{--                 <div class="left">--}}
{{--                     <h6 class="text-medium mb-10">Yearly subscription</h6>--}}
{{--                     <h3 class="text-bold">$245,479</h3>--}}
{{--                 </div>--}}
{{--                 <div class="right">--}}
{{--                     <div class="select-style-1">--}}
{{--                         <div class="select-position select-sm">--}}
{{--                             <select class="light-bg">--}}
{{--                                 <option value="">Yearly</option>--}}
{{--                                 <option value="">Monthly</option>--}}
{{--                                 <option value="">Weekly</option>--}}
{{--                             </select>--}}
{{--                         </div>--}}
{{--                     </div>--}}
{{--                     <!-- end select -->--}}
{{--                 </div>--}}
{{--             </div>--}}
{{--             <!-- End Title -->--}}
{{--             <div class="chart">--}}
{{--                 <canvas--}}
{{--                     id="Chart1"--}}
{{--                     style="width: 100%; height: 400px"--}}
{{--                 ></canvas>--}}
{{--             </div>--}}
{{--             <!-- End Chart -->--}}
{{--         </div>--}}
{{--     </div>--}}
{{--     <!-- End Col -->--}}
{{--     <div class="col-lg-5">--}}
{{--         <div class="card-style mb-30">--}}
{{--             <div--}}
{{--                 class="--}}
{{--                    title--}}
{{--                    d-flex--}}
{{--                    flex-wrap--}}
{{--                    align-items-center--}}
{{--                    justify-content-between--}}
{{--                  "--}}
{{--             >--}}
{{--                 <div class="left">--}}
{{--                     <h6 class="text-medium mb-30">Sales/Revenue</h6>--}}
{{--                 </div>--}}
{{--                 <div class="right">--}}
{{--                     <div class="select-style-1">--}}
{{--                         <div class="select-position select-sm">--}}
{{--                             <select class="light-bg">--}}
{{--                                 <option value="">Yearly</option>--}}
{{--                                 <option value="">Monthly</option>--}}
{{--                                 <option value="">Weekly</option>--}}
{{--                             </select>--}}
{{--                         </div>--}}
{{--                     </div>--}}
{{--                     <!-- end select -->--}}
{{--                 </div>--}}
{{--             </div>--}}
{{--             <!-- End Title -->--}}
{{--             <div class="chart">--}}
{{--                 <canvas--}}
{{--                     id="Chart2"--}}
{{--                     style="width: 100%; height: 400px"--}}
{{--                 ></canvas>--}}
{{--             </div>--}}
{{--             <!-- End Chart -->--}}
{{--         </div>--}}
{{--     </div>--}}
{{--     <!-- End Col -->--}}
{{-- </div>--}}
{{-- <div class="row">--}}
{{--     <div class="col-lg-7">--}}
{{--         <div class="card-style mb-30">--}}
{{--             <div--}}
{{--                 class="--}}
{{--                    title--}}
{{--                    d-flex--}}
{{--                    flex-wrap--}}
{{--                    align-items-center--}}
{{--                    justify-content-between--}}
{{--                  "--}}
{{--             >--}}
{{--                 <div class="left">--}}
{{--                     <h6 class="text-medium mb-2">Evolution du chiffre d'affaires</h6>--}}
{{--                 </div>--}}
{{--                 <div class="right">--}}
{{--                     <div class="select-style-1 mb-2">--}}
{{--                         <div class="select-position select-sm">--}}
{{--                             <select class="light-bg">--}}
{{--                                 <option value="">Last Month</option>--}}
{{--                                 <option value="">Last 3 Months</option>--}}
{{--                                 <option value="">Last Year</option>--}}
{{--                             </select>--}}
{{--                         </div>--}}
{{--                     </div>--}}
{{--                     <!-- end select -->--}}
{{--                 </div>--}}
{{--             </div>--}}
{{--             <!-- End Title -->--}}
{{--             <div class="chart">--}}
{{--                 <div id="legend3">--}}
{{--                     <ul--}}
{{--                         class="legend3 d-flex flex-wrap align-items-center mb-30"--}}
{{--                     >--}}
{{--                         <li>--}}
{{--                             <div class="d-flex">--}}
{{--                                 <span class="bg-color primary-bg"> </span>--}}
{{--                                 <div class="text">--}}
{{--                                     <p class="text-sm text-success">--}}
{{--                                         <span class="text-dark">Mois passé</span> +25.55%--}}
{{--                                         <i class="lni lni-arrow-up"></i>--}}
{{--                                     </p>--}}
{{--                                 </div>--}}
{{--                             </div>--}}
{{--                         </li>--}}
{{--                         <li>--}}
{{--                             <div class="d-flex">--}}
{{--                                 <span class="bg-color purple-bg"></span>--}}
{{--                                 <div class="text">--}}
{{--                                     <p class="text-sm text-success">--}}
{{--                                         <span class="text-dark">Mois en cours</span> +45.55%--}}
{{--                                         <i class="lni lni-arrow-up"></i>--}}
{{--                                     </p>--}}
{{--                                 </div>--}}
{{--                             </div>--}}
{{--                         </li>--}}
{{--                     </ul>--}}
{{--                 </div>--}}
{{--                 <canvas--}}
{{--                     id="Chart3"--}}
{{--                     style="width: 100%; height: 450px"--}}
{{--                 ></canvas>--}}
{{--             </div>--}}
{{--         </div>--}}
{{--     </div>--}}
{{--     <!-- End Col -->--}}
{{--     <div class="col-lg-5">--}}
{{--         <div class="card-style mb-30">--}}
{{--             <div--}}
{{--                 class="--}}
{{--                    title--}}
{{--                    d-flex--}}
{{--                    flex-wrap--}}
{{--                    align-items-center--}}
{{--                    justify-content-between--}}
{{--                  "--}}
{{--             >--}}
{{--                 <div class="left">--}}
{{--                     <h6 class="text-medium mb-2">Traffic</h6>--}}
{{--                 </div>--}}
{{--                 <div class="right">--}}
{{--                     <div class="select-style-1 mb-2">--}}
{{--                         <div class="select-position select-sm">--}}
{{--                             <select class="bg-ligh">--}}
{{--                                 <option value="">Last 6 Months</option>--}}
{{--                                 <option value="">Last 3 Months</option>--}}
{{--                                 <option value="">Last Year</option>--}}
{{--                             </select>--}}
{{--                         </div>--}}
{{--                     </div>--}}
{{--                     <!-- end select -->--}}
{{--                 </div>--}}
{{--             </div>--}}
{{--             <!-- End Title -->--}}
{{--             <div class="chart">--}}
{{--                 <div id="legend4">--}}
{{--                     <ul--}}
{{--                         class="legend3 d-flex flex-wrap align-items-center mb-30"--}}
{{--                     >--}}
{{--                         <li>--}}
{{--                             <div class="d-flex">--}}
{{--                                 <span class="bg-color primary-bg"> </span>--}}
{{--                                 <div class="text">--}}
{{--                                     <p class="text-sm text-success">--}}
{{--                                         <span class="text-dark">Store Visits</span>--}}
{{--                                         +25.55%--}}
{{--                                         <i class="lni lni-arrow-up"></i>--}}
{{--                                     </p>--}}
{{--                                     <h2>3456</h2>--}}
{{--                                 </div>--}}
{{--                             </div>--}}
{{--                         </li>--}}
{{--                         <li>--}}
{{--                             <div class="d-flex">--}}
{{--                                 <span class="bg-color danger-bg"></span>--}}
{{--                                 <div class="text">--}}
{{--                                     <p class="text-sm text-danger">--}}
{{--                                         <span class="text-dark">Visitors</span> -2.05%--}}
{{--                                         <i class="lni lni-arrow-down"></i>--}}
{{--                                     </p>--}}
{{--                                     <h2>3456</h2>--}}
{{--                                 </div>--}}
{{--                             </div>--}}
{{--                         </li>--}}
{{--                     </ul>--}}
{{--                 </div>--}}
{{--                 <canvas--}}
{{--                     id="Chart4"--}}
{{--                     style="width: 100%; height: 420px"--}}
{{--                 ></canvas>--}}
{{--             </div>--}}
{{--             <!-- End Chart -->--}}
{{--         </div>--}}
{{--     </div>--}}
{{--     <!-- End Col -->--}}
{{-- </div>--}}

{{--    <div class="row">--}}
{{--      <livewire:dashboard.dashboard/>--}}
{{--    </div>--}}


@stop

@push('scripts')

@endpush
