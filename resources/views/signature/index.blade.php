@extends('layouts.app')

@section('content')
    <div class="col-lg-4">
        <a  type="button" class="main-btn btn-sm primary-btn btn-hover mb-2" href="{{route('signature.create')}}"
                ><i class="lni lni-plus me-2"></i> Ajouter une signature
        </a>
    </div>
    @if(session()->has('message'))
        <div id="alert-message" class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{session('message')}} </strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="row">
        @foreach($signatures as $signature)
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                <div class="card-style-2 mb-30">
                    <div class="card-image">
                        <a href="#0">
                            <img src="{{asset('storage/'.$signature->path)}}" alt="" />
                        </a>
                    </div>
                    <div class="card-content">
                        <h4><a href="#0">signature de  {{$signature->user->name}} </a></h4>
                        <a href="{{route('signature.edit',$signature->id)}}">modifier</a>
                    </div>
                </div>
        </div>
        @endforeach
    </div>
@stop
