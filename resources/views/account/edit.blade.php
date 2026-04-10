@extends('layouts.app')

@section('content')
    <div class="form-elements-wrapper">
        <div class="card-style mb-30">
            <form action="{{ route('account.update',$user) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-style-1">
                            <label>Nom</label>
                             <input name="name" value="{{$user->name}}" type="text" />
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="input-style-1">
                            <label>Email</label>
                            <input type="email" value="{{$user->email}}" name="email"/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="select-style-1">
                            <label>Selectionner son rôle</label>
                            <div class="select-position">
                                <select name="role" class="@error('role') is-invalid @enderror">
                                    <option selected disabled>Selectionner son rôle</option>
                                    <option value="ope" @selected(old('ope') == $user->role)>Opérateur</option>
                                    <option value="administration" @selected(old('administration') == $user->role)>Coordonnateur</option>
                                    <option value="admin" @selected(old('admin') == $user->role)>IT</option>
                                    <option value="support" @selected(old('support') == $user->role)>Support</option>
                                    <option value="administration" @selected(old('administration') == $user->role)>Administration</option>
                                    <option value="account" @selected(old('account') == $user->role)>Comptable</option>
                                </select>
                                @error('role')
                                    <div class="invalid-feedback">
                                        {{ $errors->first('role') }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-check form-switch toggle-switch mt-35">
                            <label class="form-check-label" for="toggleSwitch1">
                            Rénitialiser le mot de passe</label>
                            <input
                              class="form-check-input"
                              type="checkbox"
                              id="toggleSwitch1"
                              @checked(!$user->firstLogin)
                            />
                            {{-- {{dd($user->firstLogin)}} --}}
                          </div>
                    </div>
                </div>
                <!-- end select -->
                <div class="col-lg-4">
                    <button type="submit" class="main-btn btn-sm primary-btn btn-hover mb-2">
                        Modifier
                    </button>
                </div>
            </form>

        </div>
    </div>
@stop
