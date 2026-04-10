@extends('layouts.app')

@section('content')
    <div class="form-elements-wrapper">
        <div class="card-style mb-30">
            <form method="POST"  action="{{route('signature.update',$signature)}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="select-style-1">
                    <label>Selectionner un utilisateur</label>
                    <div class="select-position">
                        <select name="user_id" class="@error('user_id') is-invalid @enderror">
                            <option selected disabled value="">Selectionner un utilisateur</option>
                            @foreach($users as $user )
                                @if($signature->user->id == $user->id)
                                  <option selected value="{{$user->id}}">{{$user->name}}</option>
                                @else
                                  <option value="{{$user->id}}">{{$user->name}}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('user_id')
                        <div class="invalid-feedback">
                            {{$errors->first('user_id')}}
                        </div>
                        @enderror
                    </div>
                </div>
                <!-- end select -->
                <div class="input-style-1">
                    <label for="" class="form-label" >Selectionner sa signature</label>
                    <input name="path" type="file" class="form-control @error('path') is-invalid @enderror">
                    @error('path')
                    <div class="invalid-feedback">
                        {{$errors->first('path')}}
                    </div>
                    @enderror
                </div>
                <div class="col-lg-4">
                    <button  type="submit" class="main-btn btn-sm primary-btn btn-hover mb-2">
                        Modifier
                    </button>
                </div>
            </form>

        </div>
    </div>
@stop
