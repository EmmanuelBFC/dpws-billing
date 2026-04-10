@extends('layouts.app')

@section('content')
    <div class="col-lg-4">
        <a  type="button" class="main-btn btn-sm primary-btn btn-hover mb-2" href="{{route('stamp.create')}}"
                ><i class="lni lni-plus me-2"></i> Ajouter un cachet
        </a>
    </div>
    @if(session()->has('message'))
        <div id="alert-message" class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{session('message')}} </strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="row">
        @foreach($stamps as $stamp)
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                <div class="card-style-2 mb-30">
                    <div class="card-image">
                        <a href="#0">
                            <img src="{{asset('storage/'.$stamp->path)}}" alt="" />
                        </a>
                    </div>
                    <div class="card-content">
                        <h4><a href="#0">Cachet du {{$stamp->weighbridge->label}} </a></h4>
                        <a href="{{route('stamp.edit',$stamp->id)}}">modifier</a>
                    </div>
                </div>
        </div>
        @endforeach
    </div>
@stop
