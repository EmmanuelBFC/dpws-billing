@extends('layouts.app')

@section('content')
    <div class="form-elements-wrapper">
        <div class="card-style mb-30">
            <form action="{{route('stamp.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="select-style-1">
                    <label>Selectionner un pont</label>
                    <div class="select-position">
                        <select name="weighbridge_id" class="@error('weighbridge_id') is-invalid @enderror">
                            <option selected disabled value="">Selectionner un pont</option>
                            @foreach($weighbridges as $weighbridge )
                                <option value="{{$weighbridge->id}}">{{$weighbridge->label}}</option>
                            @endforeach
                        </select>
                        @error('weighbridge_id')
                        <div class="invalid-feedback">
                            {{$errors->first('weighbridge_id')}}
                        </div>
                        @enderror
                    </div>
                </div>
                <!-- end select -->
                <div class="input-style-1">
                    <label for="" class="form-label" >Selectionner une image png</label>
                    <input name="path" type="file" class="form-control @error('path') is-invalid @enderror">
                    @error('path')
                    <div class="invalid-feedback">
                        {{$errors->first('path')}}
                    </div>
                    @enderror
                </div>
                <div class="col-lg-4">
                    <button  type="submit" class="main-btn btn-sm primary-btn btn-hover mb-2">
                        Charger
                    </button>
                </div>
            </form>

        </div>
    </div>

@stop
