@extends('layouts.app')

@section('content')
    <div class="row">
        @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ session('error') }} </strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="row">
            <div class="col-lg-12">
                <div class="card-style mb-30">
                    <h6 class="mb-25">Facturation</h6>
                    <form action="{{route('prediction.update',$prediction)}}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-style-1">
                                    <label>Partenaire </label>
                                    <input type="text" name="partenaire" value="{{ $prediction->partenaire }}" />
                                    @error('partenaire')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-style-1">
                                    <label>Remorque</label>
                                    <input type="text" name="trailer" value="{{ $prediction->trailer }}" />
                                    @error('trailer')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-style-1">
                                    <label>N° conteneur</label>
                                    <input type="text" name="container_number"
                                        value="{{ $prediction->container_number }}" />
                                    @error('container_number')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-style-1">
                                    <label>N° plomb </label>
                                    <input type="text" name="seal_number" value="{{ $prediction->seal_number }}" />
                                    @error('seal_number')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-style-1">
                                    <label>Chargeur</label>
                                    <input type="text" name="loader" value="{{ $prediction->loader }}" />
                                    @error('loader')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-style-1">
                                    <label>Produit</label>
                                    <input type="text" name="product" value="{{ $prediction->product }}"
                                        class="form-control" />
                                </div>
                                @error('product')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-style-1">
                                    <label>Opération</label>
                                    <input type="text" name="operation" value="{{ $prediction->operation }}" />
                                    @error('operation')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button class="main-btn   active-btn-outline rounded-md btn-hover">
                                Modifier
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
